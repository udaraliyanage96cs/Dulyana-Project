<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = 'Admin';
        $email = 'admin@auth.com';
        $password = '123456';

        // Prevent duplicates
        if (User::where('email', $email)->exists()) {
            $this->error("User with email {$email} already exists!");
            return;
        }

        //first or create user
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );

        $this->info("✅ Admin user created: {$user->email}");
    }
}
