<?php
/**
 * Google Auth Configuration
 * --------------------------
 */

return array(

    'client_id'    => 'YOUR_GOOGLE_CLIENT_ID',
    'secret'       => 'YOUR_GOOGLE_CLIENT_SECRET',
    'callback_url' => 'YOUR_GOOGLE_CLIENT_CALLBACK_URL',

    /*
    * Allowed accounts
    * -------------------------------------
    * Enter full e-mail addresses or entire domains.
    * If empty, all e-mail addresses will be allowed.
    */
    'allow'     => array('your-email@a-domain.com', 'another-domain.com'),

    /*
    * Disallowed accounts
    * -------------------------------------
    * Enter full e-mail addresses or entire domains.
    * If an e-mail or domain is in the allowed and disallowed,
    * it will be blocked.
    */
    'disallow'     => array('not-allowed@another-domain.com'),
);