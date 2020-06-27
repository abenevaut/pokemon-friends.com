<?php

namespace Tests\Feature\Http\Controllers\Api\V1\Users;

use pkmnfriends\Infrastructure\Interfaces\Domain\Users\Profiles\ProfileFamiliesSituationsInterface;
use Tests\TestCase;
use Tests\OAuthTestCaseTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use pkmnfriends\Domain\Users\Profiles\Profile;
use pkmnfriends\Domain\Users\Users\User;
use pkmnfriends\Domain\Users\Users\Transformers\UserTransformer;

class ProfilesControllerTest extends TestCase
{
    use OAuthTestCaseTrait;
    use DatabaseMigrations;

    public function testFamilySituations()
    {
        $user = factory(User::class)->create();
        factory(Profile::class)->create(['user_id' => $user->id]);
        Passport::actingAs($user);

        $this
            ->getJson('/api/v1/users/profiles/family-situations')
            ->assertSuccessful()
            ->assertExactJson(ProfileFamiliesSituationsInterface::FAMILY_SITUATIONS);
    }

    public function testUserAsAnonymousEndpoint()
    {
        // Do not act as anyone to get Unauthenticated exception.
        $this
            ->getJson('/api/v1/users/user')
            ->assertStatus(401)
            ->assertExactJson(['error' => 'Unauthenticated.']);
    }
}
