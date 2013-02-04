<h1>Index Controller</h1>
<p>Welcome to the Index Controller (CCIndex - default controller).</p>

<h2>Download</h2>

<p>First, make sure to download the latest version of DannysLydiaMod from github:<p>
<code>git clone git://github.com/dannywap/bth.git</code>

<p>You can review the source directly at <a href="https://github.com/dannywap/bth">https://github.com/dannywap/bth</a></p>

<h2>Installation</h2>

<p>1. Config database connection<br>
Open file <i>"site/config.php"</i> and change first section to give DannysLydiaMod access to your database.</p>

<p>Example:<br>
<small>
$ly->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=mydb';<br>
$ly->config['database'][0]['user'] = 'db_user';<br>
$ly->config['database'][0]['password'] = 'P@ssword';<br>
</small></p>

<p>2. Install modules<br>
Point your browser to following url to prepare modules by creating needed tables in database:<p>

<p><a href='<?=create_url("modules","install")?>'>modules/install</a></p>

<p>3. Configure meny</br>
Open file <i>"site/config.php"</i> and change second section to define your own items in the menu.</p>

<p>4. Login and finilize</br>
Login to you new website with root/root and setup needed users and access.
<p><a href='<?=create_url("user","login")?>'>user/login</a></p>

