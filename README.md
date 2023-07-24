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