<h1>Guestbook</h1>
<p>Please post in our guestbook</p>

<form action="<?=$form_action?>" method='post'>
  <p>
    <label>Message: <br/>
    <textarea name='newEntry'></textarea></label>
  </p>
  <p>
    <input type='submit' name='doAdd' value='Add message' />
	<?php if(CLydia::Instance()->user['isAuthenticated'] && CLydia::Instance()->user['hasRoleAdministrator']): ?>
		<input type='submit' name='doClear' value='Clear all messages' />
	<?php endif; ?>
    <!--<input type='submit' name='doCreate' value='Create database table' /> -->
  </p>
</form>

<h2>Current messages</h2>

<?php foreach($entries as $val):?>
<div style='background-color:#f6f6f6;border:1px solid #ccc;margin-bottom:1em;padding:1em;'>
  <p>At: <?=$val['created']?></p>
  <p><?=htmlent($val['entry'])?></p>
</div>
<?php endforeach;?>
