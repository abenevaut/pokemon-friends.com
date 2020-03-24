<?php

use Illuminate\Database\Seeder;
use template\Domain\Users\Profiles\Profile;
use template\Domain\Users\Users\User;
use template\Domain\Users\Leads\Lead;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)
            ->states(User::ROLE_ADMINISTRATOR)
            ->create([
                'email' => 'admin@pokemon-friends.com'
            ])
            ->each(function ($user) {
                factory(Profile::class)->create([
                    'user_id' => $user->id,
                    'friend_code' => '500161205617',
                    'team_color' => \template\Domain\Users\Profiles\ProfilesTeamsColors::BLUE,
                ]);
            });

        factory(User::class)
            ->states(User::ROLE_ACCOUNTANT)
            ->create([
                'email' => 'accountant@pokemon-friends.com'
            ])
            ->each(function ($user) {
                factory(Profile::class)->create(['user_id' => $user->id]);
            });

        factory(User::class)
            ->states(User::ROLE_CUSTOMER)
            ->create([
                'email' => 'customer@pokemon-friends.com'
            ])
            ->each(function ($user) {
                factory(Profile::class)->create([
                    'user_id' => $user->id,
                    'friend_code' => '500161205617',
                    'team_color' => \template\Domain\Users\Profiles\ProfilesTeamsColors::RED,
                ]);
            });

        factory(User::class, 50)
            ->states(User::ROLE_CUSTOMER)
            ->create()
            ->each(function ($user) {
                factory(Profile::class)->create(['user_id' => $user->id]);
                if (0 === \Faker\Factory::create()->numberBetween(0, 9) % 2) {
                    factory(Lead::class)->create(['user_id' => $user->id]);
                }
            });
        factory(Lead::class, 10)->create();
    }
}
