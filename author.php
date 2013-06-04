<?php get_header(); ?>
      <div class="main-content row-fluid">
<?php
if (have_posts()):
  the_post();
?>
        <div class="span9 well primary-col">
          <h3 class="main-title">作者 “<?php the_author(); ?>” 的归档</h3>
<?php
rewind_posts();
get_template_part('loop', 'author');
?>
        </div>
<?php get_sidebar(); ?>
<?php endif; ?>
      </div>
      <!-- end of main-content -->
<?php get_footer(); ?>