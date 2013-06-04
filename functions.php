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
function custom_excerpt_length($length) {
  return 200;
}
add_filter('excerpt_length', 'custom_excerpt_length');


/**
 * Custom get_comment_reply_link function.
 *
 * @since Gutspot Theme 1.0
 */
function custom_get_comment_reply_link($args = array(), $comment = null, $post = null) {
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
function custom_comment_form($args = array(), $post_id = null) {
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
function cutsom_comment($comment, $args, $depth) {
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
          <?php echo custom_get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>
        <div class="clearfix"></div>
      </article>
    <?php
        break;
  endswitch;
}


/**
 * wp_head hook for enable prettify code highlight.
 *
 * @since Gutspot Theme 1.0
 */
function enable_prettify_wp_head() {
  if (get_option('gutspot_enable_prettify')):?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/stylesheets/prettify.css" />
<?php 
  endif;
}
add_action('wp_head', 'enable_prettify_wp_head');


/**
 * wp_foot hook for enable prettify code highlight.
 *
 * @since Gutspot Theme 1.0
 */
function enable_prettify_wp_foot() {
  if (get_option('gutspot_enable_prettify')):?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/prettify/prettify.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/swfobject/swfobject.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/zclip/jquery.zclip.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/enable-prettify.js"></script>
<?php 
  endif;
}
add_action('wp_footer', 'enable_prettify_wp_foot');
?>