<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Se o campo de código e saldo não existirem, eles serão criados aqui com segurança após o id
            if (!Schema::hasColumn('users', 'seller_code')) {
                $table->string('seller_code')->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('users', 'seller_balance')) {
                $table->decimal('seller_balance', 10, 2)->default(0.00)->after('seller_code');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['seller_code', 'seller_balance']);
        });
    }
};