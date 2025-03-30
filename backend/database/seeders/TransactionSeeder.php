<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        DB::table('transactions')->truncate(); // Limpa a tabela antes de inserir novos dados

        Transaction::insert([
            [
                'description' => 'Salário Mensal',
                'category_id' => 1,
                'amount' => 5000.00,
                'type' => 'income',
                'date' => now()->subDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Conta de Luz',
                'category_id' => 2,
                'amount' => 150.75,
                'type' => 'expense',
                'date' => now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Almoço no Restaurante',
                'category_id' => 3,
                'amount' => 50.00,
                'type' => 'expense',
                'date' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Venda de Produto A',
                'category_id' => 1,
                'amount' => 1200.00,
                'type' => 'income',
                'date' => now()->subDays(12),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Compra de Material de Escritório',
                'category_id' => 4,
                'amount' => 200.00,
                'type' => 'expense',
                'date' => now()->subDays(8),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Pagamento de Internet',
                'category_id' => 2,
                'amount' => 120.00,
                'type' => 'expense',
                'date' => now()->subDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Consultoria Freelance',
                'category_id' => 1,
                'amount' => 1500.00,
                'type' => 'income',
                'date' => now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Assinatura de Software',
                'category_id' => 5,
                'amount' => 99.99,
                'type' => 'expense',
                'date' => now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Venda de Produto B',
                'category_id' => 1,
                'amount' => 800.00,
                'type' => 'income',
                'date' => now()->subDays(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Aluguel Escritório',
                'category_id' => 2,
                'amount' => 1500.00,
                'type' => 'expense',
                'date' => now()->subDays(9),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Despesas Médicas',
                'category_id' => 6,
                'amount' => 250.00,
                'type' => 'expense',
                'date' => now()->subDays(4),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Venda de Produto C',
                'category_id' => 1,
                'amount' => 500.00,
                'type' => 'income',
                'date' => now()->subDays(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Compra de Equipamento de Informática',
                'category_id' => 7,
                'amount' => 800.00,
                'type' => 'expense',
                'date' => now()->subDays(11),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Venda de Serviços de Consultoria',
                'category_id' => 1,
                'amount' => 3000.00,
                'type' => 'income',
                'date' => now()->subDays(13),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
