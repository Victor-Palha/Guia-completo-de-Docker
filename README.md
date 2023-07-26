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
* Com o comando `docker system prude`;
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