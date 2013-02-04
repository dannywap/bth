<?php if($content['id']):?>
	<h1><?=$content['title']?></h1>
	<p><?=filter_data($content['data'], $content['filter'])?></p>
	<?php if(CLydia::Instance()->user['isAuthenticated'] && (CLydia::Instance()->user['hasRoleAdmin'] || $content['owner']==CLydia::Instance()->user['acronym'])): ?>
		<p class='smaller-text silent'><a href='<?=create_url("content/edit/{$content['id']}")?>'>edit</a> 
	<?php endif ?>
	<a href='<?=create_url("content")?>'>view all</a></p>
<?php else:?>
	<p>404: No such page exists.</p>
<?php endif;?>