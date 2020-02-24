<?php

namespace template\Http\Request\Customer\Users\Profiles;

use template\Infrastructure\Contracts\Request\RequestAbstract;
use template\Domain\Users\
{
    Users\User,
    Profiles\Profile
};

class ProfileFormRequest extends RequestAbstract
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'timezone' => 'required|in:' . collect(timezones())->implode(','),
            'locale' => 'required|in:' . collect(User::LOCALES)->implode(','),
        ];

        return $rules;
    }
}
