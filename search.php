<?php get_header(); ?>
      <div class="main-content row-fluid">
<?php if (have_posts()): ?>
        <div class="span9 well primary-col">
          <h3 class="main-title">包含 “<?php the_search_query(); ?>” 的搜索结果：</h3>
<?php get_template_part('loop', 'search'); ?>
        </div>
<?php get_sidebar(); ?>
<?php else: ?>
        <div class="span12 well">
          <h3 class="main-title">没有搜索结果！</h3>
          <p class="main-description">没有找到与 “<?php echo $_REQUEST['s']; ?>” 相关的内容，请尝试搜索其他内容：</p>
<?php get_search_form(); ?>
        </div>
<?php endif; ?>
      </div>
      <!-- end of main-content -->
<?php get_footer(); ?>