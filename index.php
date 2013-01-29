<?php
//
// PHASE: BOOTSTRAP
//
// dwg.ps: "dirname(__FILE__)" = /customers/1/5/5/bookshare.eu/httpd.www/uppg3b
define('LYDIA_INSTALL_PATH', dirname(__FILE__));
define('LYDIA_SITE_PATH', LYDIA_INSTALL_PATH . '/site');

require(LYDIA_INSTALL_PATH.'/src/CLydia/bootstrap.php');

$ly = CLydia::Instance();

//
// PHASE: FRONTCONTROLLER ROUTE
//
$ly->FrontControllerRoute();

//
// PHASE: THEME ENGINE RENDER
//
$ly->ThemeEngineRender();
?>
