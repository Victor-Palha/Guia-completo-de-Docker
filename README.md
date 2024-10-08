# Docker
## O que é Docker?
* o **Docker** é um software que **reduz a complexidade de setup** de aplicações;
* Onde **configuramos containers**, que são como servidores para rodar nossas aplicações;
* Com facilidade, podemos criar **ambientes independentes** e que funcionam em diversos SO's;
* E ainda deixa os projetos **performáticos**;

## Por quê Docker?
* O **Docker** proporciona mais velocidade na configuração do ambiente de um dev;
* **Pouco tempo gasto em manutenção**, containers são executados como configurados;
* **Performance** para executar aplicação, mais perfomático que uma VM;
* Nos livra da **Matrix from hell**;

## Qual versão utilizar?
* O **Docker** é dividido em duas versões: **Docker CE** e **Docker EE**;
* O **Docker CE** é a versão **gratuita**, que nos possibilita utilizar o Docker normalmente;
* O **Docker EE** é a versão **paga** e **enterprise**, há uma garantia maior das versões que são disponibilizadas e você tem suporte do time do Docker;

## Instalação
[Documentação:](https://docs.docker.com/)
[Instalação Windows](https://docs.docker.com/desktop/install/windows-install/)
[Instalação Linux](https://docs.docker.com/desktop/install/linux-install/)
[Instalação Mac](https://docs.docker.com/desktop/install/mac-install/)

## Testando Docker
* Vamos testar o Docker utilizando uma **imagem real**;
* para rodar containers utilizamos o comando `docker run`;
* Neste comando **podemos passar diversos parâmetros** para configurar o container;
* Neste exemplo vamos passar apenas o nome da imagem que é `docker/whalesay`;
* Um comando chamado cowsay e uma mensagem;

```bash
    docker run docker/whalesay cowsay "Hello-World"

    # output
_____________ 
< Hello-World >
 -------------
    \
     \
      \
                    ##        .
              ## ## ##       ==
           ## ## ## ##      ===
       /""""""""""""""""___/ ===
  ~~~ {~~ ~~~~ ~~~ ~~~~ ~~ ~ /  ===- ~~~
       \______ o          __/
        \    \        __/
          \____\______/
```

# Containers
## O que são containers?
* Um **pacote de código que pode executar uma ação**, por exemplo: rodar uma aplicação de Node.js, PHP, Python e etc;
* Ou seja, os nossos projetos serão executados dentro dos containers que criarmos/utilizarmos;
* **containers utilizam imagens** para poderem ser executados;
* **Mútiplos containers podem rodar juntos**, exemplo: um para PHP e outro para MySQL;

## Container x imagem
* **Imagem e Container** são recursos fundamentais do Docker;
* Imagem é o **"projeto"** que será executado pelo container, todas as instruções estarão declaradas nela;
* Container é o **Docker rodando alguma imagem**, consequentemente executando algum código proposto por ela;
* O fluxo é: programamos uma imagem e a executamos por meio de um container;

## Onde encontrar imagens?
* Vamos encontrar imagens no repositório do Docker, o **(Docker Hub)[https://hub.docker.com]**;
* Neste site podemos **verificar quais as imagens existem da tecnologia que estamos procurando**, por exemplo: Node.js;
* E também **aprender a como utilizá-las**;
* Vamos executar uma imagem em um container com o comando: `docker run <imagem>`

```bash
    #Exemplo:
    docker run ubuntu
    # Note que ele vai baixar a imagem e logo vai sumir, pois não tem nada para executar
    # Para verificar os containers que estão sendo executados olhe a próxima sessão
```

## Verificar containers executos
* O comando **`docker ps` ou `docker container ls`** exibe quais containers estão sendo executados no momento;
* Utilizando a **flag -a**, temos também todos os containers já executados na máquina;
* Este comando é útil para **entender o que está sendo executado e acontece** no nosso ambiente;
```bash
    #Containers rodando:
    docker ps
    #Todos os containers que já executaram:
    docker ps -a
```

## Executar container com interação
* Podemos rodar um container e deixa-lo **executando no terminal**;
* Vamos utilizar a **flag -it**;
* Desta maneira **podemos executar comandos disponíveis no container** que estamos utilizando o comando `run`;
* Podemos utilizar a imagem do ubuntu para isso;
```bash
docker run -it ubuntu
```

## Container X VM (Virtual Machine)
* **Container é uma aplicação que serve para um determinado fim**, não possui um sistema operacional, seu tamanho é de alguns mbs;
* VM possui sistema operacional próprio, tamanho de gbs, **pode executar diversas funções ao mesmo tempo**;
* Containers acabam gastando menos recursos para serem executados, por causa do seu uso específico;
* VMs gastam mais recursos, porém podem exercer mais funções;

## Executar container em background
* Quando iniciamos um container que persiste, **ele fica ocupando o terminal**;
* Podemos executar um container em background, para não precisar ficar com dicersas abas de terminal aberto, utilizamos a **flag -d** (detached);
* Verificamos **containers em background com o `docker ps` também**;
* Podemos utilizar o **nginx** para este exemplo:
```bash
    docker run -d nginx
```

## Expor portas
* Os **containers de docker não tem conexão com nada de fora deles**;
* Por isso precisamos expor portas, a **flag -p** serve para isso;
```bash
docker run -d -p 80:80 nginx
```
* Desta maneira **o container estará acessível na porta 80**;
* Porque 80:80?
    * O primeiro 80 é a porta que queremos expor do container;
    * O segundo 80 é a porta que queremos acessar;
    * Ou seja, podemos rodar o comando `docker run -d -p 8080:80 nginx` e acessar o container na porta 8080 que reflete a porta 80 do nginx;
        * `localhost:8080` -> `localhost:80`

## Parando containers
* Se você está seguindo o tutorial, deve ter alguns containers rodando;
* Você pode verificar quais containers estão rodando com o comando `docker ps`;
* Para parar um container, utilizamos o comando `docker stop <id do container ou nome do container>`;
    * Essas informações podem ser vistas com o comando `docker ps`;
* Desta maneira estaremos liverando recursos que estão sendo gastos pelo mesmo;
```bash
docker ps
# output
CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS         PORTS                  NAMES       
ecc1f9240d54   nginx     "/docker-entrypoint.…"   7 seconds ago   Up 5 seconds   0.0.0.0:8080->80/tcp   quirky_kalam

docker stop ecc1f9240d54

docker ps
# output
CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS         PORTS                  NAMES

```

## Reniciando containers
* Aprendemos já a parar um container com o `stop`, para voltar a rodar um container podemos usar o comando `docker start <id>`;
* Lembre-se que **o `run` sempre cria um novo container**;
* Então caso seja necessário aproveitar um antigo, opte pelo start;
```bash
# Buscando o container que queremos
docker ps -a
# output
CONTAINER ID   IMAGE                       COMMAND                  CREATED          STATUS                        PORTS                    NAMES
ecc1f9240d54   nginx                       "/docker-entrypoint.…"   4 minutes ago    Exited (0) 4 minutes ago                               quirky_kalam
e7ad4bd564fb   ubuntu:latest               "/bin/bash"              46 minutes ago   Exited (127) 43 minutes ago                            bold_elbakyan
8cd0a9f9675a   docker/whalesay             "cowsay Hello-World"     2 hours ago      Exited (0) 2 hours ago                                 hungry_chaum

# Iniciando o container
docker start ecc1f9240d54
# output
ecc1f9240d54

# Verificando se o container está rodando
docker ps
# output
CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS          PORTS                  NAMES
ecc1f9240d54   nginx     "/docker-entrypoint.…"   5 minutes ago   Up 20 seconds   0.0.0.0:8080->80/tcp   quirky_kalam
```

## Definindo nome do container
* Podemos definiar um nome do container com a **flag `--name`**;
* Se não colocamos, **recebemos um nome aleatório**, o que pode ser um problema para uma aplicação profissional;
* A flag run é inserida junto do comando `docker run`;
```bash
docker run -it --name linux-melhor-que-windows ubuntu
```

## Verificando os logs
* Podemos **verificar o que aconteceu em um container** com o comando `logs`;
* Utilizamos da seguinte maneira: `docker logs <id ou nome do container>`;
* Podemos utilizar a flag `-f` para **acompanhar os logs em tempo real**;
```bash
docker logs linux-melhor-que-windows
```

## Removendo containers
* Podemos **remover um container da máquina** que estamos executando o Docker;
* O comando é `docker -rm <id>`;
* Se o container estiver rodando ainda, podemos utilizar a flag `-f` para forçar a remoção;
* O container removido não é mais listado em `docker ps -a`;
```bash
docker ps -a
# output
CONTAINER ID   IMAGE                       COMMAND                  CREATED             STATUS                        PORTS                    NAMES
fba6f58d722e   ubuntu                      "/bin/bash"              6 minutes ago       Exited (0) 4 minutes ago                               linux-melhor-que-windows
ecc1f9240d54   nginx                       "/docker-entrypoint.…"   20 minutes ago      Exited (0) 4 minutes ago                               quirky_kalam
e7ad4bd564fb   ubuntu:latest               "/bin/bash"              About an hour ago   Exited (127) 59 minutes ago                            bold_elbakyan
8cd0a9f9675a   docker/whalesay             "cowsay Hello-World"     2 hours ago         Exited (0) 2 hours ago                                 hungry_chaum

docker rm fba6f58d722e
fba6f58d722e

docker ps -a
# output
CONTAINER ID   IMAGE                       COMMAND                  CREATED             STATUS                         PORTS                    NAMES
ecc1f9240d54   nginx                       "/docker-entrypoint.…"   21 minutes ago      Exited (0) 5 minutes ago                                 quirky_kalam
e7ad4bd564fb   ubuntu:latest               "/bin/bash"              About an hour ago   Exited (127) About an hour ago                            bold_elbakyan
8cd0a9f9675a   docker/whalesay             "cowsay Hello-World"     2 hours ago         Exited (0) 2 hours ago                                   hungry_chaum
```

# Imagens
## O que é uma imagem?
* Imagens **são originadas de arquivos que programamos** para que o Docker crie uma estrutura que execute determinadas ações em containers;
* Elas contém informações como: imagens base, diretório base, comandos a serem executados, porta da aplicação e etc;
* Ao rodar um container baseado na imagem, **as instruções serão executadas em camadas**;

## Como escolher uma boa 
* Podemos fazer download das imagens em: [Docker Hub](https://hub.docker.com/);
* Porém **qualquer um pode fazer upload de uma imagem**, isso é um problema;
* Devemos então nos atentar as **imagens oficiais**;
* Outro parâmetro interessante é a **quantidade de downloads** e a **quantidade de stars**;

## Criando uma imagem
* Para criar uma imagem vamos precisar de um arquivo _Dockerfile_ em uma pasta que ficará o projeto;
* Este arquivo vai precisar de algumas instruções para poder ser executado;
* `FROM`: imagem base;
* `WORKDIR`: diretório da aplicação;
* `EXPOSE`: porta da aplicação;
* `COPY`: quais arquivos precisam ser copiados para o container;

```bash
# Vamos criar uma aplicação simples em Node.js
# Crie uma pasta e abra seu editor de código e siga as instruções abaixo:
npm init -y
npm install express
touch app.js
```
```js
// Dentro do app.js
const express = require('express')

const app = express()

app.get('/', (req, res)=>{
    res.send('Hello World from docker')
})

app.listen(8080, (req, res)=>{
    console.log('Server running on port 8080')
})
```
* Aqui criamos um simples servidor web com express, que retorna uma mensagem na rota raiz;
* Vamos criar nossa imagem Docker agora:
```bash
touch Dockerfile
```
Imagem:
```Dockerfile
FROM node               <= Imagem base

WORKDIR /app            <= Diretório da aplicação

COPY package*.json .    <= Copiando arquivos package.json e package-lock.json para o diretório da aplicação

RUN npm install         <= Instalando dependências

COPY . .                <= Copiando arquivos para o container 

EXPOSE 8080             <= Porta da aplicação

CMD ["node", "app.js"]  <= Comando a ser executado

```

## Executando uma imagem
* Para executar a imagem primeiramente **vamos precisar fazer o build**;
* O comando é `docker build <diretório do Dockerfile>`;
* Podemos utilizar a flag `-t` para **definir um nome para a imagem**;
* Depois vamos utilizar o `docker run imagem` para executar a imagem;

```bash
docker build -t express_server . #considerando que o terminal está aberto no mesmo diretório do Dockerfile

docker run -p 3000:8080 express_server
```

## Alterando uma imagem
* Sempre que alteramos o código de uma imagem **vamos precisar fazer o build novamente**;
* Para o Docker é como se fosse **uma imagem completamente nova**;
* Após fazer o build vamos executá-la por outro id único criada com o `docker run`;

## Camadas das imagens
* As imagens do Docker são divididas em **camadas** (layers);
* Cada instrução no Dockerfile **representa uma layer**;
* Quando algo é atualizado **apenas as layers depois da linha atualizada são refeitas**;
* O resto permanece em cache, tornando o **build mais rápido**;

## Download de imagens
* Podemos **fazer o download de alguma imagem** do hub e deixa-la disponível em nosso ambiente;
* Vamos utilizar o comando `docker pull <imagem>`;
* Desta maneira, caso se use em outro container, **a imagem já estará pronta para ser utilizada**;

## Aprender mais sobre os comandos
* Todos comando no docker tem acesso a uma **flag --help**;
* Utilizando desta maneira, **podemos ver todas as opções disponíveis nos comandos**;
* Para relembrar algo ou executar uma tarefa diferente com o mesmo;
```bash
#exemplo
docker run --help
```

## Multiplas aplicações, mesmo container
* Podemos inicializar **vários containers com a mesma imagem**;
* As aplicações funcionarão em paralelo;
* Para testar isso, podemos determinar uma **porta diferente** para cada uma, e rodar no **modo detached**;

## Alterando o nome da imagem e tag
* Podemos **nomear a imagem** que criamos;
* Vamos utilizar o comando `docker tag <nome>` para isso;
* Também podemos **modificar a tag**, que seria como uma versão da imagem, semelhante ao git;
* Para inserir a tag utilizamos: `docker tag <nome>:<tag>`;
```bash
docker images
# output
REPOSITORY           TAG       IMAGE ID       CREATED          SIZE  
express_server       latest    7ae03f51fdc1   39 minutes ago   1.1GB 
nginx                latest    021283c8eb95   3 weeks ago      187MB 
ubuntu               latest    5a81c4b8502e   3 weeks ago      77.8MB
bitnami/postgresql   latest    fad69a0c4877   3 months ago     273MB 
docker/whalesay      latest    6b362a9f73eb   8 years ago      247MB

docker tag express_server:latest express_server:1.0.0

docker images
# output
REPOSITORY           TAG       IMAGE ID       CREATED          SIZE  
express_server       1.0.0     7ae03f51fdc1   40 minutes ago   1.1GB 
express_server       latest    7ae03f51fdc1   40 minutes ago   1.1GB 
nginx                latest    021283c8eb95   3 weeks ago      187MB 
ubuntu               latest    5a81c4b8502e   3 weeks ago      77.8MB
bitnami/postgresql   latest    fad69a0c4877   3 months ago     273MB 
docker/whalesay      latest    6b362a9f73eb   8 years ago      247MB
```

## Removendo imagens
* Assim como nos containers, **podemos remover imagens com um comando**;
* O comando é `docker rmi <id ou nome da imagem>`;
* Imagens que estão sendo utilizadas por um container, apresentarão um erro no terminal;
* Podemos utilizar a **flag -f** para forçar a remoção;
```bash
docker images
#output
REPOSITORY           TAG       IMAGE ID       CREATED          SIZE  
express_server       1.0.0     7ae03f51fdc1   47 minutes ago   1.1GB 
express_server       latest    7ae03f51fdc1   47 minutes ago   1.1GB 
nginx                latest    021283c8eb95   3 weeks ago      187MB 
ubuntu               latest    5a81c4b8502e   3 weeks ago      77.8MB
bitnami/postgresql   latest    fad69a0c4877   3 months ago     273MB 
docker/whalesay      latest    6b362a9f73eb   8 years ago      247MB

docker rmi -f 7ae03f51fdc1
```

## Removendo imagens e containers
* Com o comando `docker system prune`;
* Podemos **remover imagens, containers e networks** não utilizados;
* O sistema irá exigir uma confirmação para realizar a remoção;
```bash
docker system prude
```

## Removendo container após utilizar
* Um container pode ser automaticamente deletado após sua utilização;
* Para isso utilizamos a flag `--rm` no comando `docker run`;
* O comando `docker run --rm <imagem>` irá executar o container e logo após deletá-lo;
* Desta maneira **não precisamos nos preocupar em deletar o container** após sua utilização;
```bash
docker run --rm ubuntu
```

## Copiando arquivos entre containers
* Para cópia de arquivos entre containers utilizamos o comando: `docker cp`;
* Pode ser utilizado para copiar um arquivo de um diretório para um container;
* Ou de um container para um diretório;
* Abra dois terminais para o teste:
```bash
# docker promp
docker run -it --rm ubuntu
```
```bash
# seu Pc promp
mdkir testeToCopy
cd testeToCopy
touch teste.txt
cd ..

docker ps
# output
CONTAINER ID   IMAGE     COMMAND       CREATED         STATUS         PORTS     NAMES
d5c6e1111edf   ubuntu    "/bin/bash"   2 minutes ago   Up 2 minutes             musing_gould

docker cp ./testToCopy d5c6e1111edf:.
# Explicações:
# ./testToCopy -> diretório que queremos copiar
# d5c6e1111edf -> id do container que queremos copiar
# . -> diretório que queremos colar

# Podemos também copiar arquivos de um container para um diretório
docker cp d5c6e1111edf:./testToCopy/test.txt .
# Explicações:
# d5c6e1111edf -> id do container que queremos copiar
# ./testToCopy/test.txt -> arquivo que queremos copiar
# . -> diretório que queremos colar
```

## Verificar informações de processamento
* Para verificar dados de execução de um container utilizamos o comando `docker top <id ou nome do container>`;
* Desta maneira temos acesso a quando ele foi iniciado, id do processo, descrição do CMD;

## Verificar dados de um container
* Para verificar diversas informações como: **id, data de criação, imagem e muito mais**;
* Utilizamos o comando `docker inspect <id ou nome do container>`;
* Desta maneira temos acesso a diversas informações sobre o container;

## Verificar processamento
* Para verificar os processos que estão sendo executados em um container, utilizamos o comando: `docker stats`;
* Desta maneira temos acesso ao andamento do processamento e memória utilizada;

## Autenticação no Docker Hub
* Para concluir esta etapa, vamos precisar de uma conta no Docker Hub;
* Para autenticar-se pelo terminal vamos utilizar o comando `docker login`;
* E então inserir o usuário e senha;
* Agora podemos **enviar nossas próprias imagens** para o HUB.
tza2wv9yXW6XzWM
```bash
docker login
## output
Login with your Docker ID to push and pull images from Docker Hub. If you don't have a Docker ID, head over to https://hub.docker.com to create one.
Username: <seu usuário>
Password: <sua senha>
```

## Enviando imagem para o Docker Hub
* Para enviar uma imagem nossa ao Docker Hub utilizamos o comando `docker push <imagem>`;
* Porém antes vamos precisar **criar o repositório** para a imagem no site do Hub;
* Após criar o repositório, vamos precisar **renomear a imagem** para que ela seja enviada ao repositório correto;
    * `docker tag <imagem> <usuário>/<nome do repositório>:<tag>`;
* Também será necessário **estar autenticado**;
* Depois de enviar a imagem, podemos baixar ela com o comando `docker pull <imagem>`;


## Logout do Docker Hub
* Para remover a conexão entre nossa máquina e o Docker Hub, vamos utilizar o comando `docker logout`;
* Agora não podemos mais enviar imagens, pois não estamos autenticados;
```bash
docker logout
```

## Enviando atualização de imagem
* Para enviar uma atualização **vamos primeiramente fazer o build**;
* **Trocando a tag da imagem** para a nova versão;
* **Depois vamos fazer um push** novamente para o repositório;
* Assim todas as versões estarão disponíveis para serem utilizadas

## Baixando e utilizando a imagem
* Para baixar a imagem podemos utilizar o comando `docker pull <imagem>`;
* Depois de baixar, podemos utilizar o comando `docker run <imagem>`;
* Desta maneira a imagem será executada em um container;

# Volumes
## O que são volumes?
* Uma **forma de persistir dados** em uma aplicação e não depender de containers para isso;
* **Todo dado criado por um container é salvo nele**, quando o container é removido, os dados também são;
* Então precisamos dos volumes para gerenciar os dados e também conseguir **fazer backups** de forma mais simples;

## Tipos de volumes
* **Anonymous volumes**: Diretórios criados pela **flag -v**, porém com um nome aleatório;
* **Named volumes**: São volumes com nomes, podemos nos referir a estes facilmente e saber para que são utilizados no nosso ambiente;
* **Bind mounts**: Uma forma de salvar dados na nossa máquina, sem o gerenciamento do Docker, informamos um diretório para este fim;

## O problema da persistência
* Se criarmos um container com alguma imagem, **todos os arquivos que geramos dentro dele setão do container**;
* Quando o container for removido, perderemos estes arquivos;
* Por isso precisamos dos **volumes**;
* Vamos criar um exemplo prático com php:
```bash
mkdir project-volume
cd project-volume
touch Dockerfile
```
```Dockerfile
# Docker
FROM php:8-apache

WORKDIR /var/www/html

COPY . .

EXPOSE 80

RUN chown -R www-data:www-data /var/www
```
```bash
#prompt
# Dentro da pasta project-volume
touch index.php
touch process.php
mkdir messages
```
```php
#index.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens</title>
</head>
<body>
    <h1>Escreva sua mensagem:</h1>
    <form action="process.php" method="POST">
        <input type="text" name="message" id="message" placeholder="Escreva...">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
```
```php
# process.php
<?php

$message = $_POST["message"];

$files = scandir("./messages");
$num_files = count($files) - 2; // . e ..

$fileName = "msg-{$num_files}.txt";

$file = fopen("./messages/{$fileName}", "x");

fwrite($file, $message);

fclose($file);

header("Location: index.php");
```
Agora que o setup está pronto, vamos criar a imagem e executar o container:
```bash
docker build -t php-volume:1.0 .
docker run -d -p 80:80 --name php-container php-volume:1.0
```
* Agora podemos acessar no navegador `localhost:80` e enviar mensagens, assim as mensagens serão salvas no container;
* Porém se removermos o container, as mensagens serão perdidas;
* Você pode verificar as mensagens na url `localhost/messages/msg-0.txt`;

## Volumes anônimos
* Podemos criar um volume anônimo da seguinte maneira: `docker run -v /data`
* Onde **/data** será o diretório que contém o volume anônimo;
* E este container estará atrelado ao volume anônimo;
* Com o comando `docker volume ls` podemos verificar os volumes anônimos criados;
```bash
docker run -d -p 80:80 --name php-container -v /data php-volume:1.0
```

## Volumes nomeados
* Podemos criar um volume nomeado da seguinte maneira: `docker run -v <nome do volume>:/data`
* Agora o volume tem um nome e pode ser facilmente referenciado;
* Em `docker volume ls` podemos verificar os volumes nomeados criados;
* Da mesma maneira que o anônimo, este volume tem como função armazenar arquivos;
```bash
docker run -p 80:80 -d --rm --name php-container -v phpvolume:/var/www/html php-volume:1.0
# Agora podemos ir em localhost:80 e enviar mensagens, elas serão salvas no volume

#parando container e removendo ele
docker stop php-container

#verificando se o volume ainda existe
docker volume ls
# output
local     phpvolume

# criando um novo container com o mesmo volume
docker run -p 81:80 -d --rm --name php-container2 -v phpvolume:/var/www/html php-volume:1.0

# agora podemos acessar localhost:81/messages/msg-0.txt e ver as mensagens que enviamos anteriormente
```

## Bind mounts
* **Bind mount** também é um volume, porém ele fica em um diretório que nós especificamos;
* Então não criamos um volume e sim **apontamos para um diretório**;
* O comando para criar um bind mount é: `docker run -v "/dir/data:/data"`;
* Desta maneira o diretório **/dir/data** no nosso computador, será o volume deste container;
```bash
docker run -d -p 80:80 --name php-container -v "/home/ash/Desktop/Projects/Docker/project-volume/messages":/var/www/html/messages --rm php-volume:1.0
```

## Atualização do projeto com bind mount
* **Bind mount** não serve apenas para volumes!
* Podemos utilizar esta técnica para **atualização em tempo real do projeto**;
* Sem ter que refazer o build a cada atualização do mesmo;
* Vamos ver na prática:
```bash
# Note que diferente do exemplo anterior, não temos o diretório messages, e sim a raiz do projeto
docker run -d -p 80:80 --name php-container -v "/home/ash/Desktop/Projects/Docker/project-volume":/var/www/html/ --rm php-volume:1.0
```
Agora podemos ir no nosso projeto e alterar o arquivo `index.php`:
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type=text] {
            width: 50%;
            height: 200px;
            margin-bottom: 20px;
        }
        button {
            width: 100px;
            height: 30px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Escreva sua mensagem:</h1>
    <form action="process.php" method="POST">
        <input type="text" name="message" id="message" placeholder="Escreva...">
        <button type="submit">Enviar</button>
    </form>
    <h2>Hello World</h2>
</body>
</html>
```
Agora basta dar um F5 na página que o projeto será atualizado!

## Criar um volume
* Podemos criar volumes manualmente também;
* Utilizamos o comando: `docker volume create <nome>`
* Desta maneira temos um **named volume** criado, podemos atrelar a algum container na execução do mesmo;
```bash
docker volume create volumetest

docker volume ls

docker run -d -p 80:80 --name php-container -v volumetest:/var/www/html/ --rm php-volume:1.0

# vá no navegador e acesse localhost:80 e crie uma msg
# acesse a msg em localhost:80/messages/msg-0.txt

docker stop php-container

docker run -d -p 80:80 --name php-container-2 -v volumetest:/var/www/html/ --rm php-volume:1.0

# Verifique que a msg ainda está lá
# localhost:80/messages/msg-0.txt
```

## Listar todos os volume
* Com o comando `docker volume ls` podemos listar todos os volumes;
* Desta maneira temos acesso a todos os volumes que estão sendo utilizados, **named e anonymous**;
* Podemos também **verificar informações de um volume específico** com o comando `docker volume inspect <nome do volume>`;
```bash
docker volume ls
# output
DRIVER    VOLUME NAME
local     volumetest
local     phpvolume

docker volume inspect volumetest
# output
[
    {
        "CreatedAt": "2023-07-26T02:50:49-03:00",
        "Driver": "local",
        "Labels": null,
        "Mountpoint": "/var/lib/docker/volumes/volumetest/_data", # diretório onde o volume está sendo salvo no nosso computador
        "Name": "volumetest",
        "Options": null,
        "Scope": "local"
    }
]
```

## Remover volumes
* Podemos remover volumes com o comando `docker volume rm <nome do volume>`;
* Porém **o volume precisa estar desatrelado de qualquer container**;
* Podemos utilizar a flag `-f` para forçar a remoção;
* Observe que **os dados serão removidos todos também**, tome cuidado com este comando;
```bash
docker volume ls

docker volume rm volumetest

docker volume ls
# output
DRIVER    VOLUME NAME
local     phpvolume
```

## Remover volumes não utilizados
* Podemos remover volumes não utilizados com o comando `docker volume prune`;
* Desta maneira **todos os volumes que não estão sendo utilizados serão removidos**;
* Podemos utilizar a flag `-f` para forçar a remoção;
```bash
docker volume ls

docker volume create volumetest
docker volume create volumetest2
docker volume create volumetest3
docker volume create volumetest4

docker volume ls
# output
DRIVER    VOLUME NAME
local     volumetest
local     volumetest2
local     volumetest3
local     volumetest4
local     phpvolume

docker volume prune
# output
WARNING! This will remove all local volumes not used by at least one container.
Are you sure you want to continue? [y/N] y

docker volume ls
# output
DRIVER    VOLUME NAME
local     phpvolume
```

## Volume apenas para leitura
* Podemos criar um volume que tem **apenas permissão de leitura**, isso é útil em algumas aplicações;
* Para realizar esta configuração utilizar o comando: `docker run -v volume:/data:ro`;
* Este **:ro** é a abreviação de **read only**;

# Networks
## O que são Networks no Docker?
* **Uma forma de gerenciar a conexão do Docker** com outras plataformas ou até mesmo entre containers;
* As redes ou networks são **criadas separadas do container**, como os volumes;
* Além disso existem alguns **drivers de rede**, que veremos em seguida;
* Uma rede deixa muito simples a comunicação entre containers;

## Tipos de conexão
* Os containers constumam ter três principais tipos de comunicação:
* **Externa**: conexão com uma API de um servidor remoto;
* **Com o host**: comunicação com a máquina que está executando o Docker;
* **Entre containers**: comunicação que utiliza o _driver bridge_ e permite a comunicação entre dois ou mais containers;

## Tipos de driver
* **Bridge**: o mais comum e default do Docker, utilizado quando containers precisam se conectar (na maioria das vezes optamos por este drive);
* **Host**: permite a conexão entre um container a máquina que está hosteando o Docker;
* **Macvlan**: permite a conexão a um container por um MAC address;
* **None**: remove todas as conexões de rede de um container;
* **Plugins**: permite extensões de terceiros para criar outras redes;

## Listando redes
* Podemos verificar todas as redes do nosso ambiente com: `docker network ls`;
* **Algumas redes já estão criadas**, estas fazem parte da configuração inicial do Docker;

## Criando redes
* Para criar um rede vamos utilizar o comando `docker network create <nome da rede>`;
* Esta rede será do tipo _bridge_, que é o mais utilizado;
* Podemos criar diversas redes;
```bash
docker network create my-network

docker network ls
# Criando rede com outro drive
docker network create -d macvlan my-macvlan-network

docker network ls
```

## Removendo redes
* Podemos remover redes com o comando `docker network rm <nome da rede>`;
* Porém **a rede precisa estar desatrelada de qualquer container**;
* Podemos utilizar a flag `-f` para forçar a remoção;
```bash
docker network ls

docker network rm my-network

docker network ls

docker network rm my-macvlan-network
```

## Removendo redes em massa
* Podemos remover todas as redes que não estão sendo utilizadas com o comando `docker network prune`;
* Desta maneira **todas as redes que não estão sendo utilizadas serão removidas**;
* Podemos utilizar a flag `-f` para forçar a remoção;
```bash
docker network ls

docker network create my-network

docker network ls

docker network prune
# output
WARNING! This will remove all networks not used by at least one container.
Are you sure you want to continue? [y/N] y

docker network ls
```

## Conexão externa
* Os containers **podem se conectar livremente ao mundo externo**;
* Um caso seria: uma API de código aberto;
* Podemos acessá-la livremente e utilizar seus dados;
* Vamos testar!
```bash
mkdir external-connection
cd external-connection
touch Dockerfile
```
```Dockerfile
FROM pyhton:latest

RUN apt-get update -y && apt-get install -y python3-pip pyhton3-dev

WORKDIR /app

RUN pip install flask
RUN pip install requests

COPY . .

EXPOSE 5000

CMD ["python3", "./app.py"]
```
```bash
touch app.py
```
```py
import flask
from flask import request, json, jsonify
import requests

app = flask.Flask(__name__)
app.config["DEBUG"] = True

@app.route('/', methods=['GET'])
def index():
    data = requests.get('https://randomuser.me/api')
    return data.json()

if __name__ == "__main__":
    app.run(host="0.0.0.0", debug=True, port=5000)
```
```bash
docker build -t flask-server .

docker run -d -p 5000:5000 --name flask-container flask-server

## http://localhost:5000/ <= acessar no navegador ou postman
```

## Conexão com o host
* Podemos **conectar um container com o host**;
* Desta maneira o container terá acesso a máquina que está executando o Docker;
* como ip de host utilizamos: `host.docker.internal`;

## Conexão entre containers
* Podemos também estabelecer uma **conexão entre containers**;
* Duas imagens distintas rodando em **containers separados que precisam se conectar para inserir um dado no banco**, por exemplo;
* Vamos precisar de uma rede **bridge**, para fazer essa conexão;
* Agora nosso container de flask vai inserir dados em um MySQL que roda pelo Docker também;
* Vamos primeiro alterar nossa estrutura de pastas:
```bash
# Estrutura de pastas
external-connection/
├── flask-server/
│   ├── app.py
│   └── Dockerfile
└── mysql-server/
    ├── Dockerfile
    └── schema.sql
```
Depois de criado as pastas, vamos criar o Dockerfile do MySQL:
```Dockerfile
USER mysql:5.7

COPY schema.sql /docker-entrypoint-initdb.d

EXPOSE 3306

VOLUME ["/backup/"]
```
Depois de criar o volume, vamos alterar nosso **schema.sql**
```sql
CREATE DATABASE flaskdocker;
USE flaskdocker;

CREATE TABLE `flaskdocker`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`));
```
Agora que o schema e o Dockerfile estão configurados, vamos criar a imagem:
```bash
cd mysql-server
docker build -t mysql-server-network .
```
Agora que a build está pronta, vamos criar uma rede para conectar os containers:
```bash
docker network create api-network
```
Agora que a build e a network já estão configurados, vamos criar o container do MySQL:
```bash
docker run -d -p 3306:3306 --name mysql-container --network api-network -e MYSQL_ALLOW_EMPTY_PASSWORD=True mysql-server-network
# Explicações:
# -d => modo detached
# -p => porta do container:porta do host
# --name => nome do container
# --network => rede que o container vai utilizar
# -e => variável de ambiente
# MYSQL_ALLOW_EMPTY_PASSWORD=True => permite que o container seja iniciado sem senha

```
Agora vamos alterar nosso **app.py** da api em Flask:

```py
import flask
from flask import request, json, jsonify
import requests
import flask_mysqldb
from flask_mysqldb import MySQL

app = flask.Flask(__name__)
app.config["DEBUG"] = True

app.config['MYSQL_HOST'] = 'mysql-container'	#Nome do container do MySQL é o host já que estão na mesma rede!!
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'flaskdocker'

mysql = MySQL(app)

@app.route('/', methods=['GET'])
def index():
    data = requests.get('https://randomuser.me/api')
    return data.json()

@app.route("/inserthost", methods=['POST'])
def inserthost():
  data = requests.get('https://randomuser.me/api').json()
  username = data['results'][0]['name']['first']

  cur = mysql.connection.cursor()
  cur.execute("""INSERT INTO users(name) VALUES(%s)""", (username,))
  mysql.connection.commit()
  cur.close()

  return username


if __name__ == "__main__":
    app.run(host="0.0.0.0", debug=True, port=5000)
```
Por ultimo vamos alterar nosso Dockerfile do flask:
```Dockerfile
FROM python:3

RUN apt-get update -y && \
  apt-get install -y python3-pip python3-dev

WORKDIR /app

RUN pip install Flask requests flask_mysqldb

COPY . .

EXPOSE 5000

CMD ["python3", "./app.py"]
```
Agora vamos criar a imagem do flask:
```bash
cd flask-server
docker build -t flask-server-network .
```
Agora vamos criar o container do flask:
```bash
docker run -d -p 5000:5000 --name flask-container --network api-network flask-server-network
```

## Conectar container
* Podemos conectar um container a uma rede já existente;
* Para isso utilizamos o comando `docker network connect <nome da rede> <nome do container>`;
* Desta maneira o container estará conectado a rede;
```bash
docker network ls
NETWORK ID     NAME                       DRIVER    SCOPE
f1497256659b   api-network                bridge    local

docker stop flask-container
docker rm flask-container

docker run -d -p 5000:5000 --name flask-container flask-server-network

docker network connect api-network flask-container

docker network inspect api-network
```

## Desconectar container
* Podemos desconectar um container de uma rede;
* Para isso utilizamos o comando `docker network disconnect <nome da rede> <nome do container>`;
* Desta maneira o container estará desconectado da rede;
```bash
docker network ls
NETWORK ID     NAME                       DRIVER    SCOPE
f1497256659b   api-network                bridge    local

docker network disconnect api-network flask-container

docker network inspect api-network
```

# YAML
## O que é YAML?
* Uma linguagem de serialização, seu nome é **YAML aind't Markup Language** (YAML não é uma linguagem de marcação);
* Usada geralmente para arquivos de configuração, inclusive do Docker, para configurar o **Docker Compose**;
* É de fácil leitura para nós humanos;
* A extensão dos arquivos é `yml` ou `yaml`;

## Criando nosso primeiro arquivo YAML
* O arquivo `.yaml` geralmente possui chaves e valores;
* Que é de onde vamos retirar as configurações do nosso sistema;
* Para definir uma chave apenas inserimos o nome dela, em seguida colocamos `:` e depois o valor;
* Vamos criar um arquivo um programa em Python que lê **YAML**:
```bash
mkdir YAML
cd YAML
touch app.py
# Caso não tenha o pip3 instalado
sudo apt install python3-pip

pip3 install pyyaml
```
```py
import yaml
if __name__ == "__name__":
    stream = open("test.yaml", "r")
    dictionary = yaml.safe_load(stream)

    for key, value in dictionary.items():
        print(key, ":", value)
```
Crie um arquivo chamado **test.yaml**:
```yaml
nome: "Victor"
idade: 20
```
Agora basta rodar o programa:
```bash
python3 app.py
```

## Espaçamento e indentação
* O **fim de uma linha** indica o fim de uma instrução, não há ponto e vírgula;
* A indentação deve conter **um ou mais espaços**, e não devemos utilizar tab;
* E cada uma define um novo bloco;
* O **espaço é obrigatório** após a declaração da chave;
* Para criar comentários, basta colocar `#` no inicio da linha;
* Vamos ver na prática!
    * Se não criou o arquivo Python do exemplo anterior, crie;
```yaml
# estrutura não válida
nome:"Victor"
idade: 20

## para ver o erro execute o programa python

# estrutura válida com indentação
objeto:
  versao: 1.0
  data: 2020-01-01
  ativo: true

##  rode o programa python para ver o resultado

# Tipos de dados
# String
nome: "Victor"
sobrenome: Hugo

# Inteiro
idade: 20

# Float
altura: 1.80

# Boolean
ativo: Off #ou false

# Listas
lista:
  - item1
  - item2
  - item3

# Dicionários
dicionario:
  chave1: valor1
  chave2: valor2
  chave3: valor3

# Nulo
nulo: null # ou ~
```

# Docker Compose
## O que é Docker Compose?
* O **Docker Compose** é uma ferramenta para definir e executar aplicações Docker de múltiplos containers;
* Teremos apenas um arquivo de configuração, que orquestra totalmente esta situação;
* É uma forma de rodar **múltiplos containers** de uma só vez;
* Com o **Compose** podemos rodar múltipos `builds e runs` com um comando;
* Em **projetos maiores** é essencial o uso do Compose;

## Instalando docker compose no Linux
* **Usuários de Linux** ainda não possuem a ferramente que utilizaremos nesta seção;
* Vamos seguir as instruções de instalação do site [oficial](https://docs.docker.com/compose/install/);
* **docker compose** é essencial para atingir o objetivo desta seção;

## Criando nosso primeiro Compose
* Primeiramente vamos criar um arquivo chamado **docker-compose.yml** na raiz do projeto;
* Este arquivo vai **coordenar os containers e imagens**, e possui algumas chaves muito utilizadas;
* `version`: versão do compose;
* `services`: serviços que serão utilizados;
* `volumes`: Containers/serviços que vão rodar nesta aplicação

```bash
mkdir docker-compose
cd docker-compose
touch docker-compose.yaml
docker compose version
docker compose --help
```
```yaml
version: '3.3' # Versão do compose

services:   # Serviços que serão utilizados
  db:   # nome do serviço de mysql é "db"
    image: mysql:5.7 # imagem que será utilizada
    volumes: # volumes que serão utilizados
      - db_data:/var/lib/mysql
    restart: always # sempre que reiniciar o container, ele será reiniciado
    environment: # variáveis de ambiente
      MYSQL_ROOT_PASSWORD: wordpress
      MYSQL_DATABASE: wordpress
      MYSQL_USER: ash
      MYSQL_PASSWORD: secret

  wordpress: # nome do serviço de wordpress é "wordpress"
    depends_on: # depende do serviço "db"
      - db
    image: wordpress:latest    # imagem que será utilizada
    ports: # porta que será utilizada
      - "8000:80"
    restart: always
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_USER: ash
      WORDPRESS_DB_PASSWORD: secret
      WORDPRESS_DB_NAME: wordpress

volumes: # volumes que serão utilizados nos containers
db_data: {}
```

## Rodando o Compose
* Para rodar nossa estrutura em Compose, vamos utilizar o comando: `docker-compose up`;
* Podemos rodar o Compose em **background** com o comando: `docker-compose up -d`;
* Isso fará com que as **instruções no arquivo sejam executadas**
* Da mesma forma que realizamos os builds e runs, o Compose fará isso para nós;
* Podemos parar o Composer com `Ctrl + C`;

## Parando o Compose
* Para parar o Compose, basta executar o comando: `docker-compose down`;
* Isso fará com que os containers sejam parados e removidos;
* Para remover os volumes também, basta executar o comando: `docker-compose down --volumes`;

## Variáveis de ambiente
* Podemos utilizar variáveis de ambiente no Compose;
* Para isso, vamos definir um arquivo base em **env_file**;
* As váriaveis podem ser chamadas pela sintaxe: `${NOME_DA_VARIAVEL}`;
* Esta técnica é útil quando o dado a ser inserido é **sensível/não pode ser compartilhada**, como uma senha;
```bash
mkdir variaveis
cd variaveis
touch docker-compose.yaml
mkdir config
cd config
touch db.env
touch wp.env
```
* Configuração de pastas realizado
```env
# wp.env


WORDPRESS_DB_HOST=db:3306
WORDPRESS_DB_USER=ash
WORDPRESS_DB_PASSWORD=secret
WORDPRESS_DB_NAME=wordpress
```
* Configuração de variáveis de ambiente realizada para o wordpress
```env
# db.env

MYSQL_ROOT_PASSWORD=wordpress
MYSQL_DATABASE=wordpress
MYSQL_USER=ash
MYSQL_PASSWORD=secret

```
* Configuração de variáveis de ambiente realizada para o banco de dados
```yaml
version: '3.3'

services:
  db:
    image: mysql:5.7
    volumes:
      - db-data:/var/lib/mysql
    restart: always
    env_file: # arquivo de variáveis de ambiente
      - ./config/db.env

  wordpress:
    depends_on:
      - db
    image: wordpress:latest
    ports:
      - "8000:80"
    restart: always
    env_file:
      - ./config/wp.env
volumes:
  db-data: {}  
```
* Configuração do docker-compose.yaml realizada
    * Agora podemos subir nosso compose:
```bash
docker-compose up -d
```

## Redes no Compose
* O Compose cria uma **rede básica Brigde** entre os containers;
* Porém podemos isolar as redes com a chave `networks`;
* Desta maneira podemos conectar apenas os containers que optamos;
* E podemos **definir drivers diferentes** também;
```bash
mkdir networks
cd networks
touch docker-compose.yaml
```
* **_IMPORTANTE_**, copie o arquivo **db.env** e **wp.env** para a pasta **networks/config**;
```yaml
version: '3.3'

services:
  db:
    image: mysql:5.7
    volumes:
      - db-data:/var/lib/mysql
    restart: always
    env_file: # arquivo de variáveis de ambiente
      - ./config/db.env
    networks: # redes que serão utilizadas
      - backend

  wordpress:
    depends_on:
      - db
    image: wordpress:latest
    ports:
      - "8000:80"
    restart: always
    env_file:
      - ./config/wp.env
    networks: # redes que serão utilizadas
      - backend

volumes:
  db-data: {}
networks: # redes que serão inicializadas
  backend: {}
    driver: bridge # driver que será utilizado

```
* Podemos verificar as redes da mesma forma que vimos nas sessões anteriores;
```bash
docker network ls
# Output
NETWORK ID     NAME                     DRIVER    SCOPE
1f156e4f1b28   networks_backend         bridge    local

docker network inspect networks_backend
```

## Vamos incluir o projeto no Compose
* Agora vamos inserir o nosso projeto da última seção no Compose;
* Para verificar na prática como fazer uma transferência de **Dockerfile** para o **Docker Compose**!
* O projeto em questão é o servidor **Flask** que criamos na seção anterior junto com Banco de Dados **MySQL**;
```bash
mkdir projeto
cd projeto
# Copie os arquivos do projeto anterior para esta pasta
# flask-server e mysql-server
mkdir config
```
* Agora vamos alterar nossa API em Flask para se adequar ao Compose;
```py
import flask
from flask import request, json, jsonify
import requests
import flask_mysqldb
from flask_mysqldb import MySQL 

app = flask.Flask(__name__)
app.config["DEBUG"] = True

app.config['MYSQL_HOST'] = 'db' # nome do serviço no compose	
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'flaskdocker'

mysql = MySQL(app)

@app.route('/', methods=['GET'])
def index():
    data = requests.get('https://randomuser.me/api')
    return data.json()

@app.route("/inserthost", methods=['POST'])
def inserthost():
  data = requests.get('https://randomuser.me/api').json()
  username = data['results'][0]['name']['first']

  cur = mysql.connection.cursor()
  cur.execute("""INSERT INTO users(name) VALUES(%s)""", (username,))
  mysql.connection.commit()
  cur.close()

  return username


if __name__ == "__main__":
    app.run(host="0.0.0.0", debug=True, port=5000)
```
* A primeira alteração que fizemos foi no **host** do banco de dados;
    * Como estamos utilizando o Compose, o nome do host do banco de dados é o nome do serviço;
    * No caso, **db**;
* Agora vamos criar o arquivo **docker-compose.yaml**;
```yaml
version: '3.3'

services:
  db:
    image: mysqlcompose
    restart: always
    env_file:
      - ./config/db.env
    ports:
      - "3306:3306"
    networks:
      - dockercompose
  
  backend:
    depends_on:
      - db
    image: flaskserver
    ports: "5000:5000"
    restart: always
    networks:
      - dockercompose

networks:
  dockercompose:
    driver: bridge
```
* Agora vamos criar o arquivo **db.env** na pasta **config**;
```env
MYSQL_ALLOW_EMPTY_PASSWORD=True
```
* Agora vamos começar a alterar nosso **Dockerfile** do servidor Mysql;
```dockerfile
FROM mysql:5.7

COPY schema.sql /docker-entrypoint-initdb.d/

EXPOSE 3306

# VOLUME ["/backup/"] <Não precisamos passar o volume para esse projeto>

```
* Todas as configurações foram realizadas nesse ponto, agora só precisamos gerar as builds e subir o compose;
* Se você perceber no arquivo **docker-compose.yaml** as imagens que estamos utilizando são **mysqlcompose** e **flaskserver**;
* Então para subir o compose corretamente, precisamos gerar as builds com esses nomes;
```bash
cd mysql-server
docker build -t mysqlcompose .

cd ../flask-server
docker build -t flaskserver .

cd ..
docker compose up -d
```
* Pronto, tudo funcionando corretamente!

## Build no Compose
* Podemos realizar o **build durante o Compose** também!
* Isso vai **eliminar o processo de gerar o build da imagem** a cada alteração;
* Para isso, basta adicionar a chave **build** no compose;
```yaml
version: '3.3'

services:
  db:
    build: ./mysql-server # build da imagem
    restart: always
    env_file:
      - ./config/db.env
    ports:
      - "3306:3306"
    networks:
      - dockercompose
  
  backend:
    depends_on:
      - db
    build: ./flask-server # build da imagem
    ports: 
      - "5000:5000"
    restart: always
    networks:
      - dockercompose

networks:
  dockercompose:
    driver: bridge
```
* Podemos fazer uma alteração no código e subir o compose;
```py
import flask
from flask import request, json, jsonify
import requests
import flask_mysqldb
from flask_mysqldb import MySQL 

app = flask.Flask(__name__)
app.config["DEBUG"] = True

app.config['MYSQL_HOST'] = 'db'	
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'flaskdocker'

mysql = MySQL(app)

@app.route('/', methods=['GET'])
def index():
    data = requests.get('https://randomuser.me/api')
    return data.json()

@app.route("/inserthost", methods=['POST'])
def inserthost():
  data = requests.get('https://randomuser.me/api').json()
  username = data['results'][0]['name']['first']

  cur = mysql.connection.cursor()
  cur.execute("""INSERT INTO users(name) VALUES(%s)""", (username,))
  mysql.connection.commit()
  cur.close()

  return username

# Adicionamos essa rota para listar os hosts inseridos no banco de dados
@app.route("/listhost", methods=['GET'])
def listhost():
  cur = mysql.connection.cursor()
  cur.execute("""SELECT * FROM users""")
  rv = cur.fetchall()
  return jsonify(rv)


if __name__ == "__main__":
    app.run(host="0.0.0.0", debug=True, port=5000)
```
* Agora podemos subir o compose sem a necessidade de gerar o build antes;
```bash
docker compose up -d
```

## Bind mount no Compose
* O volume de **Bind mount garante atualização em tempo real dos arquivos do container**
* Podemos configurar nosso projeto de Compose para utilizar o **Bind mount**;
* Para isso, vamos alterar o arquivo **docker-compose.yaml**;
```yaml
version: '3.3'

services:
  db:
    build: ./mysql-server
    restart: always
    env_file:
      - ./config/db.env
    ports:
      - "3306:3306"
    networks:
      - dockercompose
  
  backend:
    depends_on:
      - db
    build: ./flask-server
    ports: 
      - "5000:5000"
    restart: always
    volumes: # Adicionamos volume e passamos o caminho do projeto : caminho do container que está configurado no Dockerfile
      - /home/ash/Desktop/Projects/Docker/Compose/projeto/flask-server:/app
    networks:
      - dockercompose

networks:
  dockercompose:
    driver: bridge
```

## Verificando o que tem no Compose
* Podemos fazer a verificação do compose com o comando `docker compose ps`;
* Recebemos um **resumo dos serviços que sobem** ao rodar o compose;
* Desta maneira podemos avaliar rapidamente se o compose está funcionando corretamente;
```bash
docker compose ps
```

# Docker Swarm
## O que é orquestração de containers?
* Orquestação é o ato de consguir **gerenciar e escalar** os containers da nossa aplicação;
* Teamos**um serviço que rege sobre outros serviços**, verificando se os mesmos estão funcionando como deveriam;
* Desta forma conseguimos garantir uma aplicação saudável e também que esteja sempre disponível;
* Alguns serviços: **Docker Swarm, Kubernetes e Apache Mesos**;

## O que é Docker Swarm?
* O Docker Swarm é uma **ferramenta nativa do Docker** para **orquestração de containers**;
* Podemos **escalar horizontalmente** nossos projetos de maneira simples;
* O famoso **Cluster**!
* A **facilidade do Swarm** para outros orquestradores é que todos os comandossão muito semelhantes aos do Docker;
* Toda instalação do Docker já vem com o Swarm, porém precisamos **inicializar o Swarm**;

## Conceitos fundamentais
* **Nodes**: é uma instância (máquina) que participa do Swarm;
* **Manager Node**: Node que gerencia os demais Nodes;
* **Worker Node**: Node que trabalham em função do Manager Node;
* **Service**: Um conjunto de Tasks que o Manager Node manda o Work node executar;
* **Task**: Comando que são executados nos Nodes;

## Inicializando o Swarm
* Para exemplificar corretamente os Swarm, vamos precisar de _Nodes_, ou seja, **mais máquinas**;
* Então temos duas soluções:
  * **AWS**, criar a conta e rodar alguns servidores (precisa de cartão de crédito, mas é gratuito);
  * **Docker Labs**, gratuito também, roda no navegador, porém expira a cada 4 horas;

## AWS
* Criar uma conta na AWS;
* Criar 3 instância EC2 chamadas de **Node1, Node2 e Node3**;
* Escolher a imagem **AMAZON LINUX 2023 AMI**;
* Escolher o tipo **t2.micro**;
* Nesse ponto, você deve ter o minimo de conhecimento para criar uma estrutura na AWS;
* Security Groups
  * HTTP: 80
  * SSH: 22
  * Docker: 2377
* Criar uma chave SSH e baixar o arquivo .pem;
* Acessar a instância via SSH;
* Instalar o Docker;
```bash
# Node 1
ssh -i "SuaChaveSSH.pem" ec2-user@ec2-seu-ip-de-instancia.compute.amazonaws.com

## AWS
sudo yum update -y
sudo yum install docker
sudo service docker start
sudo usermod -a -G docker ec2-user
sudo docker swarm init
# Para sair do docker swarm
sudo docker swarm leave --force
```
* _**NESSE PONTO, VAMOS UTILIZAR SOMENTE AWS PARA CONSTRUIR NOSSA APLICAÇÃO**_

## Iniciando o Swarm
* Podemos iniciar o Swarm com o comando `docker swarm init`;
* Em alguns casos precisamos declarar o IP do Node Manager, para isso podemos usar o comando `docker swarm init --advertise-addr <IP>`;
* Isso fará com que o Node Manager seja iniciado com o IP que passamos;
```bash
# Node 1
ssh -i "SuaChaveSSH.pem" ec2-user@ec2-seu-ip-de-instancia.compute.amazonaws.com
sudo docker swarm init --advertise-addr <IP> # O IP é o IP da instância e pode ser encontrado no console da AWS

# Nesse ponto ele vai gerar um comando parecido com esse:
# docker swarm join --token SWMTKN-etx-etx-etx <ip>:2377
# Salve esse comando em um txt, vamos precisar depois
```

## Listando Nodes ativos
* Podemos verificar quais Nodes estão ativos com: `docker node ls`;
* Desta forma os serviços serão exibidos no terminal;
* Podemos assim **monitorar o que o Swarm está orquestrando**;
* Este comando será de grande utilidade a medida que formos adicionando serviços no Swarm;
```bash
sudo docker node ls
```

## Adicionando novos Nodes
* Podemos adicionar novos Nodes ao Swarm com o comando `docker swarm join --token <TOKEN> <IP>:<PORT>`;
* O token é gerado quando inicializamos o Swarm;
* Esta nova máquina entra na hierarquia de Nodes, ou seja, ela é um Worker Node;
* Todas as ações (**Tasks**) utilizadas na Manager, serão replicadas em Nodes que são Workers;
* O comando join é gerado quando inicializamos o Swarm, lembre que eu pedi para você salvar o comando em um txt;
* Caso não tenha salvo, você pode gerar um novo comando com o comando `docker swarm join-token worker`;
```bash
# Node 2
ssh -i "SuaChaveSSH.pem" ec2-user@ec2-seu-ip-de-instancia.compute.amazonaws.com

## AWS
sudo yum update -y
sudo yum install docker
sudo service docker start
sudo usermod -a -G docker ec2-user

# Nesse ponto, vamos utilizar o comando que salvamos no txt
sudo docker swarm join --token SWMTKN-etx-etx-etx <ip>:2377
```
* Repita o processo para o Node 3;
* Agora temos 3 Nodes, sendo 1 Manager e 2 Workers;

## Subindo um novo serviço
* Podemos iniciar um novo serviço com o comando `docker service create --name <NOME> <IMAGE>`;
* Desta forma teremos um container novo sendo adicionado ao nosso Manager;
* E este serviço estará sendo gerenciado pelo Swarm;
* Podemos testar com o ngix, **liberando a porta _80_** o container já estará disponível;
```bash
# Node 1
sudo docker service create --name nginxswarm -p 80:80 nginx
```
* Podemos verificar o serviço com o comando `docker service ls`;
* Desta forma podemos ver o serviço que está rodando no Swarm;
* Para confirmar, podemos pegar o IP da instancia e acessar no navegador;

## Removendo um serviço
* Podemos remover um serviço com o comando `docker service rm <NOME>`;
* Desta maneira o serviço será removido do Swarm;
* Isso ppode significar: **parar um container que está rodando** e outras consequências devido a parada do mesmo;
* Checamos a remoção com o comando `docker service ls`;
```bash
# Node 1
sudo docker service ls

sudo docker service rm nginxswarm

sudo docker service ls

```

## Replicando serviços
* Podemos criar um serviço com um número maior de réplicas: `docker service create --name >NOME> --replicas <NUMERO> <IMAGE>`;
* Desta maneira uma task será emitida, replicando este serviço nos Workers;
* Agora iniciamos de fato a **orquestração**;
* Podemos checar o status com o comando `docker service ls`;
```bash
# Node 1
sudo docker service ls

sudo docker service create --name nginxreplicas --replicas 3 -p 80:80 nginx

sudo docker service ls
```
* Desta forma, o Swarm vai replicar o serviço em 3 Workers;
* Podemos checar com o comando `docker ps`;
```bash
# Node 2
sudo docker ps

# Node 3
sudo docker ps
```

## Verificando a orquestração
* Vamos remover um container de um **Node Worker**;
* Isso fará com que o Swarm reinicie este container novamente;
* Pois o serviço ainda está rodando no **Manager**, e isto é uma de suas atribuições: **garantir que os serviços estejam sempre disponíveis**;
* OBS: precisamos utilizar a flag `--force` para remover o container;
```bash
# NODE 3
sudo docker ps

sudo docker rm -f <ID_CONTAINER>

sudo docker ps
```

## Checando o Swarm
* Podemos verificar detalhes do Swarm que o Docker está utilizando;
* Utilizamos o comando: `docker info`;
* Desta forma podemos ver detalhes do Swarm;
* Podemos ver o número de Nodes, se o Swarm está ativo, quantos serviços estão rodando, etc;
```bash
# Node 1
sudo docker info
```

## Removendo instância do Swarm
* Podemos remover uma instância do Swarm com o comando `docker swarm leave`;
* A partir deste momento, o Node não faz mais parte do Swarm;
* Note que o status do Node muda para **Down**;
* Podemos checar com o comando `docker node ls`;
```bash
# Node 3
sudo docker swarm leave

# Node 1
sudo docker node ls
sudo docker service ls
ID             NAME            MODE         REPLICAS   IMAGE          PORTS
u8zky7gwe4jb   nginxreplicas   replicated   4/3        nginx:latest   *:80->80/tcp

# Node que a Replica está rodando
# Isso porque o Swarm vai replicar o serviço em outro Node, para garantir que o serviço esteja sempre disponível
sudo docker ps
# Você vai notar que o container que estava rodando no Node 3, agora está rodando em outro Node, isso pode variar de acordo com o seu Swarm
# No meu caso ele começou a rodar no Node 1, o mesmo que está rodando o Manager
```

## Removendo um Node
* Podemos remover um Node com o comando `docker node rm <ID>`;
* **Desta forma a instância não será considerada mais um Node do Swarm**;
* O container continuará rodando na instancia, mas não será gerenciado pelo Swarm;
* Precisamos utilizar a flag `--force` para remover o Node;
```bash
# Node 1
sudo docker node rm --force <ID>
```

## Inspecionando serviços
* Podemos inspecionar um serviço com o comando `docker service inspect <NOME>`;
* Desta forma podemos ver detalhes do serviço;
* Podemos ver o número de réplicas, o ID do serviço, o ID do container, etc;
```bash
# Node 1
sudo docker service ls

sudo docker service inspect nginxreplicas
```

## Verificar containers ativados pelo service
* Podemos ver quais containers estão rodando em um serviço com o comando `docker service ps <NOME>`;
* Recebemos uma lista de containers que estão rodando no serviço e também dos que já receberam baixa;
* Este comando é semelhante ao `docker ps -a`, mas ele é específico para serviços;

## Rodando Compose com Swarm
* Para rodar Compose com Swarm vamos utilizar os comando de _Stack_;
* O comando é: `docker stack deploy -c <ARQUIVO.yaml> <NOME>`;
* Teremos então o **arquivo compose** sendo executado;
* Porém agora estamos em mode swarm e podemos utilizar os Nodes como réplicas;
```bash
# Node 1
# Primeiro vamos parar o serviço que está rodando
sudo docker service rm nginxreplicas

# vamos criar nosso arquivo compose
vim docker-compose.yaml
# "esc" + ":x!" para salvar e sair
cat docker-compose.yaml
```
* No arquivo vamos colocar o seguinte conteúdo:
```yaml
version: '3.3'
services:
  nginx:
    image: nginx
    ports:
      - 80:80
```

```bash
# node 1
sudo docker stack deploy -c docker-compose.yaml nginxstack
sudo docker service ls
```

## Escalando serviços
* Podemos criar novas réplicas nos **Worker Node**;
* Podemos escalar um serviço com o comando `docker service scale <NOME>=<NUMERO>`;
* Desta forma o Swarm vai enviar uma task de replicar o serviço nos novos Workers;
```bash
sudo docker service scale nginxstack_nginx=3
```

## Fazer serviço não receber mais Tasks
* Podemos fazer com que um serviço **não receba mais tasks do Manager**;
* Para isso vamos utilizar o comando: `docker node update --availability drain <ID>`;
* O status de **drain**, é que não recebe tasks;
* Podemos voltar para **active**, e ele volta ao normal
* Utilizamos isso para fazer manutenções em um Node;
```bash
# Node 1
sudo docker node ls

sudo docker node update --availability drain <ID>

sudo docker node ls
```

## Atualizar parâmetro
* Podemos atualizar as configurações dos nossos nodes;
* Vamos utilizar o comando: `docker service update --image <IMAGE> <SERVIÇO>`;
* Desta forma apenas os nodes que estão com status **active** receberão atualizações;

## Criando rede para Swarm
* A conexão entre instâncias usa um drive diferente, o **overlay**;
* Podemos criar primeiramente a rede com o comando: `docker network create --driver overlay <NOME>`;
* E depois criar um service adicionando a flag `--network <NOME>` para inserir o serviço na rede;
```bash
sudo docker service ls
sudo docker service rm <ID>

sudo docker network create --driver overlay swarm

sudo docker service create --name nginxreplicas --replicas 3 -p 80:80 --network swarm nginx
```

## Conectar serviço a uma rede
* Podemos também conectar serviços que já estão em execução a uma rede;
* Vamos utiizar o comando de update: `docker service update --network-add <REDE> <SERVIÇO>`;
* Depois checamos o resultado com **inspect**;
```bash
sudo docker service ls
sudo docker service rm <ID>

sudo docker service create --name nginxreplicas --replicas 3 -p 80:80 nginx

sudo docker service ls

sudo docker service update --network-add swarm nginxreplicas
```
# Kubernetes
## O que é Kubernetes?
* Uma ferramente de **orquestração de containers**;
* Permite a criação de **múltiplos containers em diferentes máquinas (nodes)**;
* Escalando projetos, formando um **cluster**;
* Gerencia serviços, garantido que as aplicações sejam executadas **sempre da mesma forma**;
* Criada pelo **Google**;

## Cnceitos fundamentais
* **Control Plane**: Onde é gerenciado o controle dos precessos dos Nodes;
* **Nodes**: Máquinas que são gerenciadas pelo Control Plane;
* **Deployment**: A execução de uma imagem/projeto em um Pod;
* **Pod**: Um ou mais containers que estão em um Node;
* **Services**: Serviços que expõe os Pods para o mundo externo;
* **kubectl**: Ferramenta de linha de comando para gerenciar o Kubernetes;

## Dependências necessárias
* O Kubernets pode ser executado de uma maneira simples em nossa máquina;
* Vamos precisar do client, **kuberctl**, que é a maneira de interagir com o Kubernetes;
* E também o **Minikube**, que é uma ferramenta que cria um cluster Kubernetes em uma máquina virtual;

## Kubernetes no Linux
* No Linux vamos instalar primeiramente o **kubectl**;
* E Depois também seguiremos a documentação do **Minikube**;
* Um dos requisitors do Minikube é ter um **gerenciador de VMs/Containers**, como o VirtualBox, Docker, Hiperv;
* Na próxima sessão vamos inicializar o Minikube;
* [Documentação Kubectl](https://kubernetes.io/docs/tasks/tools/install-kubectl-linux/)
```bash
sudo apt-get update
sudo apt-get install -y ca-certificates curl

curl -fsSL https://packages.cloud.google.com/apt/doc/apt-key.gpg | sudo gpg --dearmor -o /etc/apt/keyrings/kubernetes-archive-keyring.gpg

echo "deb [signed-by=/etc/apt/keyrings/kubernetes-archive-keyring.gpg] https://apt.kubernetes.io/ kubernetes-xenial main" | sudo tee /etc/apt/sources.list.d/kubernetes.list

sudo apt-get update
sudo apt-get install -y kubectl

clear

kubeclt version --short
```

* Agora vamos instalar o Minikube;
* [Documentação Minikube](https://minikube.sigs.k8s.io/docs/start/)
```bash
curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube_latest_amd64.deb
sudo dpkg -i minikube_latest_amd64.deb

minikube version
```

## Inicializando Minikube
* Para inicializar o Minikube vamos utilizar o comando: `minikube start --drive=<DRIVE>`;
* Onde o driver vai depender de como foi usa instalação das dependências, e por qualquer um deles atigiremos o mesmo resultado;
* Você pode tentar: **virtualbox**, **docker**, **hyperv**;
* Podemos testar o Minikube com o comando: `minikube status`;
```bash
minikube start --driver=docker
# Caso não funcione, tente com outro drive ou simplesmente sem o drive
# miniube start
minikube status
```
* Caso deseje parar o Minikube, utilize o comando: `minikube stop`;

## Acessando a dashborad do Kubernets
* O Minikube nos disponibiliza uma **dashboard**;
* Nela podemos ver todo o detalhamento de nosso projeto: **serviços, pods e ect**;
* Vamos acessar com o comando: `minikube dashboard`;
* OU para apenas ver o link: `minikube dashboard --url`;
```bash
minikube dashboard
```

## Deployment teoria
* O **Deployment** é uma parte fundamental do Kubernetes;
* Com ele criamos nosso serviço que vai rodar nos **Pods**;
* **Definimos uma imagem e uma nome**, para posteriormente ser replicado entre os Nodes;
* A partir da criação do deployment teremos containers rodando;
* Vamos precisar de uma **imagem no Hub do Docker**, para gerar um Deployment;

## Crirar projeto
* Primeiramente vamos criar um pequeno projeto, novamente em **Flask**;
* Buildar a **imagem** do mesmo;
* Enviar para o **Docker Hub**;
* E testar rodando em um **container**;
* Este projeto será utilizado no Kubernetes;
```bash
mkdir Kubernetes
cd Kubernetes
mkdir flask-server
cd flask-server
touch app.py
touch Dockerfile
mkdir templates
touch templates/index.html
```
* Vamos por partes, primeiro o **app.py**;
```python
import flask
from flask import Flask, render_template

app = flask.Flask(__name__)

app.config["DEBUG"] = True

@app.route('/', methods=['GET'])
def index():
    return render_template('index.html')

if __name__ == "__main__":
    app.run(host="0.0.0.0", debug=True, port=5000)
```
* Agora o **Dockerfile**;
```dockerfile
FROM python:3

RUN apt-get update -y && \
    apt-get install -y python3-pip python3-dev

WORKDIR /app

RUN pip install Flask 

COPY . .

EXPOSE 5000

VOLUME [ "/data" ]

CMD ["python3", "./app.py"]
```
* Por fim o **index.html** dentro da pasta **templates**;
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flask com Kubernetes</title>
</head>
<body>
    <h1>Hello Kubernetes!</h1>
</body>
</html>
```
* OKAY!
* Setup pronto, vamos buildar a imagem para colocar no Docker Hub;
```bash
# Lembre-se de estar na pasta do projeto
docker build -t <SEU_USER_NO_HUB>/flask-server .
# Depois de buildar, vamos testar
docker run -d -p 5000:5000 --name container-test-flask <SEU_USER_NO_HUB>/flask-server

# Para testar, acesse o localhost:5000
# Para parar o container
docker stop container-test-flask
```
* Se tudo deu certo, vamos enviar para o Docker Hub;
* Lembre-se de estar logado no Docker Hub;
* E de ter criado um repositório com o nome **flask-server**;
* Lembrando que o nome do repositório deve ser o mesmo que colocamos da **imagem**;
```bash
docker login

docker push <SEU_USER_NO_HUB>/flask-server
```
* Pronto, agora vamos para o Kubernetes;

## Criando Deployment
* Após este mini setup é hora de rodar nosso projeto no Kubernetes;
* Para isso vamos precisar de um **Deployment**, que é onde rodamos os containers das aplicações nos **Pods**;
* O comando é: `kubectl create deployment <NOME> --image=<IMAGEM>`;
* Desta maneira o projeto de Flask estará sendo orquestrado pelo Kubernetes;
```bash
kubectl create deployment flask-deployment --image=<IMAGEM>
## output
deployment.apps/flask-deployment created
```
* Podemos conferir no minikube dashboard;
```bash
minikube dashboard --url
```

## Checando Deployment
* Podemos checar se tudo foi criado corretamente, tanto o **Deployment** quannto a recepção do projeto pelo **Pod**;
* Para verificar o Deployment vamos utilizar: `kubectl get deployments`;
* E para receber mais detalhes deles: `kubectl describe deployments`;
* Desta forma conseguimos **saber se o projeto está de fato rodando** e também **o que está rodando nele**;
```bash
kubectl get deployments
## Output
NAME               READY   UP-TO-DATE   AVAILABLE   AGE
flask-deployment   1/1     1            1           3m36s

kubectl describe deployments
```

## Checando Pods
* Os **Pods** são componentes muito importantes também, onde os containers realmente são executados;
* Para checar os Pods utilizamos: `kubectl get pods`;
* E para receber mais detalhes deles: `kubectl describe pods`;
* Desta forma conseguimos **saber se o projeto está de fato rodando** e também **o que está rodando nele**;
```bash
kubectl get pods
## Output
NAME                                READY   STATUS    RESTARTS   AGE
flask-deployment-7b64d7c79b-zxhhd   1/1     Running   0          6m13s

kubectl describe pods
```

## Configurações do Kubernetes
* O Kubernetes possui uma série de configurações que podemos fazer;
* Para ver todas as configurações disponíveis: `kubectl config view`;
* Para ver as configurações de um contexto específico: `kubectl config view --minify`;

## Services teoria
* As aplicações do kubernetes **não tem conexão com o mundo externo**;
* Por isso precisamos criar um **Service**, que é o que possibilita expor os Pods para o mundo externo;
* Isso acontece pois os **Pods são criados para serem destruídos** e perderem tudo, ou seja, os dados gerados neles também são perdidos;
* Então o **Service é uma entidade separada dos Pods**, que é responsável por expor os Pods para o mundo externo;

## Criando nosso Service
* Para criar um serviço e export nossos Pods devemos utilizar o comando: `kubectl expose deployment <NOME_DO_DEPLOYMENT> --type=<TIPO> --port=<PORTA>`;
* Colocaremos o nome do **Deployment** já criado anteriormente;
* O **tipo de Service**, há vários para utilizarmos, porém o **LoadBalancer** é o mais utilizado, onde todos os Pods são expostos;
* E uma **porta** para o serviço ser consumido;
```bash
kubectl get deployment
## Output
NAME               READY   UP-TO-DATE   AVAILABLE   AGE
flask-deployment   1/1     1            1           17m

kubectl expose deployment flask-deployment --type=LoadBalancer --port=5000
## Output
service/flask-deployment exposed
```
* Agora que o serviço foi criado, vamos gerar o ip de acesso;
* Podemos acessar o nosso serviço com o comando: `minikube service <NOME_DO_SERVICE> --url`;
* Desta forma o minikube irá gerar um ip para acessarmos o serviço;
* E pronto, agora podemos acessar o serviço pelo ip gerado;
```bash
minikube service flask-deployment --url
## O output será o ip gerado
# Você pode apertar CTRL + click no link para abrir no navegador
```

## Detalhes do Service
* Podemos ver os detalhes do nosso serviço com o comando: `kubectl get services`;
* E para ver mais detalhes: `kubectl describe services/<NOME_DO_SERVICE>`;
```bash
kubectl get services
## Output
NAME               TYPE           CLUSTER-IP       EXTERNAL-IP   PORT(S)          AGE
flask-deployment   LoadBalancer   10.107.142.195   <pending>     5000:31360/TCP   24m
kubernetes         ClusterIP      10.96.0.1        <none>        443/TCP          118m

kubectl describe services/flask-deployment
## Output
NAME               TYPE           CLUSTER-IP       EXTERNAL-IP   PORT(S)          AGE
flask-deployment   LoadBalancer   10.107.142.195   <pending>     5000:31360/TCP   25m
```

## Replicando nossa aplicação
* Agora que já temos nossa aplicação rodando, podemos replicar ela;
* Para isso vamos utilizar o comando: `kubectl scale deployment <NOME_DO_DEPLOYMENT> --replicas=<NUMERO_DE_REPLICAS>`;
* Podemos agora verificar no **Dashboard** do minikube o aumento de Pods;
* E também com o comando de **Pods** do kubernetes: `kubectl get pods`;
```bash
kubectl scale deployment flask-deployment --replicas=5
## Output
deployment.apps/flask-deployment scaled

kubectl get pods
## Output
NAME                                READY   STATUS    RESTARTS   AGE
flask-deployment-7b64d7c79b-7wzmr   0/1     ContainerCreating   0          7s
flask-deployment-7b64d7c79b-bwc2w   0/1     ContainerCreating   0          7s
flask-deployment-7b64d7c79b-gsxdq   1/1     Running             0          7s
flask-deployment-7b64d7c79b-kq8n9   1/1     Running             0          7s
flask-deployment-7b64d7c79b-zxhhd   1/1     Running             0          48m
```

## Checar número de réplicas
* Além do get pods e da Dashboard, temos mais um comando para **checar réplicas**;
* Que é o: `kubectl get rs`;
* Onde podemos ver o número de réplicas que estão rodando;
```bash
kubectl get rs
## Output
NAME                          DESIRED   CURRENT   READY   AGE
flask-deployment-7b64d7c79b   5         5         5       51m
```

## Diminuindo número de réplicas
* Para diminuir o número de réplicas, basta utilizar o mesmo comando de **escalar** o número de réplicas;
* Porém agora colocando um número menor;
```bash
kubectl scale deployment flask-deployment --replicas=2
## Output
deployment.apps/flask-deployment scaled

kubectl get pods
## Output
NAME                                READY   STATUS        RESTARTS   AGE
flask-deployment-7b64d7c79b-gsxdq   1/1     Running       0          3m
flask-deployment-7b64d7c79b-kq8n9   1/1     Running       0          3m
```

## Atualizando a imagem do deployment
* Para atualizar a imagem do deployment, basta utilizar o comando: `kubectl set image deployment/<NOME_DO_DEPLOYMENT> <NOME_DO_CONTAINER>=<IMAGEM>:<TAG>`;
* Onde o **nome do container** é o nome que colocamos no arquivo de deployment;
* E a **imagem** é a imagem que queremos utilizar;
* E a **tag** é a tag da imagem;
* Para testar na prática, vamos criar uma nova imagem do nosso projeto;
* Para isso vamos ir no nosso **index.html** e alterar o texto;
* E depois vamos criar uma nova imagem com o comando: `docker build -t <NOME_DA_IMAGEM>:<TAG> .`;
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flask com Kubernetes</title>
    <style>
        h1{
            text-align: center;
            margin-top: 20%;
        }
    </style>
</head>
<body>
    <h1>Hello Kubernetes!</h1>
</body>
</html>
```
* Agora vamos atualizar a imagem do nosso deployment;
```bash
docker build -t <SEU_NOME_NO_HUB>/flask-server:v2 .
docker push <SEU_NOME_NO_HUB>/flask-server:v2

# Podemos ir no Minikube Dashboard para pegar o nome do container
# Ou podemos utilizar o comando: kubectl describe pods
# Assim verificamos o nome do container do pod mais antigo, que é nosso manager
kubectl set image deployment/flask-deployment flask-server=<SEU_NOME>/flask-server:v2
```

## Rollback da imagem
* Para fazer o rollback da imagem, basta utilizar o comando: `kubectl rollout undo deployment/<NOME_DO_DEPLOYMENT>`;
* E para ver o histórico de alterações, basta utilizar o comando: `kubectl rollout history deployment/<NOME_DO_DEPLOYMENT>`;
* Também podemos verificar uma alteração com o comando: `kubectl rollout status deployment/<NOME_DO_DEPLOYMENT>`;
```bash
# Nesse exemplo, vamos fazer uma alteração de imagem para uma imagem que não existe
kubectl set image deployment/flask-deployment flask-server=<SEU_NOME>/flask-server:v3

# Agora vamos ver os status do deployment
kubectl get pods
NAME                                READY   STATUS             RESTARTS   AGE
flask-deployment-79c8cb4d69-jf49q   0/1     ImagePullBackOff   0          82s #ERROR
flask-deployment-fb869564d-249q5    1/1     Running            0          6m51s
flask-deployment-fb869564d-kkg47    1/1     Running            0          6m47s

kubectl rollout undo deployment/flask-deployment
deployment.apps/flask-deployment rolled back

kubectl rollout status deployment/flask-deployment
deployment "flask-deployment" successfully rolled out

kubectl get pods
NAME                                READY   STATUS        RESTARTS   AGE
flask-deployment-79c8cb4d69-2j4q5   1/1     Running       0          2m
flask-deployment-79c8cb4d69-jf49q   1/1     Running       0          2m
```

## Deletar um Service
* Para deletar um serviço do Kubernetes, basta utilizar o comando: `kubectl delete service <NOME_DO_SERVICE>`;
* Desta maneira nossos Pods ainda vão estar rodando, porém não vão estar acessíveis;
* Para deletar um deployment, basta utilizar o comando: `kubectl delete deployment <NOME_DO_DEPLOYMENT>`;
* Desta maneira nossos Pods também vão ser deletados;
```bash
kubectl get services
NAME               TYPE           CLUSTER-IP       EXTERNAL-IP   PORT(S)          AGE
flask-deployment   LoadBalancer   10.107.142.195   <pending>     5000:31360/TCP   64m
kubernetes         ClusterIP      10.96.0.1        <none>        443/TCP          158m

kubectl delete service flask-deployment

kubectl get services
NAME         TYPE        CLUSTER-IP   EXTERNAL-IP   PORT(S)   AGE
kubernetes   ClusterIP   10.96.0.1    <none>        443/TCP   158m

kubectl get pods
NAME                               READY   STATUS    RESTARTS   AGE
flask-deployment-fb869564d-249q5   1/1     Running   0          14m
flask-deployment-fb869564d-kkg47   1/1     Running   0          14m
```
* Agora se tentarmos acessar o nosso serviço, não vamos conseguir;
* Porém os pods ainda estão rodando;
* Para deletar os pods, basta utilizar o comando: `kubectl delete deployment <NOME_DO_DEPLOYMENT>`;
```bash
kubectl get deployment
NAME               READY   UP-TO-DATE   AVAILABLE   AGE
flask-deployment   2/2     2            2           15m


kubectl delete deployment flask-deployment

kubectl get deployment
No resources found in default namespace.

kubectl get pods
No resources found in default namespace.
```

## Modo declarativo Teoria
* Até agora utilizamos o **modo imperativo**, que é quando iniciamos a aplicação com comandos;
* O **modo declarativo** é guiado por um arquivo, semelhante ao **docker-compose**;
* Desta maneira tornamos nossas configurações mais simples e **centralizamos tudo em um comando**;
* Também escrevemos em um arquivo **.yaml**;

## Chaves mais utilizadas
* **apiVersion**: Versão da API do Kubernetes;
* **kind**: Tipo de objeto que estamos criando (Deployment, Service, Pod, etc);
* **metadata**: Metadados do objeto (nome, labels, etc);
* **replicas**: Quantidade de réplicas que queremos rodar;
* **containers**: Lista de containers que queremos rodar;

## Criando um arquivo de deployment
* Agora vamos transformar nosso projeto em **declarativo**;
* Para isso vamos criar um arquivo para realizar o **Deployment**;
* Desta maneira vamos aprender a criar os arquivos declarativos e utilizar as **chaves e valores**;
```bash
cd kubernetes
mkdir declarative
cd declarative
# Simplesmente copiamos o conteúdo da pasta flask-server
cp ../flask-server/app.py .
cp ../flask-server/Dockerfile .
cp  -r ../flask-server/templates .

touch flask.yaml
```
* Agora vamos criar o nosso arquivo **flask.yaml**;
```yaml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: flask-app-deployment
spec:
  replicas: 3
  selector:
    matchLabels:
      app: flask-app
  template:
    metadata:
      labels:
        app: flask-app
    spec:
      containers:
        - name: flask
          image: <seu_nome_no_hub>/<sua_imagem_no_hub>:<tag>
```
* Vamos então executar nosso arquivo;
* O comando para executar um arquivo declarativo é: `kubectl apply -f <NOME_DO_ARQUIVO>`;
* Desta maneira o Deployment vai ser criado conforme configuramos no arquivo **flask.yaml**;
```bash
kubectl apply -f flask.yaml
deployment.apps/flask-app-deployment created

kubectl get deployment
NAME                   READY   UP-TO-DATE   AVAILABLE   AGE
flask-app-deployment   3/3     3            3           2m

kubectl get pods
NAME                                    READY   STATUS    RESTARTS   AGE
flask-app-deployment-5f5f8f6f5c-2j4q5   1/1     Running   0          2m
flask-app-deployment-5f5f8f6f5c-jf49q   1/1     Running   0          2m
flask-app-deployment-5f5f8f6f5c-kkg47   1/1     Running   0          2m
```
* Para parar de executar este deployment baseado em arquivo, o **declarativo**, utilizamos também o delete;
* O comando para deletar um arquivo declarativo é: `kubectl delete -f <NOME_DO_ARQUIVO>`;
* Desta maneira teremos os Pods sendo excluídos e o serviço finalizado;
```bash
kubectl delete -f flask.yaml
deployment.apps "flask-app-deployment" deleted
```

## Criando o serviço
* Agora vamos criar o serviço para o nosso deployment;
* Para isso vamos criar o arquivo **flask-service.yaml** para realizar o **Service (kind)**;
* O arquivo será semelhante ao de Deployment, porém tem uma responsabilidade diferente;
```bash
touch flask-service.yaml
```
* Vamos então criar o nosso arquivo **flask-service.yaml**;
```yaml
apiVersion: v1
kind: Service
metadata:
  name: flask-app-service
spec:
  selector:
    app: flask-app # Link entre o service e o deployment
  ports:
    - protocol: TCP
      port: 5000
      targetPort: 5000
  type: LoadBalancer
```
* Agora para rodar o service;
* O comando para executar um arquivo declarativo é: `kubectl apply -f <NOME_DO_ARQUIVO>`;
* Desta maneira o Service vai ser criado conforme configuramos no arquivo **flask-service.yaml**;
* OBS: precisamos gerar o IP de acesso com o comando `minikube service <NOME_DO_SERVICE>`;
```bash
kubectl apply -f flask.yaml
deployment.apps/flask-app-deployment created
kubectl apply -f flask-service.yaml
service/flask-app-service created

minikube service flask-app-service
```
* Agora podemos acessar o nosso serviço!

## Parando serviços declarativos
* Para parar de executar este deployment baseado em arquivo, o **declarativo**, utilizamos também o delete;
* O comando para deletar um arquivo declarativo é: `kubectl delete -f <NOME_DO_ARQUIVO>`;
* Desta maneira teremos os Pods sendo excluídos e o serviço finalizado;
```bash
kubectl delete -f flask.yaml
deployment.apps "flask-app-deployment" deleted

kubectl delete -f flask-service.yaml
service "flask-app-service" deleted
```

## Atualizando o projeto no declarativo
* Primeiramente vamos **criar uma nova imagem** para o nosso projeto;
* Depois fazer o **push** para o **Docker Hub**;
* Depois é só alterar no arquivo **flask.yaml** a imagem que queremos utilizar;
* E por fim rodar o comando `kubectl apply -f <NOME_DO_ARQUIVO>` para atualizar o nosso projeto;
* Simples assim!

## Unindo arquivos do projeto
* Agora vamos unir os arquivos do nosso projeto em um só;
* A separação de objetos para o YAML é com `---`;
* Desta maneira podemos ter um arquivo só para o nosso projeto;
* Uma boa prática é colocar o **service antes do deployment**;
```bash
cd ..
mkdir union
cd union-files
cp ../declarative/app.py .
cp ../declarative/Dockerfile .
cp -r ../declarative/templates .

touch flask-project.yaml
```
* Vamos então criar o nosso arquivo **flask-project.yaml**;
```yaml
---
apiVersion: v1
kind: Service
metadata:
  name: flask-app-service
spec:
  selector:
    app: flask-app # Link entre o service e o deployment
  ports:
    - protocol: TCP
      port: 5000
      targetPort: 5000
  type: LoadBalancer
---
apiVersion: apps/v1
kind: Deployment
metadata:
  name: flask-app-deployment
spec:
  replicas: 3
  selector:
    matchLabels:
      app: flask-app
  template:
    metadata:
      labels:
        app: flask-app
    spec:
      containers:
        - name: flask
          image: ashinx/flask-kub:v2
```
* Agoa vamos rodar o nosso projeto;
```bash
kubectl apply -f flask-project.yaml
service/flask-app-service created

minikube service flask-app-service
```
* Agora podemos acessar o nosso serviço!