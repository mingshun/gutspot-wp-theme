<?php get_header(); ?>
      <div class="main-content row-fluid">
<?php if (have_posts()): ?>
        <div class="span9 well primary-col">
<?php get_template_part('loop', 'index'); ?>
        </div>
<?php get_sidebar(); ?>
<?php else: ?>
        <div class="span12 well">
          <h3 class="main-title">抱歉，找不到您所访问的内容！</h3>
          <p class="main-description">您可以尝试搜索想要看的内容：</p>
<?php get_search_form(); ?>
        </div>
<?php endif; ?>
      </div>
      <!-- end of main-content -->
<?php get_footer(); ?>