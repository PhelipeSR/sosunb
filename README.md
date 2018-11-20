# API SOS UnB

O objetivo da API é dar suporte as requisições das aplicações Front-End do projeto SOS UnB para permitir que este execute suas funcionalidades.


### Listagem dos Endpoints


| Identificador | Finalidade |
| --- | --- |
| api/user | Endpoint responsável por realizar o cadastro do novo usuário |
| api/status| Endpoint responsável pelo status da demanda |
| api/type-demand | Endpoint responsável pela criação do tipo de demanda  |
| api/local | Endpoint responsável pelo local da demanda |
| api/type-problem  |Endpoint responsável pela criação, edição, exclusão e requisição de um tipo de problema |
| api/like | Endpoint responsável pelos likes do usuário |
| api/coments | Endpoint responsável pelos comentários do usuário |
| api/answers | Endpoint responsavel pelas respostas do usuário |
| api/demands | Endpoint responsável pelas demandas |
| api/sessions | Endpoint responsável pelo login e recuperação de senha do usuário |

Nos Endpoints que possuem autenticação requerida é necessário enviar o token do usuário logado no cabeçalho da requisição.

Exemplo:

```json
{
 "token":"eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL3Nvc3VuYlwvIiwic3ViIjoiMSIsImV4cCI6MTUzOTgwNTk5NCwiaWF0IjoxNTM5NzE5NTk0LCJ1c2VyIjoiUGVkcm8gSGVucmlxdWUgTGlyYSBkYSBDb3N0YSIsInByb2ZpbGVfdHlwZV9pZCI6IjEifQ.l2_5lpUV083_43QEDFcCWS4AfduxhoeXTi_k-9y18eA",
}
```

## /sessions (POST)
### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| email | string |sim | Email do Usuário|
| password |string | sim | Senha do usuário|

### Tipos de retorno

|STATUS | TYPE |DESCRIÇÃO|
| --- | --- | --- |
| 200 | OK | Cadastro enviado |
| 10 | ? | Dados incorretos |
| 400 | BAD_REQUEST | Algum parâmetro do tipo errado espaço em ou vazio|

> Exemplos de requisição

```json
{
 "email":"Marilinda@gmail.com",
 "password":"12345678",
}
```
## api/user (POST)

### Parametros de retorno

|Parametros de retorno| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| name | string | sim | Nome do usuário |
| email | string | sim | E-mail do usuário |
| registry | string | sim | Matrícula do usuário |
| identity | string |sim | Identidade do usuário|
| date_birth | string | sim | Data de aniversário do usuário|
| password | string |sim | Senha do usuário|


### Tipos de Retorno
|STATUS| TYPE |Descrição|
| --- |---| --- |
|  200 | OK |Cadastro enviado|
|  9 | ? |Erro genérico do banco|
|  8 | ? |Não é aluno da UnB|

> Exemplos de requisição

```json
{
 "name":"Pedro",
 "email":"pedro@gmail.com",
 "registry":"140027172",
 "identity":"3380180",
 "date_birth":"09091996",
 "password":"123456",
}
```
## api/user (GET)
>Autenticação Requerida

### Parametros de retorno

|Parametros de retorno| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| token | string | sim | Token do usuário |


### Tipos de Retorno
|STATUS| TYPE |Descrição|
| --- |---| --- |
|  200 | OK |Cadastro enviado|
|  9 | ? |Erro genérico do banco|
|  401 | ? |Não é aluno da UnB|



## api/user (PUT)
>Autenticação Requerida

### Parâmetros de entrada

|Parâmetros de retorno| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| email | string | sim | E-mail do usuário |

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Nova senha confirmada|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
{
 "email":"pedrolindo@gmail.com",
}
```
## api/user (DELETE)
>Autenticação Requerida

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| --- |
|200 |OK |Novo email confirmado|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|





## api/like (POST)
>Autenticação Requerida


### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
|-|-|-|-|
|demands_id |numeric | sim | Id da demanda curtida|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Dados cadastrados|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demands_id":"1",
 }
```


## api/like (DELETE)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|demands_id |numeric | sim | Id da demanda curtida|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Dados excluídos|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demands_id":"1",
 }
```


## api/coments (POST)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|demands_id |numeric | sim | Id da demanda|
|comments | text | sim | Comentario da demanda|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Dados Cadastrado|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demands_id":"1",
   "comment":"Comentario teste"
 }
```

## api/coments (PUT)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|comment_id |numeric | sim | Id do comentário a ser editado |
|comment    |text | sim | Comentário editado|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Dados cadastrados|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demand":"1"
 }
```
## api/coments (GET)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|demand |numeric | sim | Id da demanda|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Comentários da demanda|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demand":"1"
 }
```
