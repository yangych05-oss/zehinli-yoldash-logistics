<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Never provision privileged users with hard-coded credentials.
        // Production administrator accounts require an explicit, separately
        // audited provisioning procedure; this development helper is disabled.
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        $email = env('ZNY_DEV_ADMIN_EMAIL');
        $password = env('ZNY_DEV_ADMIN_PASSWORD');

        if (! is_string($email) || $email === '' || ! is_string($password) || $password === '') {
            return; // Do not create an implicit admin without opt-in.
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($password) < 20) {
            throw new RuntimeException('Development admin requires a valid email and password of at least 20 characters.');
        }

        if (User::query()->where('email', $email)->exists()) {
            return; // Never silently overwrite existing account credentials or roles.
        }

        $admin = User::query()->create([
            'name' => 'Development Admin',
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $admin->assignRole('admin');
    }
}
