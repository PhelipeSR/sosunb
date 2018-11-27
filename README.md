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

Nos Endpoints que possuem autenticação requerida é necessário enviar o parâmetro Authorization no body da requisição.

Exemplo:

```json
{
 "token":"eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL3Nvc3VuYlwvIiwic3ViIjoiMSIsImV4cCI6MTUzOTgwNTk5NCwiaWF0IjoxNTM5NzE5NTk0LCJ1c2VyIjoiUGVkcm8gSGVucmlxdWUgTGlyYSBkYSBDb3N0YSIsInByb2ZpbGVfdHlwZV9pZCI6IjEifQ.l2_5lpUV083_43QEDFcCWS4AfduxhoeXTi_k-9y18eA",
}
```

## /sessions/login (POST)
>Login do usuário

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
 "email":"mariana.grijo@gmail.com",
 "password":"12345678",
}
```

## /sessions/recover (POST)
>Verifica se o email existe para recuperação de senha

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| email | string |sim | Email do Usuário|
| password |string | sim | Senha do usuário|

### Tipos de retorno

|STATUS | TYPE |DESCRIÇÃO|
| --- | --- | --- |
| 200 | OK | Cadastro enviado |
|3 |  |Parâmetro obrigatório|
| 10 | ? | Dados incorretos |

> Exemplos de requisição

```json
{
 "email":"mariana.grijo@gmail.com",
 "password":"12345678",
}
```
## api/area/get (POST)
>Autenticação Requerida

### Parametros de entrada
>Não há parâmetro de entrada

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Area ok|
|9 | ? |Erro genérico do banco|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|


## api/user/register (POST)

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
## api/user/get (POST)
>Autenticação Requerida

### Parametros de entrada
Não há parâmetro de entrada

### Tipos de Retorno
|STATUS| TYPE |Descrição|
| --- |---| --- |
|  200 | OK |Cadastro enviado|
|  9 | ? |Erro genérico do banco|
|  401 | ? |Não é aluno da UnB|



## api/user/update (POST)
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
 "email":"pedro@gmail.com",
}
```
## api/user/delete (POST)
>Autenticação Requerida

### Parametros de entrada
Não há parâmetro de entrada

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| --- |
|200 |OK |Novo email confirmado|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|

## api/user/update/password (POST)
>Autenticação Requerida

### Parâmetros de entrada

|Parâmetros de retorno| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| password| string | sim | Nova senha do usuário |

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Nova senha confirmada|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|9 | ? |Erro genérico do banco|
|3 | ? |Parâmetro obrigatório|

> Exemplos de requisição

```json
{
 "password":"asdjkl",
}
```

## api/like/add (POST)
>Autenticação Requerida
>Adicionar Like


### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
|-|-|-|-|
|demands_id |numeric | sim | Id da demanda curtida|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Dados cadastrados|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demands_id":"1",
 }
```


## api/like/delete (POST)
>Autenticação Requerida
>Deletar Like

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|demands_id |numeric | sim | Id da demanda curtida|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Dados excluídos|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demands_id":"1",
 }
```


## api/coments/add (POST)
>Autenticação Requerida
>Adicionar comentário

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|demands_id |numeric | sim | Id da demanda|
|comments | text | sim | Comentario da demanda|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Dados Cadastrado|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
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

## api/coments/delete (POST)
>Autenticação Requerida
>Deletar Comentário

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|comment_id |numeric | sim | Id do comentário|


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Comentário Excluído|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "comment_id":"5"
 }
```

## api/local/get (POST)

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|campus |numeric | sim | Id do campus|
|area | numeric | sim | Id da área |


### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Local cadastrado|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "campus":"3",
   "area":"1"
 }
```

## api/demands/add (POST)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|image |base64 | sim |Imagem da Demanda|
|title | string | sim | Título da Demanda|
|description | string | sim | Descrição da Demanda|
|local_id | numeric | não | Id do local|
|type_problems_id | numeric | sim | Id do tipo de problema|
|type_demand_id | numeric | sim | Id do tipo de demanda|
|campus_id | numeric | sim | Id do campus do demanda|
|environment_id | numeric | sim | Id do tipo de ambiente|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda adicionada|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|


## api/demands/report (POST)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|demands_id | numeric | sim | Id do demanda|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda reportada|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demands_id":"1"
 }
```

## api/demands/delete (POST)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|demands_id | numeric | sim | Id do demanda|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda deletada|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demands_id":"1"
 }
```

## api/get-demands/ranking (POST)
>Autenticação Requerida

### Parametros de entrada
|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|campus | numeric | não | Id do campus|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda ok|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "campus":"Darcy Ribeiro"
 }
```


## api/get-demands/feed (POST)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|status | numeric | não | Status da demanda|
|limit | numeric | sim | Limites da demanda|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda cadastrada|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "status":"1",
   "limit":"100"
 }
```
## api/get-demands/profile (POST)
>Autenticação Requerida

### Parametros de entrada
> Não há parâmetros de entrada

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda ok|
|9 | ? |Erro genérico do banco|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|

## api/get-demands/resolved (POST)

### Parametros de entrada
>Não há parâmetros de entrada

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda ok|
|9 | ? |Erro genérico do banco|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|

## api/get-demands/similar (POST)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|campus | numeric | sim | Id do Campus|
|environment | numeric | sim | Id do Ambiente|
|local | string | não | Local|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda ok|
|3 | ? |Parâmetro obrigatório|
|9 | ? |Erro genérico do banco|
|4 | ? |Parâmetro numérico|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|

> Exemplos de requisição

```json
 {
   "campus":"4",
   "environment":"1",
   "local":"externo"
 }
```
## api/get-demands/single (POST)
>Autenticação Requerida

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|demands_id | numeric | sim | Id da demanda|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Demanda ok|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|3 | ? |Parâmetro obrigatório|
|4 | ? |Parâmetro numérico|
|9 | ? |Erro genérico do banco|

> Exemplos de requisição

```json
 {
   "demands_id":"1"
 }
```

## api/campus/get (POST)
>Autenticação Requerida

### Parametros de entrada
> Não há parâmetros de entrada

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Campus ok|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|9 | ? |Erro genérico do banco|

## api/area/get (POST)
>Autenticação Requerida

### Parametros de entrada
>Não há parâmetro de entrada

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Area ok|
|9 | ? |Erro genérico do banco|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
