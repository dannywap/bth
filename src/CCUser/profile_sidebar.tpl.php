
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
<?php else: ?>
	<h1>Your posts</h1>
	<p>Hello user,<br> 
	This is what I known about your profile:</p>

	<p>You are anonymous and not authenticated.</p>
<?php endif; ?>

