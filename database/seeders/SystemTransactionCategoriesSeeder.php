<?php

namespace Database\Seeders;

use App\Enums\MovementType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemTransactionCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionCategories = [
            [
                'name' => 'Transacción interna - Ingreso',
                'description' => 'Transacción que no afecta el balance de la cuenta, sirve para registrar movimientos internos.',
                'type' => MovementType::IN,
                'is_protected' => true,
            ],
            [
                'name' => 'Transacción interna - Egreso',
                'description' => 'Transacción que no afecta el balance de la cuenta, sirve para registrar movimientos internos.',
                'type' => MovementType::OUT,
                'is_protected' => true,
            ],
            [
                'name' => 'Contribución de un Miembro',
                'description' => 'Contribución de un miembro a SAPERE AUDE.',
                'type' => MovementType::IN,
                'is_protected' => true,
            ],
            [
                'name' => 'Pago a un Autor',
                'description' => 'Pago realizado a un autor por sus contribuciones.',
                'type' => MovementType::OUT,
                'is_protected' => true,
            ],
        ];
        DB::table('transaction_categories')->insert(
            array_map(function ($category) {
                return array_merge($category, [
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }, $transactionCategories)
        );
    }
}
