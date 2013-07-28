<?php
/**
 * Gutspot Theme functions and definitions.
 *
 * @package Gutspot
 * @since Gutspot Theme 1.0
 */


/**
 * Import Bootstrap navigation menu implementation.
 */
require_once('inc/bootstrap-navigation-menu.php');


/**
 * Import theme option theme options page.
 */
require_once('inc/theme-options.php');


/**
 * Import obfuscation encoder.
 */
require_once('inc/obfuscation.php');


/**
 * Sets up theme defaults and registers WordPress features.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_setup() {
  // This theme uses wp_nav_menu() in one location.
  register_nav_menu('primary', 'Bootstrap Navigation Menu');

  // Define sidebar style.
  register_sidebar(array(
    'name'            => 'Primary Sidebar',
    'id'              => 'primary-widget',
    'description'     => 'The primary widget',
    'class'           => 'classsdsd',
    'before_widget'   => '<div class="well widget-container">',
    'after_widget'    => '</div>',
    'before_title'    => '<h4 class="widget-title">',
    'after_title'     => '</h4>'
 ));
}
add_action('after_setup_theme', 'gutspot_setup');


/**
 * Custom excerpt length to 200 charactors.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_excerpt_length($length) {
  return 200;
}
add_filter('excerpt_length', 'gutspot_excerpt_length');


/**
 * Custom get_comment_reply_link function.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_get_comment_reply_link($args = array(), $comment = null, $post = null) {
  global $user_ID;

  $defaults = array(
    'add_below' => 'comment',
    'respond_id' => 'respond',
    'reply_text' => __('Reply'),
    'login_text' => __('Log in to Reply'),
    'depth' => 0,
    'before' => '',
    'after' => ''
 );

  $args = wp_parse_args($args, $defaults);

  if (0 == $args['depth'] || $args['max_depth'] <= $args['depth']) {
    return;
  }

  extract($args, EXTR_SKIP);

  $comment = get_comment($comment);
  if (empty($post)) {
    $post = $comment->comment_post_ID;
  }
  $post = get_post($post);

  if (!comments_open($post->ID)) {
    return false;
  }

  $link = '';
  if (get_option('comment_registration') && !$user_ID) {
    $link = '<a rel="nofollow" class="comment-reply-login btn btn-primary reply-button" href="' . esc_url(wp_login_url(get_permalink())) . '">' . $login_text . '</a>';
  } else {
    $link = "<a class='comment-reply-link btn btn-primary reply-button' href='" . esc_url(add_query_arg('replytocom', $comment->comment_ID)) . "#" . $respond_id . "' onclick='return addComment.moveForm(\"$add_below-$comment->comment_ID\", \"$comment->comment_ID\", \"$respond_id\", \"$post->ID\")'>$reply_text</a>";
  }

  return apply_filters('comment_reply_link', $before . $link . $after, $args, $comment, $post);
}


/**
 * Custom comment_form function.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_comment_form($args = array(), $post_id = null) {
  global $id;

  if (null === $post_id) {
    $post_id = $id;
  } else {
    $id = $post_id;
  }

  $commenter = wp_get_current_commenter();
  $user = wp_get_current_user();
  $user_identity = $user->exists() ? $user->display_name : '';

  $req = get_option('require_name_email');
  $aria_req = ($req ? " aria-required='true'" : '');
  $fields =  array(
    'author' => '<p class="comment-form-author">' . '<label for="author">' . __('Name') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
    'email'  => '<p class="comment-form-email"><label for="email">' . __('Email') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
                '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
    'url'    => '<p class="comment-form-url"><label for="url">' . __('Website') . '</label>' .
                '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>',
 );

  $required_text = sprintf(' ' . __('Required fields are marked %s'), '<span class="required">*</span>');
  $defaults = array(
    'fields'               => apply_filters('comment_form_default_fields', $fields),
    'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun') . '</label><textarea id="comment" name="comment" rows="2" aria-required="true"></textarea></p>',
    'must_log_in'          => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
    'logged_in_as'         => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
    'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.') . ($req ? $required_text : '') . '</p>',
    'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s'), ' <code>' . allowed_tags() . '</code>') . '</p>',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit',
    'title_reply'          => __('Leave a Reply'),
    'title_reply_to'       => __('Leave a Reply to %s'),
    'cancel_reply_link'    => __('Cancel reply'),
    'label_submit'         => __('Post Comment'),
 );

  $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));

  ?>
    <?php if (comments_open($post_id)) : ?>
      <?php do_action('comment_form_before'); ?>
      <div id="respond">
        <h4 id="reply-title"><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?> <small><?php cancel_comment_reply_link($args['cancel_reply_link']); ?></small></h4>
        <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
          <?php echo $args['must_log_in']; ?>
          <?php do_action('comment_form_must_log_in_after'); ?>
        <?php else : ?>
          <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>">
            <?php do_action('comment_form_top'); ?>
            <?php if (is_user_logged_in()) : ?>
              <?php echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity); ?>
              <?php do_action('comment_form_logged_in_after', $commenter, $user_identity); ?>
            <?php else : ?>
              <?php echo $args['comment_notes_before']; ?>
              <?php
              do_action('comment_form_before_fields');
              foreach ((array) $args['fields'] as $name => $field) {
                echo apply_filters("comment_form_field_{$name}", $field) . "\n";
              }
              do_action('comment_form_after_fields');
              ?>
            <?php endif; ?>
            <?php echo apply_filters('comment_form_field_comment', $args['comment_field']); ?>
            <?php echo $args['comment_notes_after']; ?>
            <p class="form-submit">
              <input name="submit" type="submit" class="btn btn-primary" id="<?php echo esc_attr($args['id_submit']); ?>" value="<?php echo esc_attr($args['label_submit']); ?>" />
              <?php comment_id_fields($post_id); ?>
            </p>
            <?php do_action('comment_form', $post_id); ?>
          </form>
        <?php endif; ?>
      </div><!-- #respond -->
      <?php do_action('comment_form_after'); ?>
    <?php else : ?>
      <?php do_action('comment_form_comments_closed'); ?>
    <?php endif; ?>
  <?php
}


/**
 * Used as a callback by wp_list_comments() for diaplaying the comments.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  switch ($comment->comment_type):
    case 'pingback':
    ?>
    <li <?php comment_class(); ?> id="pingback-<?php comment_ID(); ?>">
      <p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link('(编辑)', '<span class="comment-edit-link">', '</span>'); ?></p>
    <?php
        break;
    case 'trackback':
    ?>
    <li <?php comment_class(); ?> id="trackback-<?php comment_ID(); ?>">
      <p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link('(编辑)', '<span class="comment-edit-link">', '</span>'); ?></p>
    <?php
        break;
      default:
      global $post;
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <article>
        <div ref="avatar" class="avatar pull-left">
          <?php echo get_avatar($comment, 40); ?>
        </div>
        <div class="comment-body">
          <header>
            <span ref="publisher" class="comment-publisher"><?php comment_author_link(); ?></span>
            <?php if ($comment->user_id === $post->post_author): ?>
            <span class="post-author">主人</span>
            <?php endif; ?>
            <span class="bullet">•</span>
            <span ref="date" class="comment-date"><?php comment_time('Y-m-d H:i'); ?></span>
          </header>
          <div class="comment-content">
            <?php comment_text(); ?>
          </div>
        </div>
        <div class="reply-container pull-right">
          <?php echo gutspot_get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>
        <div class="clearfix"></div>
      </article>
    <?php
        break;
  endswitch;
}


/**
 * Load theme stylesheet and javascript files on init.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_styles_scripts() {
  if (!is_admin()) {
    wp_enqueue_style('bootstrap', get_bloginfo('template_url') . '/stylesheets/bootstrap.min.css', array(), '2.3.1', 'all');
    wp_enqueue_style('bootstrap-responsive', get_bloginfo('template_url') . '/stylesheets/bootstrap-responsive.min.css', array('bootstrap'), '2.3.1', 'all');
    wp_enqueue_style('font-awesome', get_bloginfo('template_url') . '/stylesheets/font-awesome.min.css', array('bootstrap'), '3.1.0', 'all');
    wp_enqueue_style('docs', get_bloginfo('template_url') . '/stylesheets/docs.css', array('bootstrap', 'font-awesome'), '1.0.0', 'all');

    wp_deregister_script('jquery');
    wp_register_script('jquery', get_bloginfo('template_url') . '/javascripts/jquery.min.js', array(), '1.9.1', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/javascripts/jquery-ui.custom.min.js', array('jquery'), '1.10.2', true);
    wp_enqueue_script('jquery.smooth-scroll', get_bloginfo('template_url') . '/javascripts/jquery.smooth-scroll.min.js', array('jquery'), '1.4.10', true);
    wp_enqueue_script('bootstrap', get_bloginfo('template_url') . '/javascripts/bootstrap.min.js', array('jquery'), '2.3.1', true);
    wp_enqueue_script('application', get_bloginfo('template_url') . '/javascripts/application.js', array('jquery-ui', 'jquery.smooth-scroll', 'bootstrap'), '1.0.0', true);
  }
}
add_action('init', 'gutspot_styles_scripts');


/**
 * Loas prettify stylesheet and jacascript files.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_code_prettify_styles_scripts() {
  if (!is_admin() && get_option('gutspot_enable_prettify') && is_single()) {
    wp_enqueue_style('prettify', get_bloginfo('template_url') . '/stylesheets/prettify.css', array(), '1.0.0', 'all');

    wp_enqueue_script('prettify', get_bloginfo('template_url') . '/javascripts/prettify/prettify.js', array('jquery'), '4_mar_2013', true);
    wp_deregister_script('swfobject');
    wp_register_script('swfobject', get_bloginfo('template_url') . '/javascripts/swfobject/swfobject.js', array(), '2.2', true);
    wp_enqueue_script('swfobject');
    wp_enqueue_script('jquery.zclip', get_bloginfo('template_url') . '/javascripts/zclip/jquery.zclip.min.js', array('jquery'), '1.1.1', true);
    wp_enqueue_script('enable-prettify', get_bloginfo('template_url') . '/javascripts/enable-prettify.js', array('prettify', 'swfobject', 'jquery.zclip'), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'gutspot_code_prettify_styles_scripts');


/**
 * Set template directory for reference to load resources from within javascript files.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_set_template_dir() {
  if (!is_admin() && get_option('gutspot_enable_prettify') && is_single()): ?>
<script type="text/javascript">
  var templateDir = '<?php bloginfo("template_directory") ?>';
</script>
<?php 
  endif;
}
add_action('wp_footer', 'gutspot_set_template_dir');


/**
 * Load github repository page stylesheet and javascript files.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_github_repos_page_styles_scripts() {
  if (!is_admin() && basename(get_page_template()) == 'page-github-repos.php') {
    wp_enqueue_style('github-repos', get_bloginfo('template_url') . '/stylesheets/github-repos.css', array(), '1.0.0', 'all');

    wp_enqueue_script('github-repos', get_bloginfo('template_url') . '/javascripts/github-repos.js', array('jquery'), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'gutspot_github_repos_page_styles_scripts');


// Remove Wordpress version number
remove_action('wp_head', 'wp_generator');
function gutspot_remove_version() {
  return '';
}
add_filter('the_generator', 'gutspot_remove_version');
?>