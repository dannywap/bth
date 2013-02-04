<h1>Index Controller of BTH</h1>
<p>Welcome to the Index Controller (CCIndex - default controller).</p>
<b>Download:</b>

	<p>First, make sure to download the latest version of BTH from github:<br>
	git clone git://github.com/dannywap/bth.git<br>
	You can review the source directly at https://github.com/dannywap/bth</p>

<b>Initial config:</b>
	
	<p>Open .htaccess in root and make sure to set "RewriteBase" according to your installation path or comment it away if root installation.</p>

<b>Installation:</b>

<p>1. Config database connection</p>
	
	<p>Open file "site/config.php" and change first section to give BTH access to your database.<br>
	Example:<br>
	<small>
	$ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=mydb';<br>
	$ly->config['database'][0]['user'] = 'db_user';<br>
	$ly->config['database'][0]['password'] = 'P@ssword';<br>
	</small></p>

<p>2. Install modules</p>
	
	<p>Point your browser to following url to prepare modules by creating needed tables in database:</p>
	<p><a href='<?=create_url("modules","install")?>'>modules/install</a></p>

<p>3. Configure meny</p>
	
	<p>Open file "site/config.php" and change second section to define your own items in the menu.</p>

<p>4. Login and finalize</p>
	
	<p>Login to you new website with root/root and setup needed users and access.</p>
	
	<p><a href='<?=create_url("user","login")?>'>user/login</a></p>

	
<b>Extra info</b>
<p>Naming standard is:</p>

    <p>CC* is a controller class.<br>
    CM* is a model class.<br>
    C* is a ordinary class without any specific category.<br>
    I* is interface classes.</p>

<p>Files of interest:</p>
	<p><small>/.htaccess 			- Where you setup installation path of BTH.<br>
	/site/config.php 	- Where you can configure: database connection, menu, logo, titles and footer, activate/deactive modules, customize css-theme-path and avaliable regions.<br>
	/site/themes/xxx	- Where you put your own theme as mentioned in config.php (inherits grid-theme by Default).<br>
	/src/CCxxx			- Create your own controllers then enable/link to them from your menu by setting it up in config.php.</small></p>

