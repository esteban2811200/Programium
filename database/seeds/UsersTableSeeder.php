<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//este seeder crea 3 usuarios con 3 roles diferentes
    	User::truncate();
    	$pass = bcrypt("12345678");
    	$accesos = array('administrador', 'profesor', 'alumno');
    	for ($i=0; $i < 3; $i++) {
    	$rand = array_rand($accesos, 3);
        User::create([
        'name' => $accesos[$rand[$i]],
        'email' => $accesos[$rand[$i]]."@gmail.com",
        'password' => $pass,
        'role' => $accesos[$rand[$i]]]);
		}
    }
}
