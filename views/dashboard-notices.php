<?php
/**
 * Notices template
 */
?>
<div class="notice notice-success is-dismissible <?php echo $pluginName; ?>-notice-welcome">
  <p>
    <?php
printf(
    /* translators: %s: Name of this plugin */
    __('Thank you for installing %1$s!', 'render-raw-html'),
    $pluginDisplayName
);?>
    <a href="<?php echo $setting_page; ?>"><?php esc_html_e('Click here', 'render-raw-html');?></a>
    <?php esc_html_e('to configure the plugin.', 'render-raw-html');?>
  </p>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
  $(document).on('click', '.<?php echo $pluginName; ?>-notice-welcome button.notice-dismiss', function(event) {
    event.preventDefault();
    $.post(ajaxurl, {
      action: '<?php echo $pluginName . '
      _dismiss_dashboard_notices '; ?>',
      nonce: '<?php echo wp_create_nonce($pluginName . ' - nonce '); ?>'
    });
    $('.<?php echo $pluginName; ?>-notice-welcome').remove();
  });
});
</script>