<?php
  if (!current_user_can('activate_plugins')) {
    wp_die(__('Not enough permissions', 'website-popups'));
  }

  $token = WishpondUtilities::get_auth_token();

  global $error_message;
  $error = $error_message;
?>

<?php if (!empty($error) && $error): ?>
  <div class='error'><p><?php echo $error; ?></p></div>
<?php else: ?>
  <div class='wrap wishpond_iframe_container'>
    <iframe id='wishpond_iframe' src='<?php echo WishpondUtilities::build_action_url('editor', $token); ?>'></iframe>
  </div>
<?php endif; ?>
