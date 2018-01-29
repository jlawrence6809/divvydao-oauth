<?php
$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'oo4fwn9enfyy8r6h1arf7x8aww',
    'clientSecret'            => 'ahhnnmd5cjyr8pnz817mdy6yqy',
    'redirectUri'             => 'http://divvydao.org/diglife/divvydao-oauth',
    'urlAuthorize'            => 'https://chat.divvydao.net/oauth/authorize',
    'urlAccessToken'          => 'https://chat.divvydao.net/oauth/access_token',
    'urlResourceOwnerDetails' => 'https://chat.divvydao.net/api/v4/users/me'
]);

function getProvider(){
    global $provider;
    return $provider;
}

function isAuthed(){
    if(isset($_SESSION['accessToken'])){
        return true;
    } 
    return false;
}

function makeMattermostRequest($endpoint){
    $request = getProvider()->getAuthenticatedRequest(
        'GET',
        'https://chat.divvydao.net/'.$endpoint,
        $_SESSION['accessToken']
    );
    $response = getProvider()->getResponse($request);
    return $response->getBody()->getContents();
}

/**
 * Displays site name.
 */
function siteName()
{
    echo config('name');
}

/**
 * Displays site version.
 */
function siteVersion()
{
    echo config('version');
}

/**
 * Website navigation.
 */
function navMenu($sep = ' | ')
{
    $nav_menu = '';

    foreach (config('nav_menu') as $uri => $name) {
        $nav_menu .= '<a href="/'.config('root').'/'.(config('pretty_uri') || $uri == '' ? '' : '?page=').$uri.'">'.$name.'</a>'.$sep;
    }

    echo trim($nav_menu, $sep);
}

/**
 * Displays page title. It takes the data from 
 * URL, it replaces the hyphens with spaces and 
 * it capitalizes the words.
 */
function pageTitle()
{
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';

    echo ucwords(str_replace('-', ' ', $page));
}

function currentPage()
{
    if(isset($_GET['page'])){
        return $_GET['page'];
    }
    print($_SERVER['REQUEST_URI']);
    if(config('pretty_uri')){
        $req_uri = explode("?", explode("divvydao-oauth/", $_SERVER['REQUEST_URI'])[1])[0];
        if(strlen($req_uri) > 0){
            return $req_uri;
        }
    }
    return 'home';
}

/**
 * Displays page content. It takes the data from 
 * the static pages inside the pages/ directory.
 * When not found, display the 404 error page.
 */
function pageContent()
{
    $page = currentPage();
    $path = config('content_path').'/'.$page.'.php';
    if (file_exists(filter_var($path, FILTER_SANITIZE_URL))) {
        include $path;
    } else {
        include config('content_path').'/404.php';
    }
}

/**
 * Starts everything and displays the template.
 */
function run()
{
    include config('template_path').'/template.php';
}
