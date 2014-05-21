<?php namespace Maer\GoogleAuth;

use App;
use Config;
use Input;
use League\OAuth2\Client\Token\AccessToken;

class GoogleAuth
{
    private $provider;
    private $accessTokenObject;

    public function __construct()
    {
        $this->provider = App::make('Maer\GoogleAuth\AuthProvider')->Google();
    }

    /**
     * Authorize against Google
     * @return redirect Redirect to google auth
     */
    public function authorize()
    {
        return $this->provider->authorize();
    }

    /**
     * Get the access token
     * @return string|null
     */
    public function getAccessToken()
    {
        $tokenObject = $this->getAccessTokenObject();
        if (is_object($tokenObject) 
            && $tokenObject instanceof AccessToken) {
            return $tokenObject->accessToken;
        }

        return null;
    }

    /**
     * Get the League\OAuth2\Client\Token\AccessToken
     * @return League\OAuth2\Client\Token\AccessToken|null
     */
    private function getAccessTokenObject()
    {
        if (!$this->accessTokenObject) {
            $code = Input::get('code');
            if ($code) {
                try {
                    $this->accessTokenObject = $this->provider->getAccessToken(
                        'authorization_code', 
                        array('code' => $code)
                    );
                } catch (Exception $e) {}
            }
        }

        return $this->accessTokenObject;
    }

    /**
     * Get authorized user info
     * @return Maer\GoogleAuth\User|null
     */
    public function callback()
    {
        $code = Input::get('code');
        $user = null;

        if ($code) {
            $accessToken = $this->getAccessTokenObject();

            if ($accessToken) {
                try {
                    $authUser = $this->provider->getUserDetails($accessToken);
                    if ($authUser && $this->validateEmail($authUser->email)) {
                        $user = new User;
                        $user->uid         = $authUser->uid;
                        $user->nickname    = $authUser->nickname;
                        $user->fullName    = $authUser->fullName;
                        $user->firstName   = $authUser->firstName;
                        $user->lastName    = $authUser->lastName;
                        $user->email       = $authUser->email;
                        $user->location    = $authUser->location;
                        $user->description = $authUser->description;
                        $user->imageUrl    = $authUser->imageUrl;
                        $user->urls        = $authUser->urls;
                    }

                } catch (Exception $e) {}
            }
        }

        return $user;
    }

    /**
     * Validate the e-mail address to see if the user is allowed to log in.
     * @param  string   $email
     * @return boolean
     */
    private function validateEmail($email)
    {
        $parts   = explode('@', $email);
        $user    = $parts[0];
        $domain  = $parts[1];

        $whitelist = Config::get('google-auth::allow', array());

        // If $allowed is empty, allow all
        $allowed = $whitelist? false: true;

        foreach($whitelist as $valid) {
            if ($valid == $email || $valid == $domain) {
                $allowed = true;
                break;
            }
        }

        if (!$allowed) return false;

        // Check the black list
        $blacklist = Config::get('google-auth::disallow', array());
        if (!is_array($blacklist)) {
            return true;
        }

        foreach($blacklist as $valid) {
            if ($valid == $email || $valid == $domain) {
                $allowed = false;
                break;
            }
        }
        
        return $allowed;
    }

}
