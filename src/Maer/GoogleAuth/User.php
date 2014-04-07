<?php namespace Maer\GoogleAuth;

/**
 * User object
 * -------------------------------------------------
 * This ogject is currently identical to the 
 * League\OAuth2\Client\Provider\User object.
 * The reason is to have a layer of abstraction in case we 
 * want to swap the oauth2 client.
 */
class User
{
    public $uid;
    public $nickname;
    public $fullName;
    public $firstName;
    public $lastName;
    public $email;
    public $location;
    public $description;
    public $imageUrl;
    public $urls;
}