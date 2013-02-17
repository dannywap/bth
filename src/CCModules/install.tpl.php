<h1>Install modules</h1>
	<p>The following modules were affected by this action.</p>

	<table>
	<caption>Results from installing modules.</caption>
	<thead>
	  <tr><th>Module</th><th>Result</th></tr>
	</thead>
	<tbody>
		<?php foreach($modules as $module): 
			if($module['result'][0]<>'success'){$result_total='failed';}
		?>
		  <tr><td><?=$module['name']?></td><td><div class='<?=$module['result'][0]?>'><?=$module['result'][1]?></div></td></tr>
		<?php endforeach; ?>
		<?php 
			 if(!isset($result_total)){
				// Rename not_installed.flag to installed.flag so that CCMenu can start reading DB.
				if(file_exists(LYDIA_INSTALL_PATH.'/site/data/not_installed.flag')){rename(LYDIA_INSTALL_PATH.'/site/data/not_installed.flag',LYDIA_INSTALL_PATH.'/site/data/installed.flag');}
				// Rename old CCIndex/Index.tpl.php and create a new nicer one.
				// $result_rename=rename(LYDIA_INSTALL_PATH.'/src/CCIndex/index.tpl.php',LYDIA_INSTALL_PATH.'/src/CCIndex/index.tpl_can_be_deleted.php');
				// $result_create_new=1;
				// $myFile = LYDIA_INSTALL_PATH.'/src/CCIndex/index.tpl.php';
				// $fh = fopen($myFile, 'w') or $result_create_new=-1;
				// $stringData = '<h1>My own website</h1><p>You have now successfully installed the BTH-framework and can start by editing this page (/src/CCIndex/index.tpl).</p>
				// <p>But take some time to look around and learn the features before you start! ;)</p>
				// <p>If you need any additional information have a look at README.md in root of project.</p>
				// <a href="user/login")}><h3>Login</h3>';
				// fwrite($fh, $stringData);
				// fclose($fh);
				// if($result_rename && $result_create_new) : 
			?>
					<!--<tr><td>CCIndex</td><td><div class='success'>Successfully renamed CCIndex\index.tpl.php and created new for you</div></td></tr> -->
			    <!-- // else: -->
				   <!-- <tr><td>CCIndex</td><td><div class='information'>Please now also update component CCIndex to become a more personal startpage.</div></td></tr> -->
				<!--// endif; -->
					<tr><td colspan=2><div><br><a href="<?=create_url()?>"><h2>Get started >></h2></a></div></td></tr>		
			<?php } ?>
	</tbody>
	</table>
