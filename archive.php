<?php get_header(); ?>
      <div class="page-main row">
        <div class="col-md-9 primary-col">
<?php
if (have_posts()):
  the_post();
?>
          <h3 class="main-title"><?php the_date('Y年F'); ?> 的归档</h3>
<?php
rewind_posts();
get_template_part('loop', 'category');
?>
        </div><!-- /.primary-col -->
<?php get_sidebar(); ?>
<?php endif; ?>
      </div><!-- /.page-main -->
<?php get_footer(); ?>