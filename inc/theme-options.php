<?php
/**
 * Theme options page.
 *
 * @since Gutspot Theme 1.0
 */


/**
 * Create gutspot theme option menu.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_create_menu() {
  add_submenu_page('themes.php', '主题选项', '主题选项', 'administrator', 'theme_options.php', 'gutspot_settings_page');
  add_action('admin_init', 'gutspot_register_settings');
}
add_action('admin_menu', 'gutspot_create_menu');


/**
 * Register theme settings.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_register_settings() {
  register_setting('gutspot-settings', 'gutspot_analytics');
  register_setting('gutspot-settings', 'gutspot_github_type');
  register_setting('gutspot-settings', 'gutspot_github_login');
  register_setting('gutspot-settings', 'gutspot_hide_wp_version');
  register_setting('gutspot-settings', 'gutspot_hide_pingback');
}


/**
 * Create theme settings page.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_settings_page() {
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>主题选项</h2>
<?php settings_errors(); ?>
<form method="post" action="options.php">
  <?php settings_fields('gutspot-settings'); ?>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row">
          <label for="gutspot_analytics">Google 分析代码</label>
        </th>
        <td>
          <textarea name="gutspot_analytics" id="gutspot_analytics" rows="16" cols="120" class="large-text code"><?php print get_option('gutspot_analytics'); ?></textarea>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">GitHub 账号类型</th>
        <td>
          <label>
            <input type="radio" name="gutspot_github_type" value="user" <?php if (get_option('gutspot_github_type') == 'user') {print "checked";}?> /> 用户
          </label>
          <br />
          <label>
            <input type="radio" name="gutspot_github_type" value="org" <?php if (get_option('gutspot_github_type') == 'org') {print "checked";}?> /> 组织
          </label>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="gutspot_github_login">GitHub 登录名</label>
        </th>
        <td>
          <input type="text" name="gutspot_github_login" class="regular-text" value="<?php print get_option('gutspot_github_login'); ?>" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">隐藏 WordPress 版本</th>
        <td>
          <label for="gutspot_hide_wp_version">
            <input type="checkbox" name="gutspot_hide_wp_version" id="gutspot_hide_wp_version" <?php if (get_option('gutspot_hide_wp_version') == true) {print "checked";} ?> /> 启用
          </label>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">隐藏 Pingback 链接</th>
        <td>
          <label for="gutspot_hide_pingback">
            <input type="checkbox" name="gutspot_hide_pingback" id="gutspot_hide_pingback" <?php if (get_option('gutspot_hide_pingback') == true) {print "checked";} ?> /> 启用
          </label>
        </td>
      </tr>
    </tbody>
  </table>
  <p class="submit">
    <input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改" />
  </p>
</form>
</div>
<?php
}
?>