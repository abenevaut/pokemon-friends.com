<?php

namespace template\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Validator;
use template\Domain\Users\Profiles\Profile;
use template\Domain\Users\Profiles\ProfilesTeamsColors;
use template\Domain\Users\Profiles\Repositories\ProfilesRepositoryEloquent;
use template\Domain\Users\Users\Repositories\UsersRegistrationsRepositoryEloquent;

class RegisterFriendCodeJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var mixed
     */
    protected $friendCode;

    /**
     * @var string
     */
    protected $teamColor;

    /**
     * RegisterFriendCodeJob constructor.
     *
     * @param string $friendCode
     * @param string $teamColor default ProfilesTeamsColors::BLUE
     */
    public function __construct(
        string $friendCode,
        string $teamColor = ProfilesTeamsColors::DEFAULT
    ) {
        $this->friendCode = $friendCode;
        $this->teamColor = $teamColor;
    }

    /**
     * Execute the job.
     *
     * @param UsersRegistrationsRepositoryEloquent $r_users
     * @param ProfilesRepositoryEloquent $r_profiles
     */
    public function handle(
        UsersRegistrationsRepositoryEloquent $r_users,
        ProfilesRepositoryEloquent $r_profiles
    ) {
        try {
            $validator = Validator::make(
                [
                    'friend_code' => $this->friendCode,
                    'team_color' => $this->teamColor,
                ],
                [
                    'friend_code' => 'required|string|numeric|digits:12',
                    'team_color' => 'required|in:'
                        . ProfilesTeamsColors::DEFAULT . ','
                        . ProfilesTeamsColors::RED . ','
                        . ProfilesTeamsColors::BLUE . ','
                        . ProfilesTeamsColors::YELLOW,
                ]
            );

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $profile = $r_profiles->findByField('friend_code', $this->friendCode);

            if ($profile->count() && $profile->first()->is_claimable) {
                $profile->first()->friend_code = $this->friendCode;
                $profile->first()->team_color = $this->teamColor;
                $profile->first()->save();
            } elseif (!$profile->count()) {
                $user = $r_users
                    ->registerUser(
                        Profile::claimableEmail($this->friendCode),
                        bcrypt($this->friendCode)
                    );

                $user->profile->friend_code = $this->friendCode;
                $user->profile->team_color = $this->teamColor;
                $user->profile->save();
            }
        } catch (\Exception $exception) {
            app('sentry')->captureException($exception);
        }
    }
}
