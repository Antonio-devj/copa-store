<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Só cria o CPF se ele ainda não existir no banco
            if (!Schema::hasColumn('users', 'cpf')) {
                $table->string('cpf')->nullable()->unique()->after('email');
            }
            
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('cpf');
            }
            
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable()->after('phone');
            }
            
            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state')->nullable()->after('city');
            }
            
            if (!Schema::hasColumn('users', 'seller_status')) {
                $table->string('seller_status')->nullable()->after('role'); 
            }
            
            if (!Schema::hasColumn('users', 'commission_percentage')) {
                $table->decimal('commission_percentage', 5, 2)->default(0.00)->after('state');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cpf', 'phone', 'city', 'state', 'seller_status', 'commission_percentage']);
        });
    }
};