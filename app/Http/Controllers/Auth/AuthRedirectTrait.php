<?php namespace obsession\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

trait AuthRedirectTrait
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'customer.dashboard.index';

    /**
     * Where to redirect accountants after login.
     *
     * @var string
     */
    protected $redirectToAccountantSection = 'accountant.files.index';

    /**
     * Where to redirect administrators after login.
     *
     * @var string
     */
    protected $redirectToBackend = 'backend.dashboard.index';

    /**
     * @return string
     */
    public function redirectTo()
    {
        if (Auth::user()->is_administrator) {
            return route($this->redirectToBackend);
        } elseif (Auth::user()->is_accountant) {
            return route($this->redirectToAccountantSection);
        }

        return route($this->redirectTo);
    }
}
