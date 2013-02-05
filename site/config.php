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
* DATABASE SETUP
* <First required step before starting the initial installation>
* Set database(s). Step 1. In installation phase
* Example:
* $ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=mydb';
* $ly->config['database'][0]['user'] = 'db_user';
* $ly->config['database'][0]['password'] = 'P@ssword';
*/

$ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=bookshare_eu';
$ly->config['database'][0]['user'] = 'bookshare_eu';
$ly->config['database'][0]['password'] = 'templosenforskolan';




/**
* MENU DEFINITION
* <This is what you want to have a look at. The manual part of the menu bar of your website>
*
* NOTE: All "Content" in db of type "page" will automatically be visible in menubar as a page.
*
* Define menus. Step 3. In installation phase
* Create your own menus and map them to a theme region through $ly->config['theme'].
* You can also just remove "comment"-mark in front of predefined menus you'd like to use.
*/
$ly->config['menus'] = array(
  'navbar' => array(
//    'modules' => array('label'=>'Modules', 'url'=>'modules'),			// <- Remove comment to show meny tab Modules (good for tech overview)
//    'content' => array('label'=>'Content', 'url'=>'content'),			// <- Remove comment to show meny tab Content (show all pages and blog posts - techie style)
//    'guestbook' => array('label'=>'Guestbook', 'url'=>'guestbook'),   // <- Remove comment to show meny tab Guestbook (a predefined Guestbook for your needs)
//    'blog' => array('label'=>'Blog', 'url'=>'blog'),					// <- Remove comment to show meny tab Blog (a predifines blog)
//    'pages' => array('label'=>'Pages', 'url'=>'pages'),				// <- Remove comment to show meny tab Pages (experiment)
//    'mypage' => array('label'=>'Mypage', 'url'=>'mypage'),			// <- Remove comment to show meny tab MyPage (Example for how you can create your own component)
//    'about' => array('label'=>'About', 'url'=>'page/view/about'),		// <- How content of type "page" is generated in the meny. Automated creation is a part of CLydia->DrawManu() function.
  ),
);




/** 
* ROUTING TABLES
* <Optional, to make shorter links >
* Define a routing table for urls. - Create your own custom links to content
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
* THEME SETTINGS
* Settings for the theme.
*/
$ly->config['theme'] = array(
  'path'            => 'themes/grid',	  // <-- Set this to your own theme folder!
  'parent'          => 'themes/grid',
  'stylesheet'      => 'style.php',       // Main stylesheet to include in template files
  'template_file'   => 'index.tpl.php',   // Default template file, else use default.tpl.php
  // A list of valid theme regions
  // Default - 'navbar','flash','featured-first','featured-middle','featured-last','primary','sidebar','triptych-first','triptych-middle','triptych-last','footer-column-one','footer-column-two','footer-column-three','footer-column-four','footer'
  'regions' => array('navbar','flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',
  ),'menu_to_region' => array('navbar'=>'navbar'),
  // Add static entries for use in the template file.
  'data' => array(
    'header' => '<h1>Here goes your title</h1>',
    'slogan' => 'And some extra text if you want.',
    'favicon' => 'logo_80x80.png',		// <-- Expected to be found in "path"-theme folder.
    'logo' => 'logo_80x80.png',			// <-- Expected to be found in "path"-theme folder.
    'logo_width'  => 80,
    'logo_height' => 80,
    'footer' => <<<EOD
<p>Here goes your footer.</p>

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
* DEFINING CONTROLLERS  
* Define the controllers, their classname and enable/disable them.
* 
* <This is required to modify if you create your own controller>
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
* ADVANCED SETTING
* <Usually not for you>
* This is the Advanced section where you usually don't need to touch 
* 
*/

/**
* Set level of error reporting
* 0=off, -1=show all
*/
error_reporting(-1);
ini_set('display_errors', 1);

/**
* Set what to show as debug or developer information in the get_debug() theme helper.
*/
$ly->config['debug']['display-lydia'] = false;


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



?>
