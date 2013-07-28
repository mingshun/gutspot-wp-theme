<?php
/**
 * The template for displaying Comments.
 *
 * @package Gutspot
 * @since Gutspot Theme 1.0
 */


if (post_password_required()) {
  return;
}
?>


<?php if (have_comments()): ?>
<hr>
<div id="comments">
  <h4 class="comment-title">
    <?php comments_number('0 条评论', '1 条评论', '% 条评论'); ?>
  </h4>

  <ul class="comment-list">
    <?php wp_list_comments(array('callback' => 'cutsom_comment')); ?>
  </ul>
  <!-- end of comment list -->

  <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    <ul class="pager">
      <li class="previous"><?php previous_comments_link('<i class="icon-circle-arrow-left"></i>上一页'); ?></li>
      <li class="next"><?php next_comments_link('下一页<i class="icon-circle-arrow-right"></i>'); ?></li>
    </ul>
  <?php endif; ?>
</div>
<?php endif; ?>

<hr>
<?php gutspot_comment_form(); ?>

