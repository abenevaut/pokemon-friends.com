<?php

namespace template\Http\Controllers\Customer\Users;

use Illuminate\Http\Request;
use template\Domain\Users\Profiles\Repositories\ProfilesRepositoryEloquent;
use template\Domain\Users\Users\User;
use template\Http\Request\Administrator\Users\Profiles\ProfileFormRequest;
use template\Infrastructure\Contracts\Controllers\ControllerAbstract;

class UsersController extends ControllerAbstract
{

    /**
     * @var null|ProfilesRepositoryEloquent
     */
    protected $r_profiles = null;

    /**
     * UsersController constructor.
     *
     * @param ProfilesRepositoryEloquent $r_profiles
     */
    public function __construct(ProfilesRepositoryEloquent $r_profiles)
    {
        $this->r_profiles = $r_profiles;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function dashboard(Request $request)
    {
        try {
            return $this->edit($request->user());
        } catch (\Exception $exception) {
            app('sentry')->captureException($exception);
        }

        return abort('404');
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(User $user)
    {
        try {
            return view(
                'customer.users.users.dashboard',
                [
                    'profile' => $this->r_profiles->getUserProfile($user),
                    'families_situations' => $this
                        ->r_profiles
                        ->getFamilySituations()
                        ->mapWithKeys(function($item) {
                            return [$item => trans("users.profiles.family_situation.{$item}")];
                        }),
                    'timezones' => $this->r_profiles->getTimezones(),
                    'locales' => $this->r_profiles->getLocales(),
                    'civilities' => $this->r_profiles->getCivilities(),
                ]
            );
        } catch (\Exception $exception) {
            app('sentry')->captureException($exception);

            throw $exception;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param integer $id Profile id
     * @param ProfileFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, ProfileFormRequest $request)
    {
//        try {
            $this->r_profiles->updateUserProfileWithRequest($request, $id);
//        } catch (\Prettus\Validator\Exceptions\ValidatorException $exception) {
//            app('sentry')->captureException($exception);
//        }

//        return redirect(route('customer.users.dashboard'));
    }
}
