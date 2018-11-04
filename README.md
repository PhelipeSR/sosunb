# API SOS UnB

O objetivo da API é dar suporte as requisições das aplicações Front-End do projeto SOS UnB para permitir que este execute suas funcionalidades.


### Listagem dos Endpoints


| Identificador | Finalidade |
| --- | --- |
| /user | Endpoint responsável por realizar o cadastro do novo usuário |
| /status|Endpoint responsável pelo status da demanda |
| /type-demand | Endpoint responsável pela criação do tipo de demanda  |
| /local |Endpoint responsável pelo local da demanda |
| /type-problem |Endpoint responsável pela criação, edição, excluisão e requisição de um tipo de problema|
| /like |Endpoint responsável pelos likes do usuário|
| /coments |Endpoint responsável pelos comentários do usuário|
| /answers |Endpoint responsavel pelas respostas do usuário|
| /demands |Endpoint responsável pelas demandas|
| /session |Endpoint responsável pelo login e recuperação de senha do usuário|

## /session (POST)
### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| email | string |sim | Email do Usuário|
| password |string | sim | Senha do usuário|

### Tipos de retorno

|STATUS | TYPE |DESCRIÇÃO|
| --- | --- | --- |
| 200 | OK |Cadastro enviado|
| 10 |||
| 400 | BAD_REQUEST | Algum parâmetro do tipo errado espaço em ou vazio|

> Exemplos de requisição

```json
{
 "email":"Marilinda@gmail.com",
 "password":"12345678",
}
```
## /us/auth/profile (GET)

### Parametros de retorno

|Parametros de retorno| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| _id |string|sim|id do usuário no banco de dados|
| photo |string | sim | Foto do usuário|
| qrcode |base 64 | sim | Base 64 encodado das informações do usuário|
| name | string |sim | Nome do Usuário|
| student_id |string | sim | Matricula usuário|
| university_id | integer|sim | Universidade de usuário|


### Tipos de Retorno
|STATUS| TYPE |Descrição|
| --- |---| --- |
|  200 | OK |Cadastro enviado|


> Exemplos de requisição

```json
{
 "photo":"5gkzgT5CRR1l6JI...",
 "qrcode":"5gkzgT5CRR1l6JI...",
 "name":"Caio Rondon",
 "password":"12345678",
 "student_id":"140018762",
 "university_id":6,
}
```

## /us/user/change-password (POST)

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| current_password |string | sim | Senha atual do usuario|
| new_password |string | sim | Nova senha do usuário|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Nova senha confirmada|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|400 | BAD_REQUEST |O formato da nova senha não é valido|

> Exemplos de requisição

```json
{
 "current_password":"1231234",
 "new_password":"54321768",
}
```
## /us/user/change-email (POST)

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| current_password |string | sim | Senha atual do usuario|
| new_email |string | sim | Novo email do usuário|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| --- |
|200 |OK |Novo email confirmado|
|401 | UNAUTHORIZED |Senha atual errada ou o token do usuário é inválido|
|400 | BAD_REQUEST |O formato do novo email não é valido|

> Exemplos de requisição

```json
{
 "current_password":"1231234",
 "new_email":"Caiofeio@hotmail.com",
}
```
## /us/auth/login (POST)

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
|cpf |string | sim | CPF do usuario|
|password |string | sim |Senha do usuário|

### Tipos de Retorno
|STATUS | TYPE |Descrição|
| --- |---| ---|
|200 | OK |Login realizado|
|401 | UNAUTHORIZED |Cpf e senha não batem|
|400 | BAD_PARAMETERS |Espaços em branco (CPF ou senha)|

> Exemplos de requisição

```json
 {
   "cpf":"615281665",
   "password":"54321768",
 }
```
## /us/auth/recovery-password (POST)

### Parametros de entrada

|Nome do Parametro| Tipo de entrada | Obrigatório | Detalhe|
| --- |--- |--- |---|
| cpf |string | sim | CPF do usuario|

### Tipos de Retorno
|STATUS | TYPE | Descrição|
| --- |---| --- |
|200 | OK |Senha recuperada|
|400 | BAD_REQUEST |CPF invalido|

> Exemplos de requisição

```json
{
 "cpf":"124331234",
}
```
## /us/user/get-pass (GET)

Esse Endpoint não recebe parametros de entrada

### Tipos de Retorno
|STATUS | TYPE | Descrição|
| --- |---| --- |
|200 | OK |passcode enviado|
|401 | UNAUTHORIZED |Token do usuário inválido|

## /us/universities (GET)
### Tipos de Retorno
|STATUS | TYPE | Descrição|
| --- |---| --- |
|200 | OK | Enviará as universidades em um array contendo o ID e a Instituição de ensino |

> Exemplo de retorno

```json
{
  "type": "OK",
  "data": [
    {
      "_id": "5b01e51bd595a003595c688d",
      "university_name": "Universidade de Brasília"
    }
  ],
  "info": null
}
```
