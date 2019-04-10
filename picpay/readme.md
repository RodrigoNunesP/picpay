## Desafio PicPay

O desafio é criar uma API REST que busca usuários pelo nome e username a partir de uma palavra chave. Fazer o download do arquivo users.csv.gz que contém os dados de 8 milhões de usuários que devem ser usados na busca. Ele contém os IDs, nomes e usernames dos usuários.

Serão fornecidas duas listas de usuários que devem ser utilizadas para priorizar os resultados da busca. A lista 1 tem mais prioridade que a lista 2. Ou seja, se dois usuários atendem os critérios de busca, aquele que está na lista 1 deverá ser exibido primeiro em relação àquele que está na lista 2. Os que não estão em nenhuma das listas deverão ser exibidos em seguida em ordem alfabética.

As listas podem ser encontradas noa arquivos fornecidos para download (listarelevancia1.txt e listarelevancia2.txt). Os resultados devem ser retornados paginados de 15 em 15 registros.

Deve-se apresentar também a solução para a importação dos 8 milhões de usuários. 
Sugestão: Não enviar apenas o dump do banco de dados

## Ferramentas
 - PHP 7.3.3 
 - PHPUnit 7.5.8 
 - Laravel Framework 5.8.10

## Lista de procedimentos:

- Criado um projeto Laravel utilizando linguagem PHP7 e mySql para base de dados;

