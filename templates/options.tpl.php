<div class="wrap">
  <h2>Limit Posts per Role</h2>
  <div style="float: left; width: 660px; margin: 5px;"> 
    <p>Administrators will always be able to add as many posts as they like.</p>
    <p>Enter <em>-1</em> as a limit for any other role to allow them unlimited posts.</p>

    <form method="post" action="">
      <dl>
      <?php foreach (array_keys($wp_roles->roles) as $role) { ?>
        <dt><label style="font-weight: bold" for="role_limits[<?php echo $role ?>]"><?php echo ucfirst($role) ?></label></dt>
        <?php if ($role == 'administrator') { ?>
          <dd><em>Unlimited</em></dd>
        <?php } else { ?>
          <dd><input value="<?php echo $options['posts_per_role'][$role] ?>" name="role_limits[<?php echo $role ?>]"/></dd>
        <?php } ?>
      <?php } ?>
      </dl>
      <p><input type="submit" name="update_options" value="Update"  style="font-weight:bold;" /></p>
    </form>
  </div>
</div>

