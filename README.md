
# Sumário

- [API](#api)

1. [🗄️ Tabelas do banco de dados](#tabelas-do-banco-de-dados)
   - [Transactions](#transactions)
   - [Categories](#categories)
3. [📍 Endpoints](#endpoints)
   - [Transações](#transações)
   - [Categorias](#categorias)
4. [🔄 Respostas e/ou Requisições](#respostas-eou-requisições)
   - [GET /transactions - Listar todas as transações](#get-transactions-index)
   - [GET /transactions/{transaction} - Exibir detalhes de uma transação](#get-transactions-show)
   - [POST /transactions - Adicionar uma nova transação](#post-transactions-store)
   - [PUT /transactions/{transaction} - Editar os dados de uma transação](#put-transactions-update)
   - [DELETE /transactions/{transactions} - Deletar uma transação](#delete-transactions-destroy)
   - [GET /trash-bin - Listar todos os contatos na lixeira](#get-trash-bin-index)
   - [GET /categories - Listar todas as categorias](#get-categories-index)
   - [GET /categories/{category} - Exibir detalhes de uma categoria](#get-categories-show)
   - [POST /categories - Adicionar uma nova categoria](#post-categories-store)
5. 🔧 [Services](#services)
   - [Classe: TransactionService](#classe-transactionservice)
       - [Métodos](#métodos)
         - [getTransactions](#gettransactionsrequest-request-lengthawarepaginator)
         - [createTransaction](#createtransactionarray-data-transaction)
         - [updateTransaction](#updatetransactiontransaction-transaction-array-data-transaction)
         - [adjustAmount](#adjustamountfloat-amount-string-type-float)


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

Front-end

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

<h1 id="api">API</h1>

<h1 id="tabelas-do-banco-de-dados">🗄️ Tabelas do banco de dados</h1>

<h3 id="transactions">Transactions</h3>

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

 <h3 id="categories">Categories </h3>

| Coluna     | Tipo      | Características                  |
|------------|-----------|----------------------------------|
| `id`       | `bigint`  | Chave primária, auto-incremento |
| `name`     | `string`  | Texto, único, não nulo          |
| `created_at` | `timestamp` | Registro de data/hora de criação |
| `updated_at` | `timestamp` | Registro de data/hora de atualização |


<br>

<h1 id="endpoints">📍 Endpoints</h1>


<h3 id="transações">Transações</h3>

| **Rota**                | **Descrição**                                            
|----------------------|-----------------------------------------------------|
| <kbd>GET /transactions</kbd>   | Retorna a listagem com todas as transações - [detalhes da resposta](#get-transactions-index)|
| <kbd>GET /transactions/{transaction}</kbd>     | Retorna os detalhes de uma transação específica - [detalhes da resposta](#get-transactions-show)|
| <kbd>POST /transactions</kbd>     | Adicionar uma nova transação - [detalhes da requisição/resposta](#post-transactions-store)|
| <kbd>PUT /transactions/{transaction}</kbd>     | Edição de uma transação existente - [detalhes da requisição/resposta](#put-transactions-update)|
| <kbd>DELETE /transactions/{transaction}</kbd>     | Exclusão de uma transação - [detalhes resposta](#delete-transactions-destroy)|

<br>

<h3 id="categorias">Categorias</h3>

| **Rota**                | **Descrição**                                            
|----------------------|-----------------------------------------------------|
| <kbd>GET /categories</kbd>   | Retorna a listagem com todas as categorias - [detalhes da resposta](#get-categories-index)|
| <kbd>GET /categories/{category}</kbd>     | Retorna os detalhes de uma categoria específica - [detalhes da resposta](#get-categories-show)|
| <kbd>POST /categories</kbd>     | Adicionar uma nova categoria - [detalhes da requisição/resposta](#post-categories-store)|

<br>

<h1 id="respostas-eou-requisições">🔄 Respostas e/ou Requisições</h1>


<br>

<h3 id="get-transactions-index">GET /transactions - Listar todas as transações</h3>

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

<h3 id="get-transactions-show">GET /transactions/{transaction} - Exibir detalhes de uma transação</h3>

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

<h3 id="post-transactions-store">POST /transactions - Adicionar uma nova transação</h3>

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

<h3 id="put-transactions-update">PUT /transactions/{transaction} - Editar os dados de uma transação</h3>

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

<h3 id="delete-transactions-destroy">DELETE /transactions/{transactions} - Deletar uma transação </h3>

**RESPOSTA**
```json
{
	"message": "Transação excluída com sucesso"
}
```

<br>

---

<br>

<h3 id="get-trash-bin-index">GET /trash-bin - Listar todos os contatos na lixeira</h3>

**RESPOSTA**
```json
{
    "status": true,
    "contacts": [
        {
            "id": 115,
            "name": "Alana Brito Duarte Neto",
            "phone": "21960326836",
            "email": "mia80@example.com",
            "profile_picture": null,
            "deleted_at": "2024-10-10T13:10:18.000000Z",
            "created_at": "2024-10-10T13:00:05.000000Z",
            "updated_at": "2024-10-10T13:10:18.000000Z"
        },
        {
            "id": 160,
            "name": "Alice Q. Rico Filho",
            "phone": "83983396829",
            "email": "rezende.nayara@example.org",
            "profile_picture": null,
            "deleted_at": "2024-10-23T18:23:01.000000Z",
            "created_at": "2024-10-10T13:00:05.000000Z",
            "updated_at": "2024-10-23T18:23:01.000000Z"
        },
        ...
    ]
}
```

<br>

---

<h3 id="get-categories-index">GET /categories - Listar todas as categorias</h3>

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

<h3 id="get-categories-show">GET /categories/{category} - Exibir detalhes de uma categoria</h3>

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

<h3 id="post-categories-store">POST /categories - Adicionar uma nova categoria</h3>

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


<h1 id="services">🔧 Services</h1>

<h1 id="classe-transactionservice" >Classe: TransactionService</h1>

<h3 id="descricao">Descrição: Classe responsável pela lógica de negócios das transações</h3>

<hr>

<h3 id="métodos" >Métodos:</h3>

## `getTransactions(Request $request): LengthAwarePaginator`

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

## `createTransaction(array $data): Transaction`

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

## `updateTransaction(Transaction $transaction, array $data): Transaction`

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

## `adjustAmount(float $amount, string $type): float`
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