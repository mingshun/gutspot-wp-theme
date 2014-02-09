<?php get_header(); ?>
      <div class="page-main row">
        <div class="col-md-9 primary-col">
<?php if (have_posts()): ?>
<?php get_template_part('loop', 'index'); ?>
<?php else: ?>
          <h3 class="main-title">抱歉，找不到您所访问的内容！</h3>
          <p class="main-description">您可以尝试搜索想要看的内容：</p>
<?php get_search_form(); ?>
<?php endif; ?>
        </div><!-- /.primary-col -->
<?php get_sidebar(); ?>
      </div><!-- /.page-main -->
<?php get_footer(); ?>