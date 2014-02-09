<?php get_header(); ?>
      <div class="page-main row">
        <div class="col-md-9 primary-col">
<?php
if (have_posts()):
  the_post();
?>
          <h3 class="main-title">作者 “<?php the_author(); ?>” 的归档</h3>
<?php
rewind_posts();
get_template_part('loop', 'author');
?>
        </div><!-- /.primary-col -->
<?php get_sidebar(); ?>
<?php endif; ?>
      </div><!-- /.page-main -->
<?php get_footer(); ?>