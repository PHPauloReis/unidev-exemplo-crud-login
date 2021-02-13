<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDefaultUser();
        User::factory(10)->create();
    }

    private function createDefaultUser()
    {
        $defaultUser = new User();
        $defaultUser->name = 'Usuário Padrão';
        $defaultUser->email = 'admin@admin.com.br';
        $defaultUser->password = Hash::make('12345678');
        $defaultUser->email_verified_at = now();
        $defaultUser->remember_token = "97gibxEa1k";
        $defaultUser->save();
    }
}
