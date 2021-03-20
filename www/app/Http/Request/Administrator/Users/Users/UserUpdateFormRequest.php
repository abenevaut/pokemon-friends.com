<?php

namespace pkmnfriends\Http\Request\Administrator\Users\Users;

use pkmnfriends\Domain\Users\Profiles\ProfilesTeamsColors;
use pkmnfriends\Infrastructure\Request\RequestAbstract;
use pkmnfriends\Domain\Users\Users\User;

class UserUpdateFormRequest extends UserStoreFormRequest
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
        $rules = parent::rules();

        $rules['email'] = "required|email|max:80|unique:users,email,{$this->segment(3)},uniqid";

        return $rules;
    }
}
