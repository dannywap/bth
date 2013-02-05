
<?php if($isAdmin): ?>
	<h1>Admin panel</h1>
	<p>Here you control what users are admins</p>
	<h3>Admins</h3>
	<p>
	<?php foreach($user_list_admins as $val): ?>
		<?php if($val["acronym"]=="root"): ?>
					<?=$val["acronym"]?><br>
		<?php else: ?>
			<?=$val["acronym"]?> <a href='<?=create_url("user","DoRemoveAdmin",$val["acronym"])?>'>Demote</a><br>
		<?php endif; ?>
	<?php endforeach; ?>
	</p>
	<h3>All users</h3>
	<p>
	<?php foreach($user_list_users as $val): ?>
		<?php if($val["acronym"]=="root"): ?>
			<?=$val["acronym"]?><br>
		<?php else: ?>
			<?=$val["acronym"]?> <a href='<?=create_url("user","DoMakeAdmin",$val["acronym"])?>'>Promote</a> <a href='<?=create_url("user","DoDeleteUser",$val["acronym"])?>' onClick="return confirm('Are you sure you want to delete user `<?=$val["acronym"]?>` and his/her contents? This task can not be undone!');">Delete</a><br>
		<?php endif; ?>
	<?php endforeach; ?>
	</p>
	<p>
		<a href='<?=create_url("user","create")?>' title='Create a new user account'>Create new user</a>
	</p>
<?php endif; ?>
	<h1>Create content</h1>
	<p><a href='<?=create_url("content","create")?>'>Create a new page</a><br> 
	<a href='<?=create_url("content","create")?>'>Add a blog post</a><br>
	<small>* To have a Blog in the menu you must enable it under <i>MENU DEFINITIONS</i> in site/config.php.</small></p>
	<p><a href='<?=create_url("content")?>'>View all content</a><p>
	


