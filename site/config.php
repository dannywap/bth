<?php
/**
* Site configuration, this file is changed by user per site.
*
*/

/************************************************************************
* This is the Easy section where you usually edit to start up your site 
* 
*/

/**
* Set database(s). Step 1. In installation phase
*/
$ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=bookshare_eu';
$ly->config['database'][0]['user'] = 'bookshare_eu';
$ly->config['database'][0]['password'] = 'templosenforskolan';


/**
* Define menus. Step 3. In installation phase
*
* Create hardcoded menus and map them to a theme region through $ly->config['theme'].
*/
$ly->config['menus'] = array(
  'navbar' => array(
    'home' => array('label'=>'Home', 'url'=>'home'),
    'modules' => array('label'=>'Modules', 'url'=>'modules'),
    'content' => array('label'=>'Content', 'url'=>'content'),
    'guestbook' => array('label'=>'Guestbook', 'url'=>'guestbook'),
    'blog' => array('label'=>'Blog', 'url'=>'blog'),
    'pages' => array('label'=>'Pages', 'url'=>'pages'),
  ),
);

/**
* Define a routing table for urls. - Create your own custom links to content
*
* Route custom urls to a defined controller/method/arguments
*/
$ly->config['routing'] = array(
  'home' => array('enabled' => true, 'url' => 'index/index'),
  'modules' => array('enabled' => true, 'url' => 'modules/index'),
  'content' => array('enabled' => true, 'url' => 'content/index'),
  'guestbook' => array('enabled' => true, 'url' => 'guestbook/index'),
  'blog' => array('enabled' => true, 'url' => 'blog/index'),
  'pages' => array('enabled' => true, 'url' => 'pages/index'),
  'mypage' => array('enabled' => true, 'url' => 'mypage/index'),
);


/**
* Settings for the theme.
*/
$ly->config['theme'] = array(
  'path'            => 'themes/dannys',
  'parent'          => 'themes/grid',
  'stylesheet'      => 'style.css',       // Main stylesheet to include in template files
  'template_file'   => 'index.tpl.php',   // Default template file, else use default.tpl.php
  // A list of valid theme regions
  'regions' => array('navbar','flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',
  ),'menu_to_region' => array('navbar'=>'navbar'),
  // Add static entries for use in the template file.
  'data' => array(
    'header' => '<h1>Here goes your title</h1>',
    'slogan' => 'And some extra text if you want.',
    'favicon' => 'logo_80x80.png',
    'logo' => 'logo_80x80.png',
    'logo_width'  => 80,
    'logo_height' => 80,
    'footer' => <<<EOD
<p>Uppgift 8 - Clean up and put in production</p>

<p>Docs:
<a href="http://www.w3.org/2009/cheatsheet">cheatsheet</a>
<a href="http://dev.w3.org/html5/spec/spec.html">html5</a>
<a href="http://www.w3.org/TR/CSS2">css2</a>
<a href="http://www.w3.org/Style/CSS/current-work#CSS3">css3</a>
<a href="http://php.net/manual/en/index.php">php</a>
<a href="http://www.sqlite.org/lang.html">sqlite</a>
<a href="http://www.blueprintcss.org/">blueprint</a>
</p>

EOD
,),
);


/**
* Define the controllers, their classname and enable/disable them.
*
* The array-key is matched against the url, for example:
* the url 'developer/dump' would instantiate the controller with the key "developer", that is
* CCDeveloper and call the method "dump" in that class. This process is managed in:
* $ly->FrontControllerRoute();
* which is called in the frontcontroller phase from index.php.
*/
$ly->config['controllers'] = array(
  'index' => array('enabled' => true,'class' => 'CCIndex'),
  'developer' => array('enabled' => true,'class' => 'CCDeveloper'),
  'guestbook' => array('enabled' => true,'class' => 'CCGuestbook'),
  'user' => array('enabled' => true,'class' => 'CCUser'),
  'content' => array('enabled' => true,'class' => 'CCContent'),
  'blog' => array('enabled' => true,'class' => 'CCBlog'), 
  'pages' => array('enabled' => true,'class' => 'CCPages'), 
  'page' => array('enabled' => true,'class' => 'CCPage'), 
  'theme' => array('enabled' => true,'class' => 'CCTheme'), 
  'modules' => array('enabled' => true,'class' => 'CCModules'), 
  'mypage' => array('enabled' => true,'class' => 'CCMyController'), 
  );







/************************************************************************
* This is the Advanced section where you usually don't need to touch 
* 
*/

/**
* Set level of error reporting
*/
error_reporting(-1);
ini_set('display_errors', 1);

/**
* Set what to show as debug or developer information in the get_debug() theme helper.
*/
$ly->config['debug']['display-lydia'] = true;


/**
* What type of urls should be used?
*
* default = 0 => index.php/controller/method/arg1/arg2/arg3
* clean = 1 => controller/method/arg1/arg2/arg3
* querystring = 2 => index.php?q=controller/method/arg1/arg2/arg3
*/
$ly->config['url_type'] = 1;

/**
* Set a base_url to use another than the default calculated
*/
$ly->config['base_url'] = null;


/* Setting to store session values */
$ly->config['session_key']  = 'lydia';

/**
* Define session name
*/
$ly->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);

/**
* Define server timezone
*/
$ly->config['timezone'] = 'Europe/Stockholm';

/**
* Define internal character encoding
*/
$ly->config['character_encoding'] = 'UTF-8';

/**
* Define language
*/
$ly->config['language'] = 'en';


/**
* Set what to show as debug or developer information in the get_debug() theme helper.
*/
$ly->config['debug']['lydia'] = false;
$ly->config['debug']['db-num-queries'] = true;
$ly->config['debug']['db-queries'] = true;

/**
* Allow or disallow creation of new user accounts.
*/
$ly->config['create_new_users'] = true;


/**
* Settings for the theme.
*/
// $ly->config['theme'] = array(
  // 'name'            => 'grid',            // The name of the theme in the theme directory
  // 'stylesheet'      => 'style.php',       // Main stylesheet to include in template files
  // 'template_file'   => 'index.tpl.php',   // Default template file, else use default.tpl.php
  // // A list of valid theme regions
  // 'regions' => array('flash','featured-first','featured-middle','featured-last',
    // 'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    // 'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    // 'footer',
  // ),
// );



?>
