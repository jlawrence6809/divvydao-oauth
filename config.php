<?php

/**
 * Used to store website configuration information.
 *
 * @var string
 */
function config($key = '')
{
    $local_not_prod = true;

    $prod_config = [
        'name' => 'RChain Oauth Test',
        'nav_menu' => [
            '' => 'Home',
            'authorize' => 'Authorize To Mattermost',
            'deauthorize' => 'Deauthorize',
            'exampleapi' => 'Mattermost Users',
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'pretty_uri' => false,
        'version' => 'v2.0',
        'root' => 'diglife/divvydao-oauth',
    ];

    $local_config = [
        'name' => 'RChain Oauth Test',
        'nav_menu' => [
            '' => 'Home',
            'authorize' => 'Authorize To Mattermost',
            'deauthorize' => 'Deauthorize',
            'exampleapi' => 'Mattermost Users',
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'pretty_uri' => false,
        'version' => 'v2.0',
        'root' => '',
    ];
    $config = ($local_not_prod) ? $local_config : $prod_config;

    return isset($config[$key]) ? $config[$key] : null;
}
