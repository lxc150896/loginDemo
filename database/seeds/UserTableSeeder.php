<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'phone' => '0123456789',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
                'avatar' => 'https://data2.m4v.me/files/upload/3701901461723070.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'User',
                'phone' => '0123456789',
                'email' => 'user@gmail.com',
                'password' => bcrypt('12345'),
                'avatar' => 'https://thuthuatnhanh.com/wp-content/uploads/2018/07/anh-avatar-dep.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Me',
                'phone' => '0123456789',
                'email' => 'me@gmail.com',
                'password' => bcrypt('12345'),
                'avatar' => 'https://i.pinimg.com/236x/d1/f6/50/d1f6509e9bc7e1bdb142e5b23f716587--kigurumi-pikachu-kawaii-crafts.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'You',
                'phone' => '0123456789',
                'email' => 'you@gmail.com',
                'password' => bcrypt('12345'),
                'avatar' => 'https://hinhanhdep.net/wp-content/uploads/2016/01/avatar-naruto.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'We',
                'phone' => '0123456789',
                'email' => 'we@gmail.com',
                'password' => bcrypt('12345'),
                'avatar' => 'https://devilsworkshop.org/files/2013/01/enlarged-facebook-profile-picture.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Aladin',
                'phone' => '0123456789',
                'email' => 'aladin@gmail.com',
                'password' => bcrypt('12345'),
                'avatar' => 'https://thuthuatnhanh.com/wp-content/uploads/2018/07/anh-avatar-dep.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Beola',
                'phone' => '0123456789',
                'email' => 'beola@gmail.com',
                'password' => bcrypt('12345'),
                'avatar' => 'https://i.pinimg.com/236x/d1/f6/50/d1f6509e9bc7e1bdb142e5b23f716587--kigurumi-pikachu-kawaii-crafts.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Mata',
                'phone' => '0123456789',
                'email' => 'mata@gmail.com',
                'password' => bcrypt('12345'),
                'avatar' => 'https://hinhanhdep.net/wp-content/uploads/2016/01/avatar-naruto.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
