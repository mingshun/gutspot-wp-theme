<?php get_header(); ?>
      <div class="main-content row-fluid">
<?php if (have_posts()): ?>
        <div class="span9 well primary-col">
          <h3 class="main-title">标签 “<?php single_term_title('', true); ?>” 的归档</h3>
<?php get_template_part('loop', 'index'); ?>
        </div>
<?php get_sidebar(); ?>
<?php endif; ?>
      </div>
      <!-- end of main-content -->
<?php get_footer(); ?>