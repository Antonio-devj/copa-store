<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar o Usuário Administrador (Vendedor)
        User::create([
            'name' => 'Vendedor Copa Store',
            'email' => 'admin@copa.com',
            'password' => Hash::make('senha123'),
            'role' => 'admin',
        ]);

        // 2. Criar os Países com suas Histórias e Jornadas para 2026
        $brasil = Country::create([
            'name' => 'Brasil',
            'titles_count' => 5,
            'history' => 'A única seleção pentacampeã mundial. Conhecida historicamente pelo futebol arte, revelou ao mundo o Rei Pelé e ostenta uma tradição inigualável na história das Copas desde a primeira edição em 1930.',
            'journey' => 'Liderando as eliminatórias sul-americanas com foco total na renovação tática sob o comando de uma nova geração de craques rápidos e sedentos pelo Hexa em 2026.'
        ]);

        $franca = Country::create([
            'name' => 'França',
            'titles_count' => 2,
            'history' => 'Bicampeã mundial (1998 e 2018). Tornou-se a grande referência de futebol moderno, velocidade e força coletiva na Europa, marcando as últimas décadas com elencos fisicamente dominantes.',
            'journey' => 'Classificada com soberania absoluta na Europa, a equipe chega como uma das favoritas ao título, misturando a experiência de astros mundiais com jovens talentos letais.'
        ]);

        $argentina = Country::create([
            'name' => 'Argentina',
            'titles_count' => 3,
            'history' => 'Tricampeã mundial. Uma história rica moldada pela paixão extrema de sua torcida, que imortalizou a lenda Diego Maradona e recentemente coroou Lionel Messi no topo do mundo no Catar.',
            'journey' => 'Mantendo a sólida base campeã mundial e adicionando novas peças de elite para defender o título com a tradicional garra e posse de bola cerebral.'
        ]);


        // 3. Criar os Produtos Iniciais (Separados por Roupas e Calçados)
        
        // --- PRODUTOS DO BRASIL ---
        Product::create([
            'country_id' => $brasil->id,
            'category' => 'roupa',
            'name' => 'Camisa Oficial Brasil Home 2026',
            'description' => 'O clássico manto amarelo canarinho projetado com tecido respirável de alta performance e caimento atlético de alfaiataria esportiva.',
            'price' => 349.99,
            'stock' => 50,
            'image' => null
        ]);

        Product::create([
            'country_id' => $brasil->id,
            'category' => 'calcado',
            'name' => 'Chuteira Mercurial Vapor Brasil Gold',
            'description' => 'Desenvolvida para velocidade explosiva e controle milimétrico nos gramados, personalizada com as cores exclusivas da seleção canarinho.',
            'price' => 1199.99,
            'stock' => 15,
            'image' => null
        ]);

        // --- PRODUTOS DA FRANÇA ---
        Product::create([
            'country_id' => $franca->id,
            'category' => 'roupa',
            'name' => 'Blusão de Treino França Therma-FIT',
            'description' => 'Casaco térmico oficial de treino utilizado pela comissão e atletas, garantindo isolamento térmico premium e conforto minimalista.',
            'price' => 489.99,
            'stock' => 25,
            'image' => null
        ]);

        Product::create([
            'country_id' => $franca->id,
            'category' => 'calcado',
            'name' => 'Tênis Adidas Predator Street - France',
            'description' => 'Estética agressiva dos gramados adaptada para as ruas. Amortecimento responsivo de alta durabilidade e detalhes em azul royal.',
            'price' => 749.99,
            'stock' => 20,
            'image' => null
        ]);

        // --- PRODUTOS DA ARGENTINA ---
        Product::create([
            'country_id' => $argentina->id,
            'category' => 'roupa',
            'name' => 'Camisa Argentina Três Estrelas Oficial',
            'description' => 'Manto sagrado albiceleste ostentando o patch oficial de campeão do mundo da FIFA e as três estrelas douradas bordadas no peito.',
            'price' => 349.99,
            'stock' => 40,
            'image' => null
        ]);
        
        Product::create([
            'country_id' => $argentina->id,
            'category' => 'calcado',
            'name' => 'Chuteira F50 Elite Albiceleste FG',
            'description' => 'A engenharia de peso leve definitiva para dribles em alta velocidade. Placa de carbono projetada para aceleração linear imediata.',
            'price' => 1499.99,
            'stock' => 10,
            'image' => null
        ]);
    }
}