<h1 align="center">Level 3 API Rest using Laminas</h1>
<p align="center">This is a POC (Proof of Concept) to demonstrate a level 3 API Rest using Laminas project</p>

### Objective:
<p>Create a Level 3 API Rest that returns the stocks positions of a client.</p>

#### Api Laminas website:
https://api-tools.getlaminas.org/

#### How to use the image:
```console
bscpaz@2am:/$ docker-compose up -d
```

#### Database tables on balance.sqlite:
```sql
CREATE TABLE tb_users (
  id_user INT PRIMAY KEY, 
  name TEXT NOT NULL, 
  email TEXT NOT NULL UNIQUE 
);

CREATE TABLE tb_stocks (
  id_stock INT PRIMAY KEY,
  ticker varchar(6) NOT NULL UNIQUE, 
  company TEXT NOT NULL
);

CREATE TABLE tb_users_stocks (
  id_users_stocks INT PRIMAY KEY,
  id_user INT NOT NULL, 
  id_stock INT NOT NULL,
  amount INT NOT NULL,
  date TEXT NOT NULL,
  FOREIGN KEY (id_user) 
    REFERENCES tb_users (id_user) 
       ON DELETE CASCADE 
       ON UPDATE NO ACTION,
  FOREIGN KEY (id_stock) 
    REFERENCES tb_stocks (id_stock) 
       ON DELETE CASCADE 
       ON UPDATE NO ACTION  
);
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
