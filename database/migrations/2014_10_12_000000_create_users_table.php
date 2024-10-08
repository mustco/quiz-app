<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('roles', ['admin', 'pengguna'])->default('pengguna');
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'roles' => 'admin',
            'password' => Hash::make('admin')
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
