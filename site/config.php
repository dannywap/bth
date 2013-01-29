<?php
/**
* Site configuration, this file is changed by user per site.
*
*/

/**
* Set level of error reporting
*/
error_reporting(-1);
ini_set('display_errors', 1);

/**
* Set database(s).
*/

// $ly->config['database'][0]['dsn'] = 'uri:file:' . LYDIA_SITE_PATH . '/data/.ht.mysql';
// Funkar inte. Får bara: Warning: PDO::__construct(file:/customers/1/5/5/bookshare.eu/httpd.www/uppg3b/site/data/.ht.mysql): failed to open stream: No such file or directory in /customers/1/5/5/bookshare.eu/httpd.www/uppg3b/src/CMDatabase/CMDatabase.php on line 22
// Provat olika varianter med customer och /customer i början fil o folder rättigheter, register globals m.m. men det släpper inte, så vi skiter i den filen nu. Skriver in det rätt in i config:
$ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=bookshare_eu';
$ly->config['database'][0]['user'] = 'bookshare_eu';
$ly->config['database'][0]['password'] = 'templosenforskolan';

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
  'page' => array('enabled' => true,'class' => 'CCPage'), 
  'theme' => array('enabled' => true,'class' => 'CCTheme'), 
  'modules' => array('enabled' => true,'class' => 'CCModules'), 
  );


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


/**
* Settings for the theme.
*/
$ly->config['theme'] = array(
  'name'            => 'grid',            // The name of the theme in the theme directory
  'stylesheet'      => 'style.php',       // Main stylesheet to include in template files
  'template_file'   => 'index.tpl.php',   // Default template file, else use default.tpl.php
  // A list of valid theme regions
  'regions' => array('navbar','flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',
  ),'menu_to_region' => array('navbar'=>'navbar'),
  // Add static entries for use in the template file.
  'data' => array(
    'header' => '<h1>Uppg7c - Skapa en webbplats med Lydia</h1>',
    'slogan' => 'A PHP-based MVC-inspired CMF',
    'favicon' => 'logo_80x80.png',
    'logo' => 'logo_80x80.png',
    'logo_width'  => 80,
    'logo_height' => 80,
    'footer' => <<<EOD
<p>Uppgift 7 - Dokumentera koden och använd ramverket för att bygga en webbplats</p>

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
* Define a routing table for urls.
*
* Route custom urls to a defined controller/method/arguments
*/
$ly->config['routing'] = array(
  'home' => array('enabled' => true, 'url' => 'index/index'),
  'modules' => array('enabled' => true, 'url' => 'modules/index'),
  'content' => array('enabled' => true, 'url' => 'content/index'),
  'guestbook' => array('enabled' => true, 'url' => 'guestbook/index'),
  'blog' => array('enabled' => true, 'url' => 'blog/index'),
);




/**
* Define menus.
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
  ),
);

?>
