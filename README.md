<h1 align="center">Level 3 API Rest using Laminas</h1>
<p align="center">This is a POC (Proof of Concept) to demonstrate a level 3 API Rest using Laminas project</p>

### Objective:
<p>Create a Level 3 API Rest that returns the stocks positions of a client.</p>

#### Api Laminas website:
https://api-tools.getlaminas.org/

#### How to use the image:
```console
bscpaz@2am:/$ docker-compose up
```
#### URL:
```console
http://localhost:8080
```

<hr>
<h4 align="center">Known issues</h4>

```
Issue: 
  "failed to solve with frontend dockerfile.v0: failed to build LLB"
Solution: 
  Docker desktop -> Settings -> Docker Engine -> Change the "features": { buildkit: true} to "features": { buildkit: false}.
```
