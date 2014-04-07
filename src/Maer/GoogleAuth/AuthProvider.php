<?php namespace Maer\GoogleAuth;

use Config;
use League\OAuth2\Client\Provider;

class AuthProvider
{
    private $providers = array();

    public function Google()
    {
        if (!array_key_exists('google', $this->providers)) {
            $this->providers['google'] = new Provider\Google(array(
                'clientId'      =>  Config::get('google-auth::client_id'),
                'clientSecret'  =>  Config::get('google-auth::secret'),
                'redirectUri'   =>  Config::get('google-auth::callback_url'),
            ));
        }
        return $this->providers['google'];
    }
}