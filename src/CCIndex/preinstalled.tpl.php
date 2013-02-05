<h1>Installing BTH framework</h1>
<p>This is the default Controller (CCIndex) and where you start the setup of BTH framework.</p>

<!-- <p><b>Download:</b><br>

	First, make sure to download the latest version of BTH from github:<br>
	git clone git://github.com/dannywap/bth.git<br>
	You can review the source directly at https://github.com/dannywap/bth</p>

<p><b>Initial config:</b><br>
	
	<p>Open .htaccess in root and make sure to set "RewriteBase" according to your installation path or comment it away if root installation.</p> -->

<h3>Installation</h3>
<p><b>1. Config database connection</b><br>
	Open file "site/config.php" and change first section to give BTH access to your database.<p>
	
	<p><i>Example:</br>
	<small>
	$ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=mydb';<br>
	$ly->config['database'][0]['user'] = 'db_user';<br>
	$ly->config['database'][0]['password'] = 'P@ssword';<br>
	</small></i></p>

<p><b>2. Install modules</b><br>
	Point your browser to following url to prepare modules by creating needed tables in database:</p>
	
	<p><a href='<?=create_url("modules","install")?>'>modules/install</a></p>

<p><b>3. Login and finalize</b><br>
	Login to you new website with root/root and setup needed users and access.</p>
	
	<p><a href='<?=create_url("user","login")?>'>user/login</a></p>

	
<h1>Extra goodies</h1>
<p><b>Add plugins</b><br>
Open file "site/config.php" and change second section ("MENU DEFINITION") to add Guestbook or Blog to your menu.</p>


Naming standard is:</p>

    <p>CC* is a controller class.<br>
    CM* is a model class.<br>
    C* is a ordinary class without any specific category.<br>
    I* is interface classes.</p>

<p>Files of interest:</p>
	<p><small>/.htaccess 			- Where you setup installation path of BTH.<br>
	/site/config.php 	- Where you can configure: database connection, menu, logo, titles and footer, activate/deactive modules, customize css-theme-path and avaliable regions.<br>
	/site/themes/xxx	- Where you put your own theme as mentioned in config.php (inherits grid-theme by Default).<br>
	/src/CCxxx			- Create your own controllers then enable/link to them from your menu by setting it up in config.php.</small></p>

