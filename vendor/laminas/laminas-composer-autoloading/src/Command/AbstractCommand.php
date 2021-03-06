<?php

/**
 * @see       https://github.com/laminas/laminas-composer-autoloading for the canonical source repository
 * @copyright https://github.com/laminas/laminas-composer-autoloading/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-composer-autoloading/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ComposerAutoloading\Command;

use Laminas\ComposerAutoloading\Exception;

use function file_get_contents;
use function file_put_contents;
use function is_array;
use function is_dir;
use function is_readable;
use function is_writable;
use function json_decode;
use function json_encode;
use function json_last_error;
use function sprintf;

use const JSON_ERROR_NONE;
use const JSON_PRETTY_PRINT;
use const JSON_UNESCAPED_SLASHES;
use const JSON_UNESCAPED_UNICODE;

abstract class AbstractCommand
{
    /** @var string */
    protected $projectDir;

    /** @var string */
    protected $modulePath = '';

    /** @var string */
    protected $modulesPath;

    /** @var string */
    protected $composer;

    /** @var string */
    protected $composerJsonFile = '';

    /**
     * @var array
     * @psalm-var array{autoload: array<string, array<string, string>|mixed>|mixed}
     */
    protected $composerPackage = [];

    /** @var string */
    protected $moduleName = '';

    /** @var string */
    protected $type = '';

    /**
     * @param string $projectDir
     * @param string $modulesPath
     * @param string $composer
     */
    public function __construct($projectDir, $modulesPath, $composer)
    {
        $this->projectDir  = $projectDir;
        $this->modulesPath = $modulesPath;
        $this->composer    = $composer;
    }

    /**
     * @param string $moduleName
     * @param null|string $type
     * @return bool
     * @throws Exception\RuntimeException
     */
    public function process($moduleName, $type = null)
    {
        $this->moduleName      = $moduleName;
        $this->modulePath      = sprintf('%s/%s/%s', $this->projectDir, $this->modulesPath, $moduleName);
        $this->type            = $type ?: $this->autodiscoverModuleType();
        $this->composerPackage = $this->getComposerJson();

        $content = $this->execute();

        if ($content !== false) {
            $this->writeJsonFileAndDumpAutoloader($content);
            return true;
        }

        return false;
    }

    /**
     * Validate that the composer.json exists, is writable, and contains valid contents.
     *
     * @return array{autoload: array<string, array<string, string>|mixed>|mixed}
     * @throws Exception\RuntimeException
     */
    public function getComposerJson()
    {
        $this->composerJsonFile = sprintf('%s/composer.json', $this->projectDir);

        if (! is_readable($this->composerJsonFile)) {
            throw new Exception\RuntimeException('composer.json file does not exist or is not readable');
        }
        if (! is_writable($this->composerJsonFile)) {
            throw new Exception\RuntimeException('composer.json file is not writable');
        }

        $composerJson    = file_get_contents($this->composerJsonFile);
        $composerPackage = json_decode($composerJson, true);
        if (! is_array($composerPackage)) {
            $error = json_last_error();
            $error = $error === JSON_ERROR_NONE
                ? 'The composer.json file was empty'
                : 'Error parsing composer.json file; please check that it is valid';
            throw new Exception\RuntimeException($error);
        }

        return $composerPackage;
    }

    /**
     * Determine the autoloading type for the module.
     *
     * If passed as a flag, uses that.
     *
     * Otherwise, introspects the module tree to determine if PSR-0 or PSR-4 is
     * being used.
     *
     * If the module tree does not include a src/ directory, returns false,
     * indicating inability to autodiscover.
     *
     * Sets the type property on successful discovery.
     *
     * @return string
     * @throws Exception\RuntimeException
     */
    protected function autodiscoverModuleType()
    {
        $psr0Spec = sprintf('%s/src/%s', $this->modulePath, $this->moduleName);
        if (is_dir($psr0Spec)) {
            return 'psr-0';
        }

        $srcPath = sprintf('%s/src', $this->modulePath);
        if (! is_dir($srcPath)) {
            throw new Exception\RuntimeException(
                'Unable to determine autoloading type; no src directory found in module'
            );
        }

        return 'psr-4';
    }

    /**
     * Do autoloading rules already exist for this module?
     *
     * @return bool
     */
    protected function autoloadingRulesExist()
    {
        if (! isset($this->composerPackage['autoload'][$this->type][$this->moduleName . '\\'])) {
            return false;
        }

        return true;
    }

    /**
     * @return void
     */
    protected function writeJsonFileAndDumpAutoloader(array $content)
    {
        file_put_contents($this->composerJsonFile, json_encode(
            $content,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ) . "\n");

        $command = sprintf('%s dump-autoload', $this->composer);
        // phpcs:ignore SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly.ReferenceViaFallbackGlobalName
        system($command);
    }

    /**
     * @return false|array{autoload: array<string, array<string, string>|mixed>|mixed}
     */
    abstract protected function execute();
}
