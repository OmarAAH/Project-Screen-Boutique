<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Client;
use App\Models\Color;
use App\Models\Delivery;
use App\Models\Design;
use App\Models\Designer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Size;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        Designer::factory(50)->create();
        State::factory(50)->create();
        Color::factory(10)->create();
        Size::factory(10)->create();
        Type::factory(10)->create();
        City::factory(50)->create();
        Employee::factory(50)->create();
        User::factory(50)->create();
        Client::factory(20)->create();
        Design::factory(20)->create();
        Delivery::factory(10)->create();
        Product::factory(50)->create();
        Sale::factory(50)->create();
       
    }
}
