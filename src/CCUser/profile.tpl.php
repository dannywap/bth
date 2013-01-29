<h1>User Profile</h1>

<p>Hello user,<br> 
This is what I known about your profile:</p>

<?php if($is_authenticated): ?>
  <p>User is authenticated.</p>
  <pre><? // =print_r($user, true)?></pre>
  <?=$profile_form?>
<?php else: ?>
  <p>You are anonymous and not authenticated.</p>
<?php endif; ?>

