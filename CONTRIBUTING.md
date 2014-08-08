# Contribuindo

Você que chegou aqui com o objetivo de contribuir com este projeto, nós do PHP Santa Catarina agradecemos!

Testes de unidades, documentação, novas funcionalidades, sugestões... temos muitas
áreas que com certeza você tem plenas possibilidades de nos ajudar! Aliás, você
já conferiu nossa lista de [tarefas](https://github.com/PHPSC/pagseguro/issues)?

## Ferramentas básicas

Antes de explicarmos a estrutura básica do projeto é necessario conhecermos
as ferramentas fundamentais que utilizamos para organizar o desenvolvimento.

### git-flow

A partir [deste post](http://nvie.com/posts/a-successful-git-branching-model)
surgiu uma extensão para o git, o [git-flow](https://github.com/nvie/gitflow).

Esta ferramenta é extremamente útil para agilizar o desenvolvimento usando
branchs.

Leia o [post](http://nvie.com/posts/a-successful-git-branching-model) e instale
a ferramenta para poder acompanhar as explicações que virão mais abaixo. Utilize também o [cheatsheet do git-flow](http://danielkummer.github.io/git-flow-cheatsheet/index.pt_BR.html) como material de auxílio.

### Composer

O [composer](http://getcomposer.org) é uma ferramenta de gerenciamento de
dependências de projetos PHP. Com ele é possível realizar a instalação de
todas as bibliotecas que o software necessita utilizando um único comando.

Recomendamos também a leitura dos slides [desta palestra](http://www.slideshare.net/rdohms/composer-for-busy-developers-dpc13)
do nosso amigo [Rafael Dohms](https://github.com/rdohms).

## Code style

Todas as alterações DEVEM seguir a [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).

## Preparando o terreno

Você quer realizar alterações no código então? Muito bem, para
começar a brincadeira você deve seguir os passos abaixo:

1. Crie um [fork](https://help.github.com/articles/fork-a-repo) e clone o projeto;
1. Instale as dependências utilizando o composer (```composer install```);
1. Defina as permissões de diretórios com o phing (```vendor/bin/phing post-install```);
1. Aponte o branch local master para origin/master (```git branch master origin/master```);
1. Inicialize o git-flow (```git flow init -d```);
1. Crie seu branch
    * Caso seja uma nova funcionalidade você deve executar o
      comando ```git flow feature start $feature```, onde $feature
      é um identificador para a funcionalidade a ser implementada;
    * Caso você opte por corrigir um bug você deverá inicializar
      um hotfix branch ```git flow hotfix start $hotfix```, onde
      $hotfix deverá ser a versão atual, incrementando o número
      da última posição (PATCH).

Se tiver dúvidas a respeito do versionamento, leia [esta especificação](https://github.com/wendtecnologia/semver/blob/2.0.0/semver.pt-br.md) ([ou sua versão original, em inglês](http://semver.org/spec/v2.0.0.html)).
