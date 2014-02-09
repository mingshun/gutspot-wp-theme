<?php get_header(); ?>
      <div class="page-main row">
        <div class="col-md-9 primary-col">
<?php if (have_posts()): ?>
          <h3 class="main-title">包含 “<?php the_search_query(); ?>” 的搜索结果：</h3>
<?php get_template_part('loop', 'search'); ?>
<?php else: ?>
          <h3 class="main-title">没有搜索结果！</h3>
          <p class="main-description">没有找到与 “<?php echo $_REQUEST['s']; ?>” 相关的内容。请尝试搜索其他内容：</p>
<?php get_search_form(); ?>
<?php endif; ?>
        </div><!-- /.primary-col -->
<?php get_sidebar(); ?>
      </div><!-- /.page-main -->
<?php get_footer(); ?>