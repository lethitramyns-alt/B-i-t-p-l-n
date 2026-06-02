<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo tài khoản admin
        User::create([
            'name'     => 'Quản Trị Viên',
            'email'    => 'admin@tourism.vn',
            'password' => Hash::make('admin123456'),
            'role'     => 'admin',
        ]);

        // Tạo tài khoản user mẫu
        User::create([
            'name'     => 'Nguyễn Văn An',
            'email'    => 'user@tourism.vn',
            'password' => Hash::make('user123456'),
            'role'     => 'user',
        ]);

        User::create([
            'name'     => 'Trần Thị Bình',
            'email'    => 'binh@tourism.vn',
            'password' => Hash::make('user123456'),
            'role'     => 'user',
        ]);
    }
}
