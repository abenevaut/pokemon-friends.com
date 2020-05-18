<?php

namespace template\Http\Controllers\Anonymous\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Honeypot\ProtectAgainstSpam;
use template\Domain\Users\Users\Repositories\UsersRepositoryEloquent;
use template\Domain\Users\Users\User;
use template\Infrastructure\Contracts\Controllers\ControllerAbstract;

class UsersController extends ControllerAbstract
{

    /**
     * @var UsersRepositoryEloquent
     */
    protected $r_users;

    /**
     * UsersController constructor.
     *
     * @param UsersRepositoryEloquent $r_users
     */
    public function __construct(UsersRepositoryEloquent $r_users)
    {
        $this
            ->middleware(ProtectAgainstSpam::class)
            ->only('index');

        $this->r_users = $r_users;
    }

    /**
     * Display resources list.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = $request->get('page') ?? 1;
        $metadata = [
            'title' => trans('users.trainers.title', compact('page')),
            'description' => trans('users.trainers.description', compact('page')),
        ];
        $users = $this
            ->r_users
            ->getTrainers(!Auth::check())
            ->paginate(config('repository.pagination.trainers'));

        return view('anonymous.users.users.index', compact('metadata', 'users'));
    }

    /**
     * Show the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        if (!$user || $user->deleted_at || !$user->profile) {
            abort(404);
        }

        $friend_code = $user->profile->formated_friend_code;
        $metadata = [
            'title' => trans('users.trainer', compact('friend_code')),
            'description' => trans('users.trainer.description', compact('friend_code')),
        ];
        $nickname = $user->profile->nickname;
        $qr = route('v1.users.qr', ['user' => $user->uniqid]);
        $schema = $user
            ->profile
            ->friend_code_schema
            ->about($metadata['description']);

        return view(
            'anonymous.users.users.show',
            compact('metadata', 'schema', 'friend_code', 'nickname', 'qr')
        );
    }

    /**
     * Display users dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        $metadata = [
            'title' => config('app.name'),
            'description' => config('app.description'),
        ];
        $users = $this
            ->r_users
            ->getTrainers()
            ->paginate(config('repository.pagination.limit'));

        return view('anonymous.users.users.dashboard', compact(
            'metadata',
            'users',
        ));
    }

    /**
     * Display users terms.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        $metadata = [
            'title' => trans('users.terms'),
            'description' => trans('users.terms.description'),
        ];

        return view('anonymous.users.users.terms', compact('metadata'));
    }
}
