<?php

namespace pkmnfriends\Domain\Users\Profiles\Repositories;

use Illuminate\Support\Collection;
use pkmnfriends\Domain\Users\Profiles\Criterias\WhereFriendCodeIsCriteria;
use pkmnfriends\Domain\Users\Profiles\Profile;
use pkmnfriends\Infrastructure\Request\RequestAbstract;
use pkmnfriends\Infrastructure\Repositories\RepositoryInterface;
use pkmnfriends\Domain\Users\Users\User;

interface ProfilesRepository extends RepositoryInterface
{

    /**
     * Create user profile.
     *
     * @param array $attributes
     *
     * @return Profile
     */
    public function create(array $attributes): Profile;

    /**
     * Update user profile.
     *
     * @param array $attributes
     * @param integer $id
     *
     * @event ProfileUpdatedEvent
     * @return Profile
     */
    public function update(array $attributes, $id): Profile;

    /**
     * Delete user profile.
     *
     * @param $id
     *
     * @event None
     * @return int
     */
    public function delete($id): int;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getFamilySituations(): Collection;

    /**
     * @param User $user
     * @param array $parameters
     *
     * @return User
     */
    public function createUserProfile(
        User $user,
        $parameters = []
    ): User;

    /**
     * @param User $user
     * @param array $parameters
     *
     * @return User
     */
    public function updateUserProfile(
        User $user,
        $parameters = []
    ): User;

    /**
     * @param User $user
     *
     * @return ProfilesRepositoryEloquent
     */
    public function deleteUserProfile(User $user): self;

    /**
     * @return Collection
     */
    public function getCivilities(): Collection;

    /**
     * @return Collection
     */
    public function getLocales(): Collection;

    /**
     * @return Collection
     */
    public function getTimezones(): Collection;

    /**
     * @return array
     */
    public function getUserProfile(User $user): array;

    /**
     * @param null|string $friend_code
     *
     * @return $this
     */
    public function filterByFriendCode(?string $friend_code): self;

    /**
     * Update the specified resource in storage.
     *
     * @param RequestAbstract $request
     * @param User $user
     *
     * @return void
     */
    public function updateUserProfileWithRequest(
        RequestAbstract $request,
        User $user
    ): void;
}
