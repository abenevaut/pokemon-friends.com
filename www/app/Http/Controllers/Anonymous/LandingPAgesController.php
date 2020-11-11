<?php

namespace pkmnfriends\Http\Controllers\Anonymous;

use pkmnfriends\Infrastructure\Contracts\Controllers\ControllerAbstract;

class LandingPagesController extends ControllerAbstract
{

    public function displayQrcodeOnTwitchtv()
    {
        $metadata = [
            'title' => config('app.name'),
            'description' => config('app.description'),
        ];

        return view('anonymous.lp-display-qrcode-on-twitchtv', compact('metadata'));
    }

    public function shareProfileOnSocialNetworks()
    {
        $metadata = [
            'title' => config('app.name'),
            'description' => config('app.description'),
        ];

        return view('anonymous.lp-share-profile-on-social-networks', compact('metadata'));
    }
}
