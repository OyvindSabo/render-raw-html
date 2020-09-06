<div class="wrap">
  <h2><?php echo $pluginDisplayName; ?> &raquo; <?php esc_html_e('Settings', 'render-raw-html');?></h2>
  <?php if (isset($message)) {?>
  <div class="updated fade">
    <p><?php echo $message; ?></p>
  </div>
  <?php }if (isset($errorMessage)) {?>
  <div class="error fade">
    <p><?php echo $errorMessage; ?></p>
  </div>
  <?php }?>

  <div id="poststuff">
    <div id="post-body" class="metabox-holder columns-3">
      <!-- Content -->
      <div id="post-body-content">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div class="postbox">
            <h3 class="hndle"><?php esc_html_e('Settings', 'render-raw-html');?></h3>

            <div class="inside">
              <form action="options-general.php?page=<?php echo $pluginName; ?>" method="post">
                <p>
                  <label for="raw_html_to_render"><strong>Insert HTML below:</strong></label>
                  <textarea name="raw_html_to_render" id="raw_html_to_render" class="widefat" rows="20"
                    style="font-family:Courier New;"><?php echo $settings['raw_html_to_render']; ?></textarea>
                  The HTML inserted above, including scripts and styles, will be returned for all URIs, except for
                  <code>/wp-login.php</code> and <code>/wp-admin/</code>
                </p>
                <?php wp_nonce_field($pluginName, $pluginName . '_nonce');?>
                <p>
                  <input name="submit" type="submit" name="Submit" class="button button-primary"
                    value="<?php esc_attr_e('Save', 'render-raw-html');?>" />
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>