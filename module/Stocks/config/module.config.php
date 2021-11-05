<?php
return [
    'router' => [
        'routes' => [
            'stocks.rest.tb-users' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/users[/:tb_users_id]',
                    'defaults' => [
                        'controller' => 'Stocks\\V1\\Rest\\TbUsers\\Controller',
                    ],
                ],
            ],
            'stocks.rest.tb-stocks' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/stocks[/:tb_stocks_id]',
                    'defaults' => [
                        'controller' => 'Stocks\\V1\\Rest\\TbStocks\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'stocks.rest.tb-users',
            1 => 'stocks.rest.tb-stocks',
        ],
    ],
    'api-tools-rest' => [
        'Stocks\\V1\\Rest\\TbUsers\\Controller' => [
            'listener' => 'Stocks\\V1\\Rest\\TbUsers\\TbUsersResource',
            'route_name' => 'stocks.rest.tb-users',
            'route_identifier_name' => 'tb_users_id',
            'collection_name' => 'tb_users',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Stocks\V1\Rest\TbUsers\TbUsersEntity::class,
            'collection_class' => \Stocks\V1\Rest\TbUsers\TbUsersCollection::class,
            'service_name' => 'tb_users',
        ],
        'Stocks\\V1\\Rest\\TbStocks\\Controller' => [
            'listener' => 'Stocks\\V1\\Rest\\TbStocks\\TbStocksResource',
            'route_name' => 'stocks.rest.tb-stocks',
            'route_identifier_name' => 'tb_stocks_id',
            'collection_name' => 'tb_stocks',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Stocks\V1\Rest\TbStocks\TbStocksEntity::class,
            'collection_class' => \Stocks\V1\Rest\TbStocks\TbStocksCollection::class,
            'service_name' => 'tb_stocks',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Stocks\\V1\\Rest\\TbUsers\\Controller' => 'HalJson',
            'Stocks\\V1\\Rest\\TbStocks\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Stocks\\V1\\Rest\\TbUsers\\Controller' => [
                0 => 'application/vnd.stocks.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Stocks\\V1\\Rest\\TbStocks\\Controller' => [
                0 => 'application/vnd.stocks.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Stocks\\V1\\Rest\\TbUsers\\Controller' => [
                0 => 'application/vnd.stocks.v1+json',
                1 => 'application/json',
            ],
            'Stocks\\V1\\Rest\\TbStocks\\Controller' => [
                0 => 'application/vnd.stocks.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Stocks\V1\Rest\TbUsers\TbUsersEntity::class => [
                'entity_identifier_name' => 'id_user',
                'route_name' => 'stocks.rest.tb-users',
                'route_identifier_name' => 'tb_users_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Stocks\V1\Rest\TbUsers\TbUsersCollection::class => [
                'entity_identifier_name' => 'id_user',
                'route_name' => 'stocks.rest.tb-users',
                'route_identifier_name' => 'tb_users_id',
                'is_collection' => true,
            ],
            \Stocks\V1\Rest\TbStocks\TbStocksEntity::class => [
                'entity_identifier_name' => 'id_stock',
                'route_name' => 'stocks.rest.tb-stocks',
                'route_identifier_name' => 'tb_stocks_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Stocks\V1\Rest\TbStocks\TbStocksCollection::class => [
                'entity_identifier_name' => 'id_stock',
                'route_name' => 'stocks.rest.tb-stocks',
                'route_identifier_name' => 'tb_stocks_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools' => [
        'db-connected' => [
            'Stocks\\V1\\Rest\\TbUsers\\TbUsersResource' => [
                'adapter_name' => 'dummy',
                'table_name' => 'tb_users',
                'hydrator_name' => \Laminas\Hydrator\ArraySerializable::class,
                'controller_service_name' => 'Stocks\\V1\\Rest\\TbUsers\\Controller',
                'entity_identifier_name' => 'id_user',
                'table_service' => 'Stocks\\V1\\Rest\\TbUsers\\TbUsersResource\\Table',
            ],
            'Stocks\\V1\\Rest\\TbStocks\\TbStocksResource' => [
                'adapter_name' => 'dummy',
                'table_name' => 'tb_stocks',
                'hydrator_name' => \Laminas\Hydrator\ArraySerializable::class,
                'controller_service_name' => 'Stocks\\V1\\Rest\\TbStocks\\Controller',
                'entity_identifier_name' => 'id_stock',
                'table_service' => 'Stocks\\V1\\Rest\\TbStocks\\TbStocksResource\\Table',
            ],
        ],
    ],
];
