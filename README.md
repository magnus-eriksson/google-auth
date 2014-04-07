Google Auth for Laravel 4
======================

Add Google auth quick and painless in your Laravel 4 application.
It is basically a wrapper for the [thephpleague/oauth2-client](https://github.com/thephpleague/oauth2-client) package. The original package is dead simple to use, but this package adds a simpe access control.

You can decide which Google accounts/domains are allowed or blocked. Well, I have used this several times anyway and it's been handy. It's as easy as eating pancakes!

Installation
------------
Best way is to use [composer](https://getcomposer.org/download/).

Run `composer require maer/google-auth dev-master` or add this to your composer.json:
```json
{
    "require": {
        "maer/google-auth": "dev-master"
    }
}
```
You can, and should, change `dev-master` to the current latest.


Usage
-----
Register the service provider in `app/config/app.php`:
```php
'providers' => array(
    'Maer\GoogleAuth\GoogleAuthServiceProvider',
)
```

Configuration
-------------
Publish and edit the configuration file
```bash
$ php artisan config:publish maer/google-auth
```

Edit the `app/config/packages/maer/google-auth/config.php`:
```php
return array(
  
    'client_id' => 'YOUR_GOOGLE_CLIENT_ID',
    'secret'    => 'YOUR_GOOGLE_CLIENT_SECRET',
  
    /*
    * Allowed accounts
    * -------------------------------------
    * Enter full e-mail addresses or entire domains.
    * If empty, all e-mail addresses will be allowed.
    */
    'allow'     => array('river.se'),
      
    /*
    * Disallowed accounts
    * -------------------------------------
    * Enter full e-mail addresses or entire domains.
    * If an e-mail or domain is in the allowed and disallowed,
    * it will be blocked.
    */
    'disallow'     => array(),
);
```