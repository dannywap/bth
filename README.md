<h1> Dannys BTH -a variant of Lydia</h1>

Download:

	First, make sure to download the latest version of BTH from github:
	git clone git://github.com/dannywap/bth.git
	You can review the source directly at https://github.com/dannywap/bth

Initial config:
	
	Open .htaccess in root and make sure to set "RewriteBase" according to your installation path or comment it away if root installation.


<h3>Installation</h3>

1. Config database connection

	Open file "site/config.php" and change first section to give BTH access to your database.<br>
	<i>Example:<br>
	$ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=mydb';<br>
	$ly->config['database'][0]['user'] = 'db_user';<br>
	$ly->config['database'][0]['password'] = 'P@ssword';<br></i>

2. Verify environment

	Point your browser to the installation folder and run:<br>
	/install.php

3. Login and finalize

	Login to you new website with root/root and setup needed users and access.

<h3>Extra goodies</h3>

	Add plugins
	Open file "site/config.php" and change second section ("MENU DEFINITION") to activate Guestbook or Blog in the menu.

Naming standard is:

	CC* is a controller class.
	CM* is a model class.
	C* is a ordinary class without any specific category.
	I* is interface classes.

Files of interest:

	/.htaccess - Where you setup installation path of BTH.
	/site/config.php - Where you can configure: database connection, menu, logo, titles and footer, activate/deactive modules, customize css-theme-path and avaliable regions.
	/site/themes/xxx - Where you put your own theme as mentioned in config.php (inherits grid-theme by Default).
	/src/CCxxx - Create your own controllers then enable/link to them from your menu by setting it up in config.php.
