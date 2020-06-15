<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Admin;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsSeeder::class);
    }
}
class UsersSeeder extends Seeder{

    public function run()
    {
        DB::table('users')->insert(
            [
                'tenTaiKhoan'=>'user',
                'password'=>bcrypt('user'),
                'email'=>'khongnhoemail33@gmail.com',
                'ID_DocGia'=>'1',
            ]
        );
    }
}

class AdminsSeeder extends Seeder{

    public function run()
    {  
        $admin = new Admin();
        $admin->tenTaiKhoan = 'admin';
        $admin->email = 'khongnhoemail33@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->save();
      
    }
}