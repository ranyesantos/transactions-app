
# Sumário

- [Sumário](#sumário)
- [API](#api)
  - [🗄️ Tabelas do banco de dados](#️-tabelas-do-banco-de-dados)
    - [Transactions](#transactions)
    - [Categories](#categories)
  - [📍 Endpoints](#-endpoints)
    - [Transações](#transações)
    - [Categorias](#categorias)
  - [🔄 Respostas e/ou Requisições](#-respostas-eou-requisições)
    - [GET /transactions - Listar todas as transações](#get-transactions---listar-todas-as-transações)
    - [GET /transactions/{transaction} - Exibir detalhes de uma transação](#get-transactionstransaction---exibir-detalhes-de-uma-transação)
    - [POST /transactions - Adicionar uma nova transação](#post-transactions---adicionar-uma-nova-transação)
    - [PUT /transactions/{transaction} - Editar os dados de uma transação](#put-transactionstransaction---editar-os-dados-de-uma-transação)
    - [DELETE /transactions/{transactions} - Deletar uma transação](#delete-transactionstransactions---deletar-uma-transação)
    - [GET /categories - Listar todas as categorias](#get-categories---listar-todas-as-categorias)
    - [GET /categories/{category} - Exibir detalhes de uma categoria](#get-categoriescategory---exibir-detalhes-de-uma-categoria)
    - [POST /categories - Adicionar uma nova categoria](#post-categories---adicionar-uma-nova-categoria)
  - [🔧 Services](#-services)
    - [TransactionService](#transactionservice)
      - [Métodos](#métodos)
      - [`getTransactions(Request $request): LengthAwarePaginator`](#gettransactionsrequest-request-lengthawarepaginator)
      - [`createTransaction(array $data): Transaction`](#createtransactionarray-data-transaction)
      - [`updateTransaction(Transaction $transaction, array $data): Transaction`](#updatetransactiontransaction-transaction-array-data-transaction)
      - [`adjustAmount(float $amount, string $type): float`](#adjustamountfloat-amount-string-type-float)
- [Front-end](#front-end)
  - [Rotas](#rotas)
    - [Descrição das Rotas](#descrição-das-rotas)
      - [1. Rota Padrão (Home)](#1-rota-padrão-home)
      - [2. Listagem de Transações](#2-listagem-de-transações)
      - [3. Criação de Nova Transação](#3-criação-de-nova-transação)
      - [4. Detalhes da Transação](#4-detalhes-da-transação)
      - [5. Edição de Transação](#5-edição-de-transação)
  - [Components](#components)
    - [`TransactionsListComponent`](#transactionslistcomponent)
      - [Importações Necessárias](#importações-necessárias)
      - [Propriedades](#propriedades)
        - [Transações e Paginação](#transações-e-paginação)
        - [Categorias e Filtros](#categorias-e-filtros)
      - [Construtor](#construtor)
      - [Metodos](#metodos)
        - [`ngOnInit()`](#ngoninit)
        - [`fetchTransactions(page: number = 1, filters?: any)`](#fetchtransactionspage-number--1-filters-any)
        - [`editTransaction(id: number)`](#edittransactionid-number)
        - [`deleteTransaction(id: number)`](#deletetransactionid-number)
        - [`onFiltersChanged()`](#onfilterschanged)
        - [`fetchCategories()`](#fetchcategories)
        - [`getCategoryNameById(id: number | string | null): string`](#getcategorynamebyidid-number--string--null-string)
        - [`applyFilters()`](#applyfilters)
        - [`pageChanged(page: number)`](#pagechangedpage-number)
    - [`TransactionNewComponent`](#transactionnewcomponent)
      - [Importações Necessárias](#importações-necessárias-1)
      - [Propriedades](#propriedades-1)
        - [Transação](#transação)
        - [Estado de Categoria](#estado-de-categoria)
        - [Listagem de Categorias](#listagem-de-categorias)
        - [Mensagens de Erro](#mensagens-de-erro)
      - [Construtor](#construtor-1)
      - [Metodos](#metodos-1)
        - [`ngOnInit()`](#ngoninit-1)
        - [`addTransaction()`](#addtransaction)
        - [`cancel()`](#cancel)
        - [`submitTransaction()`](#submittransaction)
        - [`onTypeChange()`](#ontypechange)
        - [`onCategoryChange()`](#oncategorychange)
        - [`fetchCategories()`](#fetchcategories-1)
    - [`TransactionEditComponent`](#transactioneditcomponent)
      - [Importações Necessárias](#importações-necessárias-2)
      - [Propriedades](#propriedades-2)
        - [Transação](#transação-1)
        - [Estado de Categoria](#estado-de-categoria-1)
        - [Listagem de Categorias](#listagem-de-categorias-1)
        - [Mensagens de Erro](#mensagens-de-erro-1)
      - [Construtor](#construtor-2)
      - [Metodos](#metodos-2)
        - [`ngOnInit()`](#ngoninit-2)
        - [`show()`](#show)
        - [`fetchTransaction(id: number)`](#fetchtransactionid-number)
        - [`editTransaction()`](#edittransaction)
        - [`cancel()`](#cancel-1)
        - [`submitTransaction()`](#submittransaction-1)
        - [`onTypeChange()`](#ontypechange-1)
        - [`onCategoryChange()`](#oncategorychange-1)
        - [`fetchCategories()`](#fetchcategories-2)
    - [`TransactionEditComponent`](#transactioneditcomponent-1)
      - [Importações Necessárias](#importações-necessárias-3)
      - [Propriedades](#propriedades-3)
        - [Transação](#transação-2)
        - [Estado de Categoria](#estado-de-categoria-2)
        - [Listagem de Categorias](#listagem-de-categorias-2)
        - [Mensagens de Erro](#mensagens-de-erro-2)
      - [Construtor](#construtor-3)
      - [Metodos](#metodos-3)
        - [`ngOnInit()`](#ngoninit-3)
        - [`show()`](#show-1)
        - [`fetchTransaction(id: number)`](#fetchtransactionid-number-1)
        - [`editTransaction()`](#edittransaction-1)
        - [`cancel()`](#cancel-2)
        - [`submitTransaction()`](#submittransaction-2)
        - [`onTypeChange()`](#ontypechange-2)
        - [`onCategoryChange()`](#oncategorychange-2)
        - [`fetchCategories()`](#fetchcategories-3)
    - [`TransactionDetailsComponent`](#transactiondetailscomponent)
      - [Importações Necessárias](#importações-necessárias-4)
      - [Propriedades](#propriedades-4)
        - [Transação](#transação-3)
        - [Categoria](#categoria)
        - [Tipo da Transação](#tipo-da-transação)
      - [Construtor](#construtor-4)
      - [Metodos](#metodos-4)
        - [`ngOnInit()`](#ngoninit-4)
        - [`show()`](#show-2)
        - [`fetchTransaction(id: number)`](#fetchtransactionid-number-2)
        - [`translateType()`](#translatetype)
        - [`showCategory()`](#showcategory)
        - [`cancel()`](#cancel-3)
        - [`editTransaction(id: number)`](#edittransactionid-number-1)
        - [`deleteTransaction(id: number)`](#deletetransactionid-number-1)
        - [`fetchCategory(id: number)`](#fetchcategoryid-number)
  - [Services](#services)
    - [`TransactionsService`](#transactionsservice)
      - [Descrição](#descrição)
      - [Importações](#importações)
      - [Interfaces](#interfaces)
        - [`Transaction`](#transaction)
        - [`PaginatedResponse`](#paginatedresponse)
      - [Decorador](#decorador)
        - [`@Injectable({ providedIn: 'root' })`](#injectable-providedin-root-)
      - [Propriedades](#propriedades-5)
        - [`private apiUrl: string`](#private-apiurl-string)
      - [Construtor](#construtor-5)
      - [Metodos](#metodos-5)
        - [`getTransactions(page: number, filters?: any): Observable<PaginatedResponse>`](#gettransactionspage-number-filters-any-observablepaginatedresponse)
        - [`addTransaction(transaction: Transaction): Observable<Transaction>`](#addtransactiontransaction-transaction-observabletransaction)
        - [`getTransactionById(id: number): Observable<Transaction>`](#gettransactionbyidid-number-observabletransaction)
        - [`deleteTransaction(id: number): Observable<Transaction>`](#deletetransactionid-number-observabletransaction)
        - [`editTransaction(id: number, transaction: Transaction): Observable<Transaction>`](#edittransactionid-number-transaction-transaction-observabletransaction)
    - [`CategoryService`](#categoryservice)
      - [Descrição](#descrição-1)
      - [Importações](#importações-1)
      - [Interfaces](#interfaces-1)
        - [`Category`](#category)
      - [Decorador](#decorador-1)
        - [`@Injectable({ providedIn: 'root' })`](#injectable-providedin-root--1)
      - [Propriedades](#propriedades-6)
        - [`private apiUrl: string`](#private-apiurl-string-1)
      - [Construtor](#construtor-6)
      - [Métodos](#métodos-1)
        - [`getCategories(): Observable<Category[]>`](#getcategories-observablecategory)
        - [`addCategory(name: string): Observable<{ category: Category; message: string }>`](#addcategoryname-string-observable-category-category-message-string-)
        - [`getCategoryById(id: number): Observable<Category>`](#getcategorybyidid-number-observablecategory)



<br>

---
<br>

<h1>📋 Pré-requisitos</h1>

1. **PHP** Versão: >= 8.2
2. **Composer**
3. **Node.js**
4. **Angular CLI**

<h1>▶️ Como rodar</h1>

<h2>Back-end</h2>
<br>

1. **Clonar o Repositório do GitHub**
   
   Abra o terminal e execute:

    ```sh
    git clone https://github.com/ranyesantos/transactions-app.git
    ```

    
2. **Selecionar Diretório**

    para selecionar o diretório do projeto, execute:
    ```sh
    cd transactions-app/backend
    ```

3. **Instalar Dependências**
    
    No diretório do projeto, execute:
    ```sh
    composer install
    ```
    
4. **Configurar Variáveis de Ambiente**

    Copie o arquivo `.env.example` para `.env` com o comando:
    ```sh
    cp .env.example .env
    ```

    Edite o arquivo .env com suas configurações de banco de dados e outras variáveis de ambiente necessárias. Por exemplo:
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=phonebook_db
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

5. **Gerar a Chave da Aplicação**

    Execute o comando para gerar a chave da aplicação:
    ```sh
    php artisan key:generate
    ```

6. **Execute Migrations e Seeders**

    Execute as migrations para criar as tabelas no banco de dados
    ```sh
    php artisan migrate
    ```

    <!-- (Opcional) Após executar as migrations, popule o banco de dados com o comando:
    ```sh
    php artisan db:seed
    ``` -->

7. **Iniciar o Servidor de Desenvolvimento**

    Para iniciar o servidor embutido do Laravel, execute o comando:
    ```sh
    php artisan serve
    ```
<br>

<h2>Front-end</h2>

1. **Selecionar diretório**
   
   Se estiver no diretório de back-end, abra o terminal e execute:

    ```sh
    cd ../frontend
    ```
    Se estiver no diretório raiz, execute:
    ```sh
    cd frontend
    ```
2. **Instalar dependências**

    Com o diretório selecionado, execute no terminal:
    ```sh
    npm install
    ```
3. **Iniciar o Servidor de Desenvolvimento**

    ```sh
    ng serve
    ```
<br>

# API

## 🗄️ Tabelas do banco de dados

### Transactions

| Coluna       | Tipo         | Características                         |
|--------------|--------------|-----------------------------------------|
| `id`         | `bigint`     | Chave primária, auto-incremento        |
| `description`| `string`     | Texto, não nulo                         |
| `category_id`| `bigint`     | Chave estrangeira, nulo permitido, relacionado com a tabela `categories`, OnDelete do tipo cascade |
| `amount`     | `decimal(10,2)` | Valor decimal com duas casas decimais  |
| `type`       | `enum`       | Deve ser obrigatoriamente 'income' ou 'expense'         |
| `date`       | `date`       | Data, não nulo                         |
| `created_at` | `timestamp`  | Registro de data/hora de criação       |
| `updated_at` | `timestamp`  | Registro de data/hora de atualização   |

<br>

### Categories

| Coluna     | Tipo      | Características                  |
|------------|-----------|----------------------------------|
| `id`       | `bigint`  | Chave primária, auto-incremento |
| `name`     | `string`  | Texto, único, não nulo          |
| `created_at` | `timestamp` | Registro de data/hora de criação |
| `updated_at` | `timestamp` | Registro de data/hora de atualização |


<br>

## 📍 Endpoints


### Transações

| **Rota**                | **Descrição**                                            
|----------------------|-----------------------------------------------------|
| <kbd>GET /transactions</kbd>   | Retorna a listagem com todas as transações - [detalhes da resposta](#get-transactions---listar-todas-as-transações)|
| <kbd>GET /transactions/{transaction}</kbd>     | Retorna os detalhes de uma transação específica - [detalhes da resposta](#get-transactionstransaction---exibir-detalhes-de-uma-transação)|
| <kbd>POST /transactions</kbd>     | Adicionar uma nova transação - [detalhes da requisição/resposta](#post-transactions---adicionar-uma-nova-transação)|
| <kbd>PUT /transactions/{transaction}</kbd>     | Edição de uma transação existente - [detalhes da requisição/resposta](#put-transactionstransaction---editar-os-dados-de-uma-transação)|
| <kbd>DELETE /transactions/{transaction}</kbd>     | Exclusão de uma transação - [detalhes resposta](#delete-transactionstransactions---deletar-uma-transação)|

<br>

### Categorias

| **Rota**                | **Descrição**                                            
|----------------------|-----------------------------------------------------|
| <kbd>GET /categories</kbd>   | Retorna a listagem com todas as categorias - [detalhes da resposta](#get-categories---listar-todas-as-categorias)|
| <kbd>GET /categories/{category}</kbd>     | Retorna os detalhes de uma categoria específica - [detalhes da resposta](#get-categoriescategory---exibir-detalhes-de-uma-categoria)|
| <kbd>POST /categories</kbd>     | Adicionar uma nova categoria - [detalhes da requisição/resposta](#post-categories---adicionar-uma-nova-categoria)|

<br>

## 🔄 Respostas e/ou Requisições</h1>


<br>

### GET /transactions - Listar todas as transações</h3>

**RESPOSTA**
```json
{
	"current_page": 1,
	"data": [
		{
			"id": 2,
			"description": "Pagamento casa",
			"category_id": 5,
			"amount": "-333.00",
			"type": "expense",
			"date": "2024-11-06",
			"created_at": "2024-11-03T16:50:31.000000Z",
			"updated_at": "2024-11-03T18:43:14.000000Z"
		},
		{
			"id": 4,
			"description": "Pagamento almoço",
			"category_id": 4,
			"amount": "-32.00",
			"type": "expense",
			"date": "2024-11-07",
			"created_at": "2024-11-03T18:41:07.000000Z",
			"updated_at": "2024-11-03T18:41:07.000000Z"
		},
		{
			"id": 5,
			"description": "Venda de telefone",
			"category_id": 6,
			"amount": "800.00",
			"type": "income",
			"date": "2024-11-01",
			"created_at": "2024-11-03T18:44:34.000000Z",
			"updated_at": "2024-11-03T18:44:42.000000Z"
		}
	],
	"first_page_url": "http:\/\/127.0.0.1:8000\/api\/transactions?page=1",
	"from": 1,
	"last_page": 1,
	"last_page_url": "http:\/\/127.0.0.1:8000\/api\/transactions?page=1",
	"links": [],
	"next_page_url": null,
	"path": "http:\/\/127.0.0.1:8000\/api\/transactions",
	"per_page": 10,
	"prev_page_url": null,
	"to": 3,
	"total": 3
}
```

<br>

---

<br>

### GET /transactions/{transaction} - Exibir detalhes de uma transação

**RESPOSTA**
```json
{
	"id": 5,
	"description": "Venda de telefone",
	"category_id": 6,
	"amount": "800.00",
	"type": "income",
	"date": "2024-11-01",
	"created_at": "2024-11-03T18:44:34.000000Z",
	"updated_at": "2024-11-03T18:44:42.000000Z"
}
```

<br>

---

<br>

### POST /transactions - Adicionar uma nova transação

**REQUISIÇÃO**
```json
{
	"description": "Venda violão",
	"category_id": 6,
	"amount": "32",
	"type": "income",
	"date": "2024/08/11"
}
```
**RESPOSTA**
```json
{
	"transaction": {
		"description": "Venda violão",
		"category_id": 6,
		"amount": 32,
		"type": "income",
		"date": "2024\/08\/11",
		"updated_at": "2024-11-03T18:55:13.000000Z",
		"created_at": "2024-11-03T18:55:13.000000Z",
		"id": 6
	},
	"message": "Transação adicionada com sucesso"
}
```

<br>

---

<br>

### PUT /transactions/{transaction} - Editar os dados de uma transação

**REQUISIÇÃO**
```json
{
	"description": "Venda violão",
	"category_id": 6,
	"amount": "30",
	"type": "income",
	"date": "2024/08/11"
}
```
**RESPOSTA**
```json
{
	"transaction": {
		"id": 6,
		"description": "Venda violão",
		"category_id": 6,
		"amount": 30,
		"type": "income",
		"date": "2024\/08\/11",
		"created_at": "2024-11-03T18:55:13.000000Z",
		"updated_at": "2024-11-03T18:59:17.000000Z"
	},
	"message": "Transação editada com sucesso"
}
```
<br>

---

<br>

### DELETE /transactions/{transactions} - Deletar uma transação 

**RESPOSTA**
```json
{
	"message": "Transação excluída com sucesso"
}
```

<br>

---

### GET /categories - Listar todas as categorias

**RESPOSTA**
```json
[
    {
		"id": 4,
		"name": "comida",
		"created_at": "2024-11-03T18:41:07.000000Z",
		"updated_at": "2024-11-03T18:41:07.000000Z"
	},
	{
		"id": 5,
		"name": "Aluguel",
		"created_at": "2024-11-03T18:43:14.000000Z",
		"updated_at": "2024-11-03T18:43:14.000000Z"
	},
	{
		"id": 6,
		"name": "venda",
		"created_at": "2024-11-03T18:44:34.000000Z",
		"updated_at": "2024-11-03T18:44:34.000000Z"
	},
]
```
<br>

---

<br>

### GET /categories/{category} - Exibir detalhes de uma categoria

**RESPOSTA**
```json
{
	"id": 5,
	"name": "Aluguel",
	"created_at": "2024-11-03T18:43:14.000000Z",
	"updated_at": "2024-11-03T18:43:14.000000Z"
}
```
<br>

---

<br>

### POST /categories - Adicionar uma nova categoria

**REQUISIÇÃO**
```json
{
	"name": "lazer"
}

```
**RESPOSTA**
```json
{
	"category": {
		"name": "lazer",
		"updated_at": "2024-11-03T19:14:19.000000Z",
		"created_at": "2024-11-03T19:14:19.000000Z",
		"id": 8
	},
	"message": "Categoria criada com sucesso"
}
```

<br>

---

<br>


## 🔧 Services

### TransactionService

**Descrição** Classe responsável pela lógica de negócios das transações

<hr>

#### Métodos

#### `getTransactions(Request $request): LengthAwarePaginator`

Obtém uma lista paginada de transações financeiras, permitindo filtrar os resultados com base nos parâmetros fornecidos na solicitação HTTP.

Este método serve para exibir uma lista de transações, onde o usuário pode visualizar e filtrar transações por tipo ('receita' ou 'despesa').

**Parâmetros:**
- `Request $request`: A solicitação HTTP que contém parâmetros de filtro. Este objeto pode incluir:
  - `type` (opcional): O tipo de transação a ser filtrado. Aceita valores como 'income' ou 'expense'. Se não for fornecido, todas as transações serão retornadas.

**Retorno:**
- `LengthAwarePaginator`: Uma instância do paginador que contém as transações. Este objeto fornece informações sobre a lista de transações, incluindo:
  - `data`: A collection de transações paginadas para a página atual.
  - `current_page`: O número da página atual.
  - `last_page`: O número total de páginas.
  - `per_page`: O número de itens exibidos por página.
  - `total`: O número total de itens disponíveis.

**Funcionamento:**
1. Inicialização da consulta de transações usando `Transaction::query()`.
2. Verifica se a solicitação contém um parâmetro `type` e se este não é nulo.
   - Se o parâmetro `type` estiver presente e tiver um valor, adiciona uma cláusula `where` à consulta para filtrar as transações com base nesse tipo.
3. Executa a consulta com `paginate`, limitando os resultados a 15 transações por página.

**Exemplo de uso:**
```php
$transactions = $transactionService->getTransactions($request);
```
<br>

---

<br>

#### `createTransaction(array $data): Transaction`

Cria uma transação financeira ajustando o valor conforme o tipo especificado (receita ou despesa). 

**Parâmetros:**
- `array $data`: Um array associativo contendo os dados necessários para criar a transação. Este array deve incluir:
  - `description` (string): Uma descrição da transação (ex: "Compra de material de escritório").
  - `amount` (float): O valor da transação. Se o tipo for 'expense', o valor será ajustado para um número negativo. Para receitas, o valor será armazenado como positivo.
  - `type` (string): O tipo da transação, que pode ser 'expense' para despesas ou 'income' para receitas.
  - `category_id` (int|null): O ID da categoria associada à transação. Este campo é opcional e pode ser nulo.
  - `date` (string): A data da transação em formato 'Y-m-d' (ex '2024-11-03').

**Retorno:**
- `Transaction`: Uma instância da classe `Transaction`, representando a nova transação que foi criada. Esta instância contém todos os atributos da transação, incluindo o ID gerado, timestamp, e os dados fornecidos.

**Funcionamento:**
1. O método recebe um array `$data` com os detalhes da transação.
2. Antes de criar a transação, o método chama `adjustAmount` para ajustar o valor (`amount`) de acordo com o tipo:
   - Se o tipo for 'expense', o método `adjustAmount` retornará o valor como um número negativo.
3. Após ajustar o valor, o método utiliza a model `Transaction` para criar uma nova instância no banco de dados com os dados fornecidos.
4. A nova transação é salva no banco de dados e o método retorna a instância da transação criada.

**Exemplo de uso:**
```php
$data = [
    'amount' => 100.00,
    'type' => 'expense',
    'description' => 'Compra de material de escritório',
    'date' => '2024-11-03',
];
// Cria a transação usando o service
$transaction = $transactionService->createTransaction($data);
```

<br>

---

<br>

#### `updateTransaction(Transaction $transaction, array $data): Transaction`

Atualiza uma transação existente com novos dados.

**Parâmetros:**
- `Transaction $transaction`: A instância da transação que será atualizada.
- `array $data`: Um array associativo contendo os dados que serão atualizados. Este array deve incluir:
  - `description` (string): Uma nova descrição da transação, que fornece contexto sobre o que a transação representa (ex: "Venda de produtos").
  - `amount` (decimal): O novo valor da transação. Se o `type` for 'expense', o valor será ajustado para um número negativo.
  - `type` (enum): O novo tipo da transação, que pode ser 'expense' para despesas ou 'income' para receitas.
  - `category_id` (int|null, opcional): O ID da nova categoria associada à transação. Este campo é opcional e pode ser nulo.
  - `date` (date): A nova data da transação, no formato 'Y-m-d' (ex: '2024-11-03').

**Retorno:**
- `Transaction`: A instância da classe `Transaction`, com os dados atualizados da transação.

**Funcionamento:**
1. O método recebe a instância da transação que deve ser atualizada e um array `$data` com os novos detalhes.
2. O método ajusta o valor (`amount`) conforme o tipo especificado:
   - Se o tipo for 'expense', o método `adjustAmount` retornará o valor como um número negativo.
3. Os dados da transação são então atualizados com os novos valores.
4. Após a atualização, o método retorna a instância da transação atualizada.

**Exemplo de uso:**
```php
$data = [
    'description' => 'Venda de produtos',
    'amount' => 150.00,
    'type' => 'income',
    'category_id' => 1, // ID de uma categoria existente
    'date' => '2024-11-03', // nova data da transação
];

$updatedTransaction = $transactionService->updateTransaction($existingTransaction, $data);
```
<br>

---

<br>

#### `adjustAmount(float $amount, string $type): float`
Método privado que ajusta o valor da transação baseado no tipo, tornando negativo para despesas.

**Parâmetros:**
- `float $amount`: O valor a ser ajustado
- `string $type`: O tipo da transação ('expense' ou 'income')

**Retorno:**
- `float`: O valor ajustado (negativo para despesas, positivo para outros tipos)

**Notas:**
- Este é um método privado que é utilizado internamente pelos métodos `createTransaction` e `updateTransaction`.
- Se o tipo da transação for uma despesa, retorna um valor negativo usando a função `abs()`.

**Exemplo de uso interno:**
```php
$adjustedAmount = $this->adjustAmount(100.00, 'expense'); // Retorna -100.00
$adjustedAmount = $this->adjustAmount(100.00, 'income');  // Retorna 100.00
<<<<<<< HEAD
```
<br>

---

<br>


# Front-end

## Rotas


| Path                    | Componente                | Descrição                                         |
|-------------------------|---------------------------|---------------------------------------------------|
| `''`                    | Redireciona para `/transactions` | Rota inicial da aplicação                        |
| `/transactions`         | `TransactionsListComponent` | Lista todas as transações                         |
| `/transaction-new`      | `TransactionNewComponent`  | Formulário para criar nova transação              |
| `/transaction/:id`      | `TransactionDetailsComponent` | Exibe os detalhes de uma transação específica     |
| `/transaction/edit/:id` | `TransactionEditComponent`  | Formulário para editar uma transação existente    |

<br>

```typescript
const routes: Routes = [
  { path: '', redirectTo: '/transactions', pathMatch: 'full' },
  { path: 'transactions', component: TransactionsListComponent },
  { path: 'transaction-new', component: TransactionNewComponent },
  { path: 'transaction/:id', component: TransactionDetailsComponent },
  { path: 'transaction/edit/:id', component: TransactionEditComponent }
];
```

---
### Descrição das Rotas

#### 1. Rota Padrão (Home)
- **Path**: `''`
- **Redirecionamento**: `/transactions`
- **Configuração**: `{ path: '', redirectTo: '/transactions', pathMatch: 'full' }`
- **Comportamento**:
  - Quando a aplicação é carregada sem uma rota específica (por exemplo, `http://localhost:4200/`), ela redireciona automaticamente para `/transactions`.
  - A propriedade `pathMatch: 'full'` indica que essa rota é acionada apenas se a URL for exatamente `'/'` (vazia).

#### 2. Listagem de Transações
- **Path**: `'transactions'`
- **Componente**: `TransactionsListComponent`
- **Configuração**: `{ path: 'transactions', component: TransactionsListComponent }`
- **Descrição**:
  - Exibe uma lista de todas as transações registradas no sistema.
  - Acessível em `http://localhost:4200/transactions`.
  - Este é o componente principal da aplicação, exibindo uma visão geral das transações com opções para criar, visualizar, editar ou excluir registros.

#### 3. Criação de Nova Transação
- **Path**: `'transaction-new'`
- **Componente**: `TransactionNewComponent`
- **Configuração**: `{ path: 'transaction-new', component: TransactionNewComponent }`
- **Descrição**:
  - Exibe um formulário para criar uma nova transação.
  - Acessível em `http://localhost:4200/transaction-new`.
  - O componente associado (`TransactionNewComponent`) gerencia o formulário e a lógica para adicionar uma nova transação ao sistema.

#### 4. Detalhes da Transação
- **Path**: `'transaction/:id'`
- **Componente**: `TransactionDetailsComponent`
- **Configuração**: `{ path: 'transaction/:id', component: TransactionDetailsComponent }`
- **Parâmetro de Rota**: `:id`
  - `:id` é um parâmetro dinâmico que representa o identificador único da transação.
  - Permite a navegação para uma página de detalhes específica de acordo com o ID passado na URL.
- **Descrição**:
  - Exibe os detalhes completos de uma transação específica.
  - Acessível em `http://localhost:4200/transaction/{id}`, onde `{id}` é substituído pelo ID da transação.
  - Exemplo: `http://localhost:4200/transaction/1` para acessar a transação com ID `1`.
  - Esse componente recupera e exibe dados completos da transação baseada no ID fornecido.

#### 5. Edição de Transação
- **Path**: `'transaction/edit/:id'`
- **Componente**: `TransactionEditComponent`
- **Configuração**: `{ path: 'transaction/edit/:id', component: TransactionEditComponent }`
- **Parâmetro de Rota**: `:id`
  - `:id` é um parâmetro dinâmico que representa o identificador único da transação que será editada.
- **Descrição**:
  - Exibe um formulário para editar uma transação existente.
  - Acessível em `http://localhost:4200/transaction/edit/{id}`, onde `{id}` é o ID da transação que o usuário deseja modificar.
  - Exemplo: `http://localhost:4200/transaction/edit/1` para editar a transação com ID `1`.
  - O componente associado (`TransactionEditComponent`) gerencia a lógica de atualização dos dados da transação.

<br>

---

<br>

## Components

<br>


###  `TransactionsListComponent`

O componente `TransactionsListComponent` exibe a lista de transações registradas na aplicação, oferecendo funcionalidades de filtragem e paginação dos dados.

#### Importações Necessárias

```typescript
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';
```

- **Component**: Declara o decorator `@Component` que define as metadatas do componente.
- **OnInit**: Interface para implementar o método `ngOnInit`.
- **Router**: Para navegação entre rotas.
- **TransactionsService**: Serviço responsável por obter, deletar e gerenciar transações.
- **CategoryService**: Serviço para obter categorias de transações.

#### Propriedades

##### Transações e Paginação

- `transactions: Transaction[]`: Armazena a lista de transações recebidas do serviço.
- `currentPage: number`: Número da página atual na navegação por paginação.
- `totalPages: number`: Total de páginas disponíveis para navegação.
- `errorMessage: string | null`: Mensagem de erro para capturar e exibir erros de requisição.

##### Categorias e Filtros

- `categories: Category[]`: Lista de categorias carregadas para exibir os nomes das categorias associadas às transações.
- `selectedType: string`: Tipo de transação selecionado como filtro.

<br>

#### Construtor

```typescript
constructor(
  private transactionsService: TransactionsService,
  private router: Router,
  private categoriesService: CategoryService
) {}
```

- **transactionsService**: Serviço para operações relacionadas a transações.
- **router**: Roteador para navegação.
- **categoriesService**: Serviço para obter dados de categorias.


#### Metodos


##### `ngOnInit()`

```typescript
ngOnInit(): void {
  this.fetchTransactions(this.currentPage);
  this.fetchCategories();
}
```

- Inicializa o componente ao carregar a primeira página de transações e as categorias disponíveis.
- **Chama**: `fetchTransactions` com a página inicial (1) e `fetchCategories`.

<br>

##### `fetchTransactions(page: number = 1, filters?: any)`

```typescript
fetchTransactions(page: number = 1, filters?: any): void {
  this.transactionsService.getTransactions(page, filters).subscribe({
    next: (data) => {
        this.transactions = data.data;
        this.totalPages = data.last_page;
        this.currentPage = data.current_page;
    },
  });
}
```

- **Descrição**: Recupera a lista de transações da API, de acordo com a página e os filtros aplicados.
- **Parâmetros**:
  - `page`: Número da página para navegação.
  - `filters`: Filtros de busca (por exemplo, tipo de transação).
- **Assinatura**: Subscreve-se ao método `getTransactions` do serviço e atualiza as propriedades `transactions`, `totalPages` e `currentPage`.

<br>

##### `editTransaction(id: number)`

```typescript
editTransaction(id: number): void {
  this.router.navigate(['/transaction/:id', id]);
}
```

- **Descrição**: Navega para a página de edição de uma transação específica.
- **Parâmetro**:
  - `id`: Identificador da transação que será editada.
- **Função**: Usa o `Router` para redirecionar o usuário.

<br>

##### `deleteTransaction(id: number)`

```typescript
deleteTransaction(id: number): void {
  if (confirm('Tem certeza de que deseja deletar esta transação?')) {
    this.transactionsService.deleteTransaction(id).subscribe(
      () => {
        this.transactions = this.transactions.filter(transaction => transaction.id !== id);
        alert('Transação deletada com sucesso');
      },
    );
  }
}
```

- **Descrição**: Deleta uma transação específica após confirmação do usuário.
- **Parâmetro**:
  - `id`: Identificador da transação a ser excluída.
- **Função**: Após a exclusão bem-sucedida, atualiza a lista `transactions` para remover a transação excluída.

<br>

##### `onFiltersChanged()`

```typescript
onFiltersChanged(): void {
  const filters = {
    type: this.selectedType,
  };
  this.fetchTransactions(this.currentPage, filters);
}
```

- **Descrição**: Atualiza a lista de transações com os filtros selecionados.
- **Função**: Cria um objeto de filtro (`filters`) e chama `fetchTransactions` com a página atual e o filtro.

<br>

##### `fetchCategories()`

```typescript
fetchCategories() {
  this.categoriesService.getCategories().subscribe({
    next: (data) => {
      this.categories = data;
    }
  });
}
```

- **Descrição**: Recupera a lista de categorias disponíveis para exibir os nomes no lugar dos IDs.
- **Função**: Atualiza `categories` com as categorias obtidas.

<br>

##### `getCategoryNameById(id: number | string | null): string`

```typescript
getCategoryNameById(id: number | string | null): string {
  if (id === null) return 'N/A';
  const category = this.categories.find(cat => cat.id === Number(id));
  return category ? category.name : 'Categoria Desconhecida';
}
```

- **Descrição**: Busca o nome da categoria a partir de seu ID.
- **Parâmetro**:
  - `id`: ID da categoria a ser exibida.
- **Retorna**: Nome da categoria, ou `'N/A'` se o ID for `null`.

<br>

##### `applyFilters()`

```typescript
applyFilters(): void {
  this.fetchTransactions(this.currentPage);
}
```

- **Descrição**: Aplica filtros à lista de transações (atualmente reusa `fetchTransactions` com a página atual).

<br>

##### `pageChanged(page: number)`

```typescript
pageChanged(page: number): void {
  this.currentPage = page;
  this.fetchTransactions(this.currentPage);
}
```

- **Descrição**: Atualiza a página atual e carrega as transações correspondentes.
- **Parâmetro**:
  - `page`: Número da página para carregar.

<br>

---

<br>

### `TransactionNewComponent`

O componente `TransactionNewComponent` é responsável por gerenciar o formulário de criação de uma nova transação.

---


#### Importações Necessárias

```typescript
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';
```

- **Component**: Declara o decorator `@Component` que define metadados do componente.
- **OnInit**: Interface para implementar o método `ngOnInit`.
- **Router**: Para navegação entre rotas.
- **TransactionsService**: Serviço responsável pela criação de novas transações.
- **CategoryService**: Serviço para obter e adicionar novas categorias de transações.

---

#### Propriedades

##### Transação

- `newTransaction: Transaction`: Objeto que armazena os dados da nova transação a ser criada.
  - **Atributos**:
    - `id`: ID da transação, inicializado como `0`.
    - `description`: Descrição da transação.
    - `category_id`: ID da categoria, pode ser `0`, um valor numérico ou `null`.
    - `amount`: Valor da transação.
    - `type`: Tipo da transação, que pode ser receita ou despesa.
    - `date`: Data da transação.

##### Estado de Categoria

- `categoryCreated: number | null`: Armazena o ID da categoria criada, caso uma nova seja adicionada.
- `isNewCategory: boolean`: Flag para verificar se o usuário deseja criar uma nova categoria.
- `newCategoryName: string`: Nome da nova categoria a ser criada.
- `selectedCategory: number | null`: ID da categoria selecionada no formulário.

##### Listagem de Categorias

- `categories: Category[]`: Lista de categorias disponíveis, carregadas do serviço `CategoryService`.

##### Mensagens de Erro

- `errorMessages: { [key: string]: string[] }`: Objeto de mensagens de erro para campos específicos do formulário.
- `categoryErrors: { name: string[] }`: Mensagens de erro específicas para o campo `name` ao adicionar uma nova categoria.

---

#### Construtor

```typescript
constructor(
  private transactionsService: TransactionsService,
  private router: Router,
  private categoriesService: CategoryService
) {}
```

- **transactionsService**: Serviço para operações de transações.
- **router**: Roteador para navegação.
- **categoriesService**: Serviço para operações de categorias.

---

#### Metodos

##### `ngOnInit()`

```typescript
ngOnInit(): void {
  this.fetchCategories();
}
```

- **Descrição**: Inicializa o componente e carrega as categorias disponíveis para a transação.

---

##### `addTransaction()`

```typescript
addTransaction(): void {
  this.categoryErrors.name = [];
  if (this.isNewCategory && this.newCategoryName) {
    this.categoriesService.addCategory(this.newCategoryName).subscribe({
      next: (response) => {
        this.newTransaction.category_id = response.category.id;
        this.submitTransaction();
      },
      error: (err) => {
        this.categoryErrors.name = [''];
        if (err.error && err.error.errors) {
          this.categoryErrors.name = err.error.errors['name'];
        }
      }
    });
  }
  else if (this.selectedCategory) {
    this.newTransaction.category_id = this.selectedCategory;
    this.submitTransaction();
  } else {
    this.newTransaction.category_id = null;
    this.submitTransaction();
  }
}
```

- **Descrição**: Adiciona uma nova transação, verificando se o usuário deseja criar uma nova categoria.
- **Ações**:
  - Se `isNewCategory` for `true` e `newCategoryName` tiver um valor, cria uma nova categoria e a associa à transação.
  - Caso contrário, associa a transação a uma `selectedCategory` já existente.
  - Em caso de erro na criação da categoria, `categoryErrors.name` é atualizado.

---

##### `cancel()`

```typescript
cancel(): void {
  this.router.navigate(['../']);
}
```

- **Descrição**: Cancela a operação de criação e retorna à página anterior.

---

##### `submitTransaction()`

```typescript
private submitTransaction(): void {
  this.transactionsService.addTransaction(this.newTransaction).subscribe({
    next: () => {
      this.router.navigate(['/transactions']);
    },
    error: (err) => {
      this.errorMessages = {
        description: [],
        type: [],
        amount: [],
        category_id: [],
        date: []
      };
      if (err.error && err.error.errors) {
        for (const field in err.error.errors) {
          if (this.errorMessages.hasOwnProperty(field)) {
            this.errorMessages[field] = err.error.errors[field];
          }
        }
      }
    }
  });
}
```

- **Descrição**: Envia os dados da nova transação à API. Em caso de sucesso, redireciona o usuário para a página de transações. Se ocorrer um erro, preenche `errorMessages` com as mensagens de erro da API.

---

##### `onTypeChange()`

```typescript
onTypeChange(): void {
  if (this.newTransaction.type === 'expense' && this.newTransaction.amount > 0) {
    this.newTransaction.amount = -Math.abs(this.newTransaction.amount);
  }
}
```

- **Descrição**: Ajusta o valor de `amount` para negativo, caso o tipo de transação seja `expense`.

---

##### `onCategoryChange()`

```typescript
onCategoryChange(): void {
  this.selectedCategory = null;
  this.newCategoryName = '';
}
```

- **Descrição**: Realiza o reset da categoria.

---

##### `fetchCategories()`

```typescript
fetchCategories() {
  this.categoriesService.getCategories().subscribe({
    next: (data) => {
      this.categories = data;
    }
  });
}
```

- **Descrição**: Carrega a lista de categorias disponíveis através do serviço `CategoryService`.

<br>

---

<br>

### `TransactionEditComponent`

O `TransactionEditComponent` é responsável por exibir o formulário de edição de uma transação, permitindo que o usuário visualize e modifique os detalhes da transação existente. O componente oferece a opção de associar a transação a uma categoria já existente ou adicionar uma nova categoria. 

---

#### Importações Necessárias

```typescript
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';
```

- **Component**: Define o decorator `@Component`, especificando metadados do componente.
- **OnInit**: Interface para implementar o método `ngOnInit`.
- **ActivatedRoute**: Para acessar o parâmetro de rota, que contém o ID da transação a ser editada.
- **Router**: Para navegação entre rotas.
- **TransactionsService**: Serviço responsável por operações de CRUD de transações.
- **CategoryService**: Serviço para gerenciar categorias de transações, permitindo buscar e adicionar novas categorias.

---

#### Propriedades

##### Transação

- `transaction: Transaction`: Objeto que armazena os dados da transação a ser editada.
  - **Atributos**:
    - `id`: ID da transação.
    - `description`: Descrição da transação.
    - `category_id`: ID da categoria associada, pode ser `0`, `null` ou um valor numérico.
    - `amount`: Valor da transação.
    - `type`: Tipo de transação (`income` ou `expense`).
    - `date`: Data da transação.

##### Estado de Categoria

- `categoryCreated: number | null`: ID da categoria criada recentemente, caso o usuário opte por adicionar uma nova categoria.
- `isNewCategory: boolean`: Flag para verificar se o usuário deseja criar uma nova categoria.
- `newCategoryName: string`: Nome da nova categoria, caso o usuário opte por criar uma.
- `selectedCategory: number | null`: ID da categoria selecionada no formulário.

##### Listagem de Categorias

- `categories: Category[]`: Lista de categorias disponíveis, carregadas do serviço `CategoryService`.

##### Mensagens de Erro

- `errorMessages: { [key: string]: string[] }`: Objeto que armazena mensagens de erro para campos específicos do formulário.
- `categoryErrors: { name: string[] }`: Mensagens de erro específicas para o campo `name` ao adicionar uma nova categoria.

---

#### Construtor

```typescript
constructor(
  private transactionsService: TransactionsService,
  private route: ActivatedRoute,
  private router: Router,
  private categoriesService: CategoryService
) {}
```

- **transactionsService**: Serviço para operações de transações.
- **route**: Propriedade `ActivatedRoute` usada para acessar o parâmetro `id` da rota.
- **router**: Roteador para navegação.
- **categoriesService**: Serviço para operações de categorias.

---

#### Metodos

##### `ngOnInit()`

```typescript
ngOnInit(): void {
  this.show();
  this.fetchCategories();
}
```

- **Descrição**: Inicializa o componente, carregando os dados da transação e as categorias disponíveis.
- **Chama**:
  - `show()`: Carrega os dados da transação atual, com base no ID passado pela rota.
  - `fetchCategories()`: Obtém a lista de categorias disponíveis.

---

##### `show()`

```typescript
show(): void {
  const idString = this.route.snapshot.paramMap.get('id');
  const id = idString ? parseInt(idString, 10) : null;

  if (id) {
    this.fetchTransaction(id);
  }
}
```

- **Descrição**: Obtém o ID da transação a partir da rota e carrega os detalhes da transação correspondente.
- **Ações**:
  - Converte o ID de `string` para `number` e chama `fetchTransaction(id)` para buscar a transação.

---

##### `fetchTransaction(id: number)`

```typescript
fetchTransaction(id: number): void {
  this.transactionsService.getTransactionById(id).subscribe(
    data => {
      this.transaction = data;
    }
  );
}
```

- **Descrição**: Carrega os dados da transação específica, com base no ID fornecido.
- **Parâmetro**:
  - `id`: ID da transação a ser editada.
- **Assinatura**: Subscreve-se ao método `getTransactionById` do `transactionsService` para obter a transação e armazená-la em `transaction`.

---

##### `editTransaction()`

```typescript
editTransaction(): void {
  this.categoryErrors.name = [];

  if (this.isNewCategory && this.newCategoryName) {
    this.categoriesService.addCategory(this.newCategoryName).subscribe({
      next: (response) => {
        this.transaction.category_id = response.category.id;
        this.submitTransaction();
      },
      error: (err) => {
        this.categoryErrors.name = [''];
        if (err.error && err.error.errors) {
          this.categoryErrors.name = err.error.errors['name'];
        }
      }
    });
  } else if (this.isNewCategory == null) {
    this.transaction.category_id = null;
    this.submitTransaction();
  } else {
    this.transaction.category_id = this.selectedCategory;
    this.submitTransaction();
  }
}
```

- **Descrição**: Edita a transação após verificar se o usuário deseja criar uma nova categoria.
- **Ações**:
  - Se `isNewCategory` for `true` e `newCategoryName` tiver um valor, adiciona uma nova categoria e associa à transação.
  - Se `isNewCategory` for `null`, define `category_id` como `null`.
  - Caso contrário, associa a transação a uma `selectedCategory` existente.
  - Em caso de erro, `categoryErrors.name` é atualizado com as mensagens de erro específicas.

---

##### `cancel()`

```typescript
cancel(): void {
  this.router.navigate(['../']);
}
```

- **Descrição**: Cancela a operação de edição e redireciona para a página anterior.

---

##### `submitTransaction()`

```typescript
private submitTransaction(): void {
  this.transactionsService.editTransaction(this.transaction.id, this.transaction).subscribe({
    next: () => {
      this.router.navigate(['/transactions']);
    },
    error: (err) => {
      this.errorMessages = {
        description: [],
        type: [],
        amount: [],
        category_id: [],
        date: []
      };

      if (err.error && err.error.errors) {
        for (const field in err.error.errors) {
          if (this.errorMessages.hasOwnProperty(field)) {
            this.errorMessages[field] = err.error.errors[field];
          }
        }
      }
    }
  });
}
```

- **Descrição**: Envia os dados da transação editada para a API. Em caso de sucesso, redireciona para a lista de transações; em caso de erro, atualiza `errorMessages` com mensagens de erro específicas.

---

##### `onTypeChange()`

```typescript
onTypeChange(): void {
  if (this.transaction.type === 'expense') {
    this.transaction.amount = -Math.abs(this.transaction.amount);
  } else if (this.transaction.type === 'income') {
    this.transaction.amount = Math.abs(this.transaction.amount);
  }
}
```

- **Descrição**: Ajusta o valor de `amount` conforme o `type` da transação (`expense` para valores negativos e `income` para positivos).

---

##### `onCategoryChange()`

```typescript
onCategoryChange(): void {
  this.categoryErrors.name = [];
  if (!this.isNewCategory && this.transaction && this.transaction.category_id) {
    this.selectedCategory = this.transaction.category_id;
  } else {
    this.selectedCategory = null;
    this.newCategoryName = '';
  }
}
```

- **Descrição**: Reseta as variáveis de categoria, permitindo que o usuário insira uma nova categoria se necessário.

---

##### `fetchCategories()`

```typescript
fetchCategories() {
  this.categoriesService.getCategories().subscribe({
    next: (data) => {
      this.categories = data;
      if (this.transaction && this.transaction.category_id) {
        this.selectedCategory = this.transaction.category_id;
      }
    }
  });
}
```

- **Descrição**: Carrega a lista de categorias disponíveis usando `CategoryService`. Se a transação tiver uma `category_id` associada, `selectedCategory` é definida com esse valor.

<br>

---

<br>

### `TransactionEditComponent`

O `TransactionEditComponent` é responsável por exibir o formulário de edição de uma transação, permitindo que o usuário visualize e modifique os detalhes da transação existente. Além disso, o componente oferece a opção de associar a transação a uma categoria já existente ou adicionar uma nova categoria. 

---

#### Importações Necessárias

```typescript
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';
```

- **Component**: Define o decorator `@Component`, especificando metadados do componente.
- **OnInit**: Interface para implementar o método `ngOnInit`.
- **ActivatedRoute**: Para acessar o parâmetro de rota, que contém o ID da transação a ser editada.
- **Router**: Para navegação entre rotas.
- **TransactionsService**: Serviço responsável por operações de CRUD de transações.
- **CategoryService**: Serviço para gerenciar categorias de transações, permitindo buscar e adicionar novas categorias.

---

#### Propriedades

##### Transação

- `transaction: Transaction`: Objeto que armazena os dados da transação a ser editada.
  - **Atributos**:
    - `id`: ID da transação.
    - `description`: Descrição da transação.
    - `category_id`: ID da categoria associada, pode ser `0`, `null` ou um valor numérico.
    - `amount`: Valor da transação.
    - `type`: Tipo de transação (`income` ou `expense`).
    - `date`: Data da transação.

##### Estado de Categoria

- `categoryCreated: number | null`: ID da categoria criada recentemente, caso o usuário opte por adicionar uma nova categoria.
- `isNewCategory: boolean`: Flag para verificar se o usuário deseja criar uma nova categoria.
- `newCategoryName: string`: Nome da nova categoria, caso o usuário opte por criar uma.
- `selectedCategory: number | null`: ID da categoria selecionada no formulário.

##### Listagem de Categorias

- `categories: Category[]`: Lista de categorias disponíveis, carregadas do serviço `CategoryService`.

##### Mensagens de Erro

- `errorMessages: { [key: string]: string[] }`: Objeto que armazena mensagens de erro para campos específicos do formulário.
- `categoryErrors: { name: string[] }`: Mensagens de erro específicas para o campo `name` ao adicionar uma nova categoria.

---

#### Construtor

```typescript
constructor(
  private transactionsService: TransactionsService,
  private route: ActivatedRoute,
  private router: Router,
  private categoriesService: CategoryService
) {}
```

- **transactionsService**: Serviço para operações de transações.
- **route**: Propriedade `ActivatedRoute` usada para acessar o parâmetro `id` da rota.
- **router**: Roteador para navegação.
- **categoriesService**: Serviço para operações de categorias.

---

#### Metodos

##### `ngOnInit()`

```typescript
ngOnInit(): void {
  this.show();
  this.fetchCategories();
}
```

- **Descrição**: Inicializa o componente, carregando os dados da transação e as categorias disponíveis.
- **Chama**:
  - `show()`: Carrega os dados da transação atual, com base no ID passado pela rota.
  - `fetchCategories()`: Obtém a lista de categorias disponíveis.

---

##### `show()`

```typescript
show(): void {
  const idString = this.route.snapshot.paramMap.get('id');
  const id = idString ? parseInt(idString, 10) : null;

  if (id) {
    this.fetchTransaction(id);
  }
}
```

- **Descrição**: Obtém o ID da transação a partir da rota e carrega os detalhes da transação correspondente.
- **Ações**:
  - Converte o ID de `string` para `number` e chama `fetchTransaction(id)` para buscar a transação.

---

##### `fetchTransaction(id: number)`

```typescript
fetchTransaction(id: number): void {
  this.transactionsService.getTransactionById(id).subscribe(
    data => {
      this.transaction = data;
    }
  );
}
```

- **Descrição**: Carrega os dados da transação específica, com base no ID fornecido.
- **Parâmetro**:
  - `id`: ID da transação a ser editada.
- **Assinatura**: Subscreve-se ao método `getTransactionById` do `transactionsService` para obter a transação e armazená-la em `transaction`.

---

##### `editTransaction()`

```typescript
editTransaction(): void {
  this.categoryErrors.name = [];

  if (this.isNewCategory && this.newCategoryName) {
    this.categoriesService.addCategory(this.newCategoryName).subscribe({
      next: (response) => {
        this.transaction.category_id = response.category.id;
        this.submitTransaction();
      },
      error: (err) => {
        this.categoryErrors.name = [''];
        if (err.error && err.error.errors) {
          this.categoryErrors.name = err.error.errors['name'];
        }
      }
    });
  } else if (this.isNewCategory == null) {
    this.transaction.category_id = null;
    this.submitTransaction();
  } else {
    this.transaction.category_id = this.selectedCategory;
    this.submitTransaction();
  }
}
```

- **Descrição**: Edita a transação após verificar se o usuário deseja criar uma nova categoria.
- **Ações**:
  - Se `isNewCategory` for `true` e `newCategoryName` tiver um valor, adiciona uma nova categoria e associa à transação.
  - Se `isNewCategory` for `null`, define `category_id` como `null`.
  - Caso contrário, associa a transação a uma `selectedCategory` existente.
  - Em caso de erro, `categoryErrors.name` é atualizado com as mensagens de erro específicas.

---

##### `cancel()`

```typescript
cancel(): void {
  this.router.navigate(['../']);
}
```

- **Descrição**: Cancela a operação de edição e redireciona para a página anterior.

---

##### `submitTransaction()`

```typescript
private submitTransaction(): void {
  this.transactionsService.editTransaction(this.transaction.id, this.transaction).subscribe({
    next: () => {
      this.router.navigate(['/transactions']);
    },
    error: (err) => {
      this.errorMessages = {
        description: [],
        type: [],
        amount: [],
        category_id: [],
        date: []
      };

      if (err.error && err.error.errors) {
        for (const field in err.error.errors) {
          if (this.errorMessages.hasOwnProperty(field)) {
            this.errorMessages[field] = err.error.errors[field];
          }
        }
      }
    }
  });
}
```

- **Descrição**: Envia os dados da transação editada para a API. Em caso de sucesso, redireciona para a lista de transações; em caso de erro, atualiza `errorMessages` com mensagens de erro específicas.

---

##### `onTypeChange()`

```typescript
onTypeChange(): void {
  if (this.transaction.type === 'expense') {
    this.transaction.amount = -Math.abs(this.transaction.amount);
  } else if (this.transaction.type === 'income') {
    this.transaction.amount = Math.abs(this.transaction.amount);
  }
}
```

- **Descrição**: Ajusta o valor de `amount` conforme o `type` da transação (`expense` para valores negativos e `income` para positivos).

---

##### `onCategoryChange()`

```typescript
onCategoryChange(): void {
  this.categoryErrors.name = [];
  if (!this.isNewCategory && this.transaction && this.transaction.category_id) {
    this.selectedCategory = this.transaction.category_id;
  } else {
    this.selectedCategory = null;
    this.newCategoryName = '';
  }
}
```

- **Descrição**: Reseta as variáveis de categoria, permitindo que o usuário insira uma nova categoria se necessário.

---

##### `fetchCategories()`

```typescript
fetchCategories() {
  this.categoriesService.getCategories().subscribe({
    next: (data) => {
      this.categories = data;
      if (this.transaction && this.transaction.category_id) {
        this.selectedCategory = this.transaction.category_id;
      }
    }
  });
}
```

- **Descrição**: Carrega a lista de categorias disponíveis usando `CategoryService`. Se a transação tiver uma `category_id` associada, `selectedCategory` é definida com esse valor.

<br>

---

<br>

### `TransactionDetailsComponent`

O `TransactionDetailsComponent` é um componente Angular que exibe os detalhes de uma transação específica, incluindo sua categoria associada e tipo (receita ou despesa). Ele também permite que o usuário edite ou exclua a transação atual.

---

#### Importações Necessárias

```typescript
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';
```

- **Component**: Define o decorator `@Component`, que especifica os metadados do componente.
- **OnInit**: Interface para implementar o método `ngOnInit`, que será executado ao inicializar o componente.
- **ActivatedRoute**: Permite acesso ao parâmetro de rota (`id`), utilizado para buscar os detalhes da transação.
- **Router**: Fornece navegação entre rotas, utilizado para redirecionar o usuário.
- **TransactionsService**: Serviço responsável por operações de CRUD nas transações.
- **CategoryService**: Serviço responsável por gerenciar categorias.

---

#### Propriedades

##### Transação

- `transaction: Transaction`: Armazena os dados da transação a ser exibida.
  - **Atributos**:
    - `id`: ID da transação.
    - `description`: Descrição da transação.
    - `category_id`: ID da categoria associada à transação.
    - `amount`: Valor da transação.
    - `type`: Tipo da transação (`income` ou `expense`).
    - `date`: Data da transação.

##### Categoria

- `category: Category`: Armazena os dados da categoria associada à transação.
  - **Atributos**:
    - `id`: ID da categoria.
    - `name`: Nome da categoria.

##### Tipo da Transação

- `type: string`: Representação textual do tipo de transação para exibição ao usuário (`Despesa` para `expense` e `Receita` para `income`).

---

#### Construtor

```typescript
constructor(
  private route: ActivatedRoute,
  private transactionsService: TransactionsService,
  private categoryService: CategoryService,
  private router: Router
) {}
```

- **route**: Propriedade `ActivatedRoute` usada para acessar o parâmetro `id` da rota.
- **transactionsService**: Serviço para operações de transações, como busca, edição e exclusão.
- **categoryService**: Serviço para operações de categorias, utilizado para buscar informações da categoria associada à transação.
- **router**: Propriedade para navegação entre rotas.

---

#### Metodos

##### `ngOnInit()`

```typescript
ngOnInit(): void {
  this.show();
}
```

- **Descrição**: Método chamado automaticamente ao inicializar o componente.
- **Ações**:
  - Chama o método `show()` para carregar a transação com base no ID da rota atual.

---

##### `show()`

```typescript
show(): void {
  const idString = this.route.snapshot.paramMap.get('id');
  const id = idString ? parseInt(idString, 10) : null;

  if (id) {
    this.fetchTransaction(id);
  }
}
```

- **Descrição**: Obtém o ID da transação a partir da rota e chama o método `fetchTransaction` para carregar os detalhes da transação.
- **Ações**:
  - Converte o ID de `string` para `number` e chama `fetchTransaction(id)` para buscar a transação correspondente.

---

##### `fetchTransaction(id: number)`

```typescript
fetchTransaction(id: number): void {
  this.transactionsService.getTransactionById(id).subscribe(
    data => {
      this.transaction = data;
      this.showCategory();
    }
  );
}
```

- **Descrição**: Carrega os detalhes da transação com base no ID fornecido.
- **Parâmetro**:
  - `id`: ID da transação a ser exibida.
- **Ações**:
  - Subscreve-se ao método `getTransactionById` do `transactionsService` para obter a transação e armazená-la na propriedade `transaction`.
  - Chama `showCategory()` para carregar a categoria associada à transação.

---

##### `translateType()`

```typescript
translateType(): string {
  if (this.transaction.type === 'expense') {
    this.type = 'Despesa';
    return this.type;
  } else if (this.transaction.type === 'income') {
    this.type = 'Receita';
    return this.type;
  } else {
    return '';
  }
}
```

- **Descrição**: Traduz o tipo da transação para um termo legível para o usuário.
- **Retorno**: Retorna `Despesa` para transações do tipo `expense` e `Receita` para `income`. Retorna uma string vazia se o tipo não for reconhecido.

---

##### `showCategory()`

```typescript
showCategory(): void {
  const id = this.transaction.category_id;

  if (id){
    this.fetchCategory(id);
  }
}
```

- **Descrição**: Obtém o ID da categoria associada à transação e chama `fetchCategory` para buscar os detalhes da categoria.

---

##### `cancel()`

```typescript
cancel(): void {
  this.router.navigate(['../']);
}
```

- **Descrição**: Cancela a visualização dos detalhes e retorna à página anterior.

---

##### `editTransaction(id: number)`

```typescript
editTransaction(id: number): void {
  this.router.navigate(['/transaction/:id', id]);
}
```

- **Descrição**: Redireciona o usuário para a página de edição da transação atual.
- **Parâmetro**:
  - `id`: ID da transação a ser editada.

---

##### `deleteTransaction(id: number)`

```typescript
deleteTransaction(id: number): void {
  if (confirm('Tem certeza de que deseja deletar esta transação?')) {
    this.transactionsService.deleteTransaction(id).subscribe(
      () => {
        alert('Transação deletada com sucesso!');
        this.router.navigate(['/transactions']);
      },
      error => {
        console.error('Erro ao deletar transação:', error);
        alert('Não foi possível deletar a transação.');
      }
    );
  }
}
```

- **Descrição**: Exclui a transação após confirmar a ação com o usuário.
- **Parâmetro**:
  - `id`: ID da transação a ser deletada.
- **Ações**:
  - Solicita confirmação ao usuário. Em caso de confirmação, chama `deleteTransaction` do `transactionsService` para excluir a transação.
  - Redireciona o usuário para a página de listagem após a exclusão bem-sucedida.
  - Exibe uma mensagem de erro caso a exclusão falhe.

---

##### `fetchCategory(id: number)`

```typescript
fetchCategory(id: number): void {
  this.categoryService.getCategoryById(id).subscribe(
    data => {
      this.category = data;
      console.log(this.category);
    }
  );
}
```

- **Descrição**: Carrega os detalhes da categoria associada à transação.
- **Parâmetro**:
  - `id`: ID da categoria.
- **Ações**:
  - Subscreve-se ao método `getCategoryById` do `categoryService` para obter os dados da categoria e armazená-los em `category`.

<br>

---

<br>


---

## Services 

### `TransactionsService`

#### Descrição

O `TransactionsService` é um serviço que fornece métodos para interagir com os endpoints de transação. Ele permite realizar operações como listar, adicionar, editar, deletar e buscar detalhes de transações. O serviço utiliza o `HttpClient` para fazer requisições HTTP ao servidor da API.

<br>

#### Importações

```typescript
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
```

- **Injectable**: Um decorador que marca a classe como um serviço que pode ser injetado em outros componentes ou serviços.
- **HttpClient**: Um serviço do Angular para realizar requisições HTTP.
- **Observable**: Um tipo de objeto que permite trabalhar com dados assíncronos.

<br>

--- 

<br>

#### Interfaces

##### `Transaction`

```typescript
export interface Transaction {
  id: number;
  description: string;
  category_id: number | null;
  amount: number;
  type: string;
  date: string;
}
```

Esta interface define a estrutura de um objeto de transação. Os campos são:

- **id**: Identificador único da transação (número).
- **description**: Descrição da transação (string).
- **category_id**: ID da categoria associada (número ou nulo).
- **amount**: Valor da transação (número).
- **type**: Tipo da transação (string), podendo ser "expense" (despesa) ou "income" (receita).
- **date**: Data da transação (string).

<br>


##### `PaginatedResponse`

```typescript
export interface PaginatedResponse {
  current_page: number;
  data: Transaction[];
  last_page: number;
  total: number;
}
```

Esta interface define a estrutura de uma resposta paginada recebida da API. Os campos são:

- **current_page**: Número da página atual (número).
- **data**: Array de transações (`Transaction[]`).
- **last_page**: Número da última página disponível (número).
- **total**: Total de transações disponíveis (número).


--- 


#### Decorador

##### `@Injectable({ providedIn: 'root' })`

- O serviço é fornecido na raiz da aplicação, tornando-o disponível em toda a aplicação sem a necessidade de importar explicitamente em cada módulo.

--- 

#### Propriedades

##### `private apiUrl: string`

- **Descrição**: URL base da API onde as requisições serão enviadas.
- **Valor**: `http://127.0.0.1:8000/api`



#### Construtor

```typescript
constructor(private http: HttpClient) {}
```


- **Parâmetros**:
  - `http`: Uma instância do `HttpClient` que será utilizada para realizar as requisições HTTP.

---

#### Metodos

##### `getTransactions(page: number, filters?: any): Observable<PaginatedResponse>`


- **Descrição**: Obtém uma lista de transações com suporte à paginação e filtragem.
- **Parâmetros**:
  - `page`: O número da página a ser recuperada (número).
  - `filters`: Filtros opcionais a serem aplicados na busca (objeto).
- **Retorno**: Um `Observable` que emitirá um objeto do tipo `PaginatedResponse`.

<br>


##### `addTransaction(transaction: Transaction): Observable<Transaction>`

- **Descrição**: Adiciona uma nova transação ao sistema.
- **Parâmetros**:
  - `transaction`: Um objeto do tipo `Transaction` que contém os dados da nova transação.
- **Retorno**: Um `Observable` que emitirá a transação criada.

<br>

##### `getTransactionById(id: number): Observable<Transaction>`

- **Descrição**: Obtém uma transação específica pelo seu ID.
- **Parâmetros**:
  - `id`: O ID da transação a ser recuperada (número).
- **Retorno**: Um `Observable` que emitirá a transação correspondente.

<br>

##### `deleteTransaction(id: number): Observable<Transaction>`

- **Descrição**: Deleta uma transação do sistema.
- **Parâmetros**:
  - `id`: O ID da transação a ser deletada (número).
- **Retorno**: Um `Observable` que emitirá a transação deletada.

<br>

##### `editTransaction(id: number, transaction: Transaction): Observable<Transaction>`

- **Descrição**: Edita uma transação existente.
- **Parâmetros**:
  - `id`: O ID da transação a ser editada (número).
  - `transaction`: Um objeto do tipo `Transaction` com os dados atualizados.
- **Retorno**: Um `Observable` que emitirá a transação atualizada.
- 
<br>

---

<br>

### `CategoryService`

#### Descrição

O `CategoryService` é um serviço Angular que fornece métodos para interagir com a API de categorias. Ele permite realizar operações como listar, adicionar e buscar detalhes de categorias. O serviço utiliza o `HttpClient` para fazer requisições HTTP ao servidor da API.

#### Importações

```typescript
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
```

- **Injectable**: Um decorador que marca a classe como um serviço que pode ser injetado em outros componentes ou serviços.
- **HttpClient**: Um serviço do Angular para realizar requisições HTTP.
- **Observable**: Um tipo de objeto que permite trabalhar com dados assíncronos.

---

#### Interfaces

##### `Category`

```typescript
export interface Category {
  id: number;
  name: string;
}
```

Esta interface define a estrutura de um objeto de categoria. Os campos são:

- **id**: Identificador único da categoria (número).
- **name**: Nome da categoria (string).

---

#### Decorador

##### `@Injectable({ providedIn: 'root' })`

- O serviço é fornecido na raiz da aplicação, tornando-o disponível em toda a aplicação sem a necessidade de importar explicitamente em cada módulo.

---

#### Propriedades

##### `private apiUrl: string`

- **Descrição**: URL base da API onde as requisições serão enviadas.
- **Valor**: `http://127.0.0.1:8000/api`

#### Construtor

```typescript
constructor(private http: HttpClient) { }
```

- **Parâmetros**:
  - `http`: Uma instância do `HttpClient` que será utilizada para realizar as requisições HTTP.

---

#### Métodos

<br>

##### `getCategories(): Observable<Category[]>`

- **Descrição**: Obtém uma lista de todas as categorias disponíveis.
- **Retorno**: Um `Observable` que emitirá um array de objetos do tipo `Category`.

<br>

##### `addCategory(name: string): Observable<{ category: Category; message: string }>` 

- **Descrição**: Adiciona uma nova categoria ao sistema.
- **Parâmetros**:
  - `name`: O nome da nova categoria a ser adicionada (string).
- **Retorno**: Um `Observable` que emitirá um objeto contendo a categoria criada e uma mensagem de confirmação:
  - **category**: Um objeto do tipo `Category` que contém os dados da nova categoria.
  - **message**: Uma mensagem de confirmação (string) informando sobre o sucesso da operação.

<br>

##### `getCategoryById(id: number): Observable<Category>`

- **Descrição**: Obtém uma categoria específica pelo seu ID.
- **Parâmetros**:
  - `id`: O ID da categoria a ser recuperada (número).
- **Retorno**: Um `Observable` que emitirá a categoria correspondente ao ID fornecido.

---
=======
>>>>>>> b66e6a49c0f1d8b6fd020a10a6bb4439cce99531
