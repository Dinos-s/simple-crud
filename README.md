# Criando um CRUD completamente simples!

Usando o PHP como linguagem preincipal, 
com o auxilio do composer para gerenciamento de pacotes.

Esse projeto está usando a arquitetura MVC para melhor compreensão so sistema.

# Atualizações Recentes
 - Estilização feita completamente em bootstrap 5 (e um pouco de CSS).
 - Ícones usados pelo fontawsome.
 - Criação e jogando o projeto no Docker 🐳.

 - Versões do utilizadas no Docker:
   - PHP:8.3.10-apache;
   - MySQL:8.0;

 - Estrutura do banco de dados e tabela:
    ´´´
   create table users(
        `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `nome` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL
    );

* Atenção: Caso queira baixar esse projeto via docker, insira esse código no linha de comando win/linux
´´´
docker push gabrielmr01/simple_crud