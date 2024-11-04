# Criação de Tabelas no Banco de Dados

Este documento fornece instruções sobre como criar as tabelas `transactions` e `categories` no banco de dados.

## Pré-requisitos

Antes de executar os scripts, certifique-se de que você tenha:

- Um servidor de banco de dados SQL em funcionamento.
- Permissões necessárias para criar tabelas no banco de dados.

## Passos para Criar as Tabelas

### 1. Conectar ao Banco de Dados
Insira suas credenciais de acesso e selecione o banco de dados onde você deseja criar as tabelas.

### 2. Criar a Tabela `categories`

Execute o seguinte script SQL para criar a tabela `categories`:

```sql
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### 3. Criar a Tabela `transactions`

Em seguida, execute o seguinte script SQL para criar a tabela `transactions`:

```sql
CREATE TABLE transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    category_id BIGINT UNSIGNED NULL,
    amount DECIMAL(10, 2) NOT NULL,
    type ENUM('income', 'expense') NOT NULL,
    date DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);
```

### 4. Verificar as Tabelas Criadas

Após executar os scripts, verifique se as tabelas foram criadas corretamente. Você pode fazer isso executando as seguintes consultas:

```sql
SHOW TABLES;
```

E para descrever a estrutura das tabelas:

```sql
DESCRIBE categories;
DESCRIBE transactions;
```
