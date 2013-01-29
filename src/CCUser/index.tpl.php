<h1>User Index</h1>
<ul>
  <li><a href='<?=create_url(null, 'init')?>'>Init database, create tables and create default admin user</a>
</ul>
<p>This is what is known on the current user.</p>

<?php if($is_authenticated): ?>
  <p>User is authenticated.</p>
  <pre><?=print_r($user, true)?></pre>
<?php else: ?>
  <p>User is anonymous and not authenticated.</p>
<?php endif; ?>
