<h1>User Index</h1>
<?php if($is_authenticated): ?>
  <p>This is what is known on the current user.</p>
  <p>User is authenticated.</p>
  <pre><?=print_r($user, true)?></pre>
<?php else: ?>
  <p>Please <a href='<?=create_url("user","login")?>'>login</a> first.</p>
<?php endif; ?>
