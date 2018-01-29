<?php

/**
 * Used to store website configuration information.
 *
 * @var string
 */
function config($key = '')
{
    $config = [
        'name' => 'RChain Oauth Test',
        'nav_menu' => [
            '' => 'Home',
            'authorize' => 'Authorize To Mattermost',
            'deauthorize' => 'Deauthorize',
            'exampleapi' => 'Mattermost Users',
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'pretty_uri' => true,
        'version' => 'v2.0',
        'root' => 'diglife/divvydao-oauth',
    ];

    return isset($config[$key]) ? $config[$key] : null;
}
