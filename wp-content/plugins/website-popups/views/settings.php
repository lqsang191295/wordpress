<?php
  if (!current_user_can('activate_plugins')) {
    wp_die(__('Not enough permissions', 'website-popups'));
  }

  $token = WishpondUtilities::get_auth_token();

  global $error_message;
  global $notice_message;

  $error  = $error_message;
  $notice = $notice_message;
?>

<div class='wrap'>
  <?php screen_icon(); ?>

  <?php if (!empty($error) && $error): ?>
    <div class='error'><p><?php echo $error; ?></p></div>
  <?php endif; ?>

  <?php if (!empty($notice) && $notice): ?>
    <div class='updated'><p><?php echo $notice; ?></p></div>
  <?php endif; ?>

  <h2><?php _e('Settings', 'website-popups')?></h2>

  <?php if (isset($token)): ?>
    <form method='post' action=''>
      <h3><?php _e('Wishpond Wordpress Token: ', 'website-popups'); ?><small><?php echo $token; ?></small></h3>

      <hr>

      <p><strong><?php _e('Update Token: ', 'website-popups'); ?></strong></p>
      <input class='regular-text' type='text' name='token' value='<?php echo $token ?>'/>
      <br>

      <?php submit_button(); ?>
    </form>
  <?php endif; ?>
</div>
