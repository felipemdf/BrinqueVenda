<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Brinquedo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        if (!$admin) {
            
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
            ]);

            $this->command->info('Usuário admin criado com sucesso!');
        } else {
            $this->command->info('Usuário admin já existe.');
        }

        Brinquedo::factory()->count(4)->create([
            'usuario_id' => $admin->id,
        ]);
    }
}
