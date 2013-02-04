<h1> Dannys BTH -a variant of Lydia</h1>

Each class in a separate directory, besides the bootstrap.php.

Naming standard is:

    CC* is a controller class.
    CM* is a model class.
    C* is a ordinary class without any specific category.
    I* is interface classes.

Files of interest:
	/.htaccess 			- Where you setup installation path of BTH.
	/site/config.php 	- Where you can configure: database connection, menu, logo, titles and footer, activate/deactive modules, customize css-theme-path and avaliable regions.
	/site/themes/xxx	- Where you put your own theme as mentioned in config.php (inherits grid-theme by Default).
	/src/CCxxx			- Create your own modules then enable/link to them from your menu by setting it up in config.php.

Download:

	First, make sure to download the latest version of BTH from github:
	git clone git://github.com/dannywap/bth.git
	You can review the source directly at https://github.com/dannywap/bth

Initial config:
	
	Open .htaccess in root and make sure to set "RewriteBase" according to your installation path or comment it away if root installation.

Installation:

1. Config database connection
	
	Open file "site/config.php" and change first section to give BTH access to your database.
	Example:
	$ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=mydb';
	$ly->config['database'][0]['user'] = 'db_user';
	$ly->config['database'][0]['password'] = 'P@ssword';

2. Install modules
	
	Point your browser to following url to prepare modules by creating needed tables in database:
	modules/install

3. Configure meny
	
	Open file "site/config.php" and change second section to define your own items in the menu.

4. Login and finalize
	
	Login to you new website with root/root and setup needed users and access.
	user/login

