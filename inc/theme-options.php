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
  add_submenu_page('themes.php', 'Gutspot 主题功能配置', '配置', 'administrator', 'theme_options.php', 'gutspot_settings_page');
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
  register_setting('gutspot-settings', 'gutspot_enable_prettify');
  register_setting('gutspot-settings', 'gutspot_github_type');
  register_setting('gutspot-settings', 'gutspot_github_login');
}


/**
 * Create theme settings page.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_settings_page() {
?>
<div class="wrap">
<h2>Gutspot 主题功能配置</h2>
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
        <th scope="row">Prettify 代码高亮显示</th>
        <td>
          <label for="gutspot_enable_prettify">
            <input type="checkbox" name="gutspot_enable_prettify" id="gutspot_enable_prettify" <?php if (get_option('gutspot_enable_prettify') == true) {print "checked";} ?> /> 启用
          </label>
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