<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersTableSeeder extends Seeder
{
    const DEFAULT_USER = [
        'name' => 'John Doe',
        'email' => 'john@mail.com',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(self::DEFAULT_USER);
        factory(User::class, 4)->create();
    }
}
