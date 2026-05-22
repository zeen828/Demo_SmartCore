<?php

namespace Database\Factories;

// Models
use App\Models\User;
use Spatie\Permission\Models\Role;
//
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'status' => fake()->boolean(),
            'is_admin' => fake()->boolean(),
            'is_counter' => fake()->boolean(),
            'is_web' => fake()->boolean(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * 超級管理員角色
     * User::factory()->superAdmin()->create();
     */
    public function superAdmin(): static
    {
        return $this
            ->state(fn (array $attributes) => [
                'email_verified_at' => now(),
                'status' => true,
                'is_admin' => true,
                'is_counter' => true,
                'is_web' => true,
            ])
            ->afterCreating(function (User $user) {
                // 沒有就建立
                Role::firstOrCreate([
                    'name' => 'super_admin'
                ]);
                $user->assignRole('super_admin');
            });
    }

    /**
     * 管理員角色
     * User::factory()->admin()->create();
     */
    public function admin(): static
    {
        return $this
            ->state(fn (array $attributes) => [
                'email_verified_at' => now(),
                'status' => true,
                'is_admin' => true,
                'is_counter' => false,
                'is_web' => false,
            ])
            ->afterCreating(function (User $user) {
                // 沒有就建立
                Role::firstOrCreate([
                    'name' => 'admin'
                ]);
                $user->assignRole('admin');
            });
    }

    /**
     * 櫃台角色
     * User::factory()->counter()->create();
     */
    public function counter(): static
    {
        return $this
            ->state(fn (array $attributes) => [
                'email_verified_at' => now(),
                'status' => true,
                'is_admin' => false,
                'is_counter' => true,
                'is_web' => false,
            ])
            ->afterCreating(function (User $user) {
                // 沒有就建立
                Role::firstOrCreate([
                    'name' => 'counter'
                ]);
                $user->assignRole('counter');
            });
    }

    /**
     * 網站者角色
     * User::factory()->web()->create();
     */
    public function web(): static
    {
        return $this
            ->state(fn (array $attributes) => [
                'email_verified_at' => now(),
                'status' => true,
                'is_admin' => false,
                'is_counter' => false,
                'is_web' => true,
            ])
            ->afterCreating(function (User $user) {
                // 沒有就建立
                Role::firstOrCreate([
                    'name' => 'web'
                ]);
                $user->assignRole('web');
            });
    }

    /**
     * 使用者角色
     * User::factory()->user()->create();
     */
    public function user(): static
    {
        return $this
            ->state(fn (array $attributes) => [
                'email_verified_at' => now(),
                'status' => true,
                'is_admin' => false,
                'is_counter' => false,
                'is_web' => false,
            ])
            ->afterCreating(function (User $user) {
                // 沒有就建立
                Role::firstOrCreate([
                    'name' => 'user'
                ]);
                $user->assignRole('user');
            });
    }
}
