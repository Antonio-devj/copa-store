<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Criar Usuários de Teste
        User::create([
            'name' => 'Vendedor Admin',
            'email' => 'admin@copa.com',
            'password' => Hash::make('senha123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Cliente Teste',
            'email' => 'cliente@copa.com',
            'password' => Hash::make('senha123'),
            'role' => 'client',
        ]);

        // 2. Criar o País: Brasil e seus produtos
        $brasil = Country::create([
            'name' => 'Brasil',
            'history' => 'A única seleção a participar de todas as edições da Copa do Mundo e a maior vencedora do torneio.',
            'journey' => 'O Brasil chega forte buscando manter sua hegemonia no futebol mundial com um elenco renovado.',
            'titles_count' => 5,
            'flag_image' => 'flags/brasil.png'
        ]);

        Product::create([
            'country_id' => $brasil->id,
            'name' => 'Camisa Oficial Seleção Brasileira 2026',
            'description' => 'Camisa amarela canarinho com tecnologia de alta absorção.',
            'price' => 349.90,
            'stock' => 50,
            'image' => 'products/camisa_br.png'
        ]);

        // 3. Criar o País: França e seus produtos
        $franca = Country::create([
            'name' => 'França',
            'history' => 'Uma das grandes potências do futebol europeu, vencedora das Copas de 1998 e 2018.',
            'journey' => 'Com um ataque avassalador, a França chega como uma das favoritas ao título.',
            'titles_count' => 2,
            'flag_image' => 'flags/franca.png'
        ]);

        Product::create([
            'country_id' => $franca->id,
            'name' => 'Casaco Corta-Vento França',
            'description' => 'Casaco estiloso na cor azul escura com o escudo da federação francesa.',
            'price' => 449.90,
            'stock' => 20,
            'image' => 'products/casaco_fr.png'
        ]);

        // 4. Criar o País: Argentina e seus produtos
        $argentina = Country::create([
            'name' => 'Argentina',
            'history' => 'Atual defensora do título mundial, a terra de Maradona e Messi possui uma história rica em Copas.',
            'journey' => 'A Alviceleste tenta defender sua coroa com um futebol coletivo muito agressivo.',
            'titles_count' => 3,
            'flag_image' => 'flags/argentina.png'
        ]);

        Product::create([
            'country_id' => $argentina->id,
            'name' => 'Camisa Listrada Argentina',
            'description' => 'A clássica camisa oficial azul celeste e branca.',
            'price' => 349.90,
            'stock' => 35,
            'image' => 'products/camisa_arg.png'
        ]);
    }
}