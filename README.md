<h1 align="center">Level 3 API Rest using Laminas</h1>
<p align="center">This is a POC (Proof of Concept) to demonstrate a level 3 API Rest using Laminas project</p>

### Objective:
<p>Create a Level 3 API Rest that returns the stocks positions of a client.</p>

#### Api Laminas website:
https://api-tools.getlaminas.org/

#### How to use the image:
```console
bscpaz@2am:/$ docker build -t laminas .
bscpaz@2am:/$ docker run -d --name laminas laminas
bscpaz@2am:/$ docker exec -it laminas bash

root@laminas:/$ composer create-project laminas-api-tools/api-tools-skeleton
root@laminas:/$ cd api-tools-skeleton
root@laminas:/$ php -S 0.0.0.0:8080 -t public public/index.php
```
<hr>
<h4 align="center">Known issues</h4>

```
Issue: 
  "failed to solve with frontend dockerfile.v0: failed to build LLB"
Solution: 
  Docker desktop -> Settings -> Docker Engine -> Change the "features": { buildkit: true} to "features": { buildkit: false}.
```
