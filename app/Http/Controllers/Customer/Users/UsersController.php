<?php

namespace template\Http\Controllers\Customer\Users;

use Illuminate\Http\Request;
use template\Domain\Users\Profiles\Repositories\ProfilesRepositoryEloquent;
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function dashboard(Request $request)
    {
        return redirect(route('customer.users.profiles.edit', ['user' => $request->user()]));
    }
}
