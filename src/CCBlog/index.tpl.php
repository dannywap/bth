<h1>Blog</h1>
<p>Order by <a href='<?=create_url("blog","index","id")?>'>id</a>, <a href='<?=create_url("blog","index","title")?>'>title</a>, <a href='<?=create_url("blog","index","owner")?>'>owner</a>, <a href='<?=create_url("blog","index","created")?>'>created</a>, <a href='<?=create_url("blog","index")?>'>default</a></p>

<?php if($contents != null):?>
  <?php foreach($contents as $val):?>
    <h2><?=esc($val['title'])?></h2>
    <p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
    <p><?=filter_data($val['data'], $val['filter'])?></p>
    <?php if(CLydia::Instance()->user['isAuthenticated'] && (CLydia::Instance()->user['hasRoleAdmin'] || $val['owner']==CLydia::Instance()->user['acronym'])): ?>
		<p class='smaller-text silent'><a href='<?=create_url("content/edit/{$val['id']}")?>'>edit</a></p>
	<?php endif; ?>
  <?php endforeach; ?>
<?php else:?>
  <p>No posts exists.</p>
<?php endif;?>