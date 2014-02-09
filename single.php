<?php get_header(); ?>
      <div class="page-main row">
<?php if (have_posts()): ?>
        <div class="col-md-9 primary-col">
<?php get_template_part('loop', 'single'); ?>
        </div><!-- /.primary-col -->
<?php get_sidebar(); ?>
<?php endif; ?>
      </div><!-- /.page-main -->
<?php get_footer(); ?>