<!doctype html>
<html lang='en'>
<head>
	<meta charset='utf-8'/>
	<title>Installing BTH Framework</title>
	<link rel='stylesheet' href='themes/core/style.css'/>
</head>
<body>
<div>
<h1>BTH framework installation</h1>
<p>Some settings are required for BTH framework to run properly. These tests verify that.</p>
</div>
<?php
global $success;
function is_mod_rewrite_enabled() {
	if ($_SERVER['HTTP_MOD_REWRITE'] == 'On') {
		return TRUE;
	} else {
		return FALSE;
	}
}

if(is_mod_rewrite_enabled()): $success+=1; ?>
<div class="success">
<h2>Successfully verified your server has the mod_rewrite enabled</h2>
<p>You should be able to configure .htaccess. Please review more info about this quick step found in the .htaccess-file.</p>
</div>
<? else: ?>
<div class="alert">
<h2>Problem: It seem like your server does not have the mod_rewrite enabled</h2>
<p>You will not be able to configure .htaccess according to needed settings.</p>
<ul>
    <li>To check if mod_rewrite module is enabled, create a new php file in yur root folder of your WAMP/LAMP server. Enter the following<br>
    phpinfo();</li>

    <li>Access your created file from your browser.</li>

    <li>Ctrl+F to open a search. Search for 'mod_rewrite'. If it is enabled you see it as 'Loaded Modules'</li>

    <li>If not, open httpd.conf (Apache Config file) and look for the following line.<br>
    #LoadModlie rewrite_modlie modlies/mod_rewrite.so</li>

    <li>remove the pound ('#') sign at the start and save the this file.</li>

    <li>Restart your apache server.</li>

    <li>Access the same php file in your browser.</li>

    <li>search for 'mod_rewrite' again. You sholid be able to find it now.</li>
</ul>
</div>
<? endif ?>
<?php if(version_compare(PHP_VERSION, '5.0.0', '>=')): $success+=1; ?>
<div class="success"><h2>Successfully verified your server has correct PHP version</h2>
Good your PHP version <?=PHP_VERSION?> is higher than 5.0.0.</div>
<? else: ?>
<div class="alert"><h2>Problem: Your PHP version is too old</h2>
Unfortunatelly this framework requires at least PHP v5.0. Your version <?=PHP_VERSION?> is outdated. You can update it here.</div>';
<? endif; ?>

<?php if($success>1): ?>

<h1>Successfully confirmed</h1>
<p>Before clicking continue doublecheck your .htaccess configuration or you <u>will</u> the 404 message!.<p>
<div class="success"><p><a href="modules/install">Continue >></a></p></div>
<? else: ?>
<h1>You can not start installation unless this problem is fixed :(</h1>
<? endif; ?>
