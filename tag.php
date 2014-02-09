<?php get_header(); ?>
      <div class="page-main row">
<?php if (have_posts()): ?>
        <div class="col-md-9 primary-col">
          <h3 class="main-title">标签 “<?php single_term_title('', true); ?>” 的归档</h3>
<?php get_template_part('loop', 'index'); ?>
        </div><!-- /.primary-col -->
<?php get_sidebar(); ?>
<?php endif; ?>
      </div><!-- /.page-main -->
<?php get_footer(); ?>