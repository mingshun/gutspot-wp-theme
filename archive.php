<?php get_header(); ?>
      <div class="main-content row-fluid">
<?php
if (have_posts()):
  the_post();
?>
        <div class="span9 well primary-col">
          <h3 class="main-title"><?php the_date('Y年F'); ?> 的归档</h3>
<?php
rewind_posts();
get_template_part('loop', 'category');
?>
        </div>
<?php get_sidebar(); ?>
<?php endif; ?>
      </div>
      <!-- end of main-content -->
<?php get_footer(); ?>