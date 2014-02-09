<?php get_header(); ?>
      <div class="page-main row">
<?php if (have_posts()): ?>
        <div class="col-md-9 primary-col">
<?php while (have_posts()): the_post(); ?>
          <article <?php post_class('entry-post'); ?> id="post-<?php the_ID(); ?>">
            <header class="entry-header">
              <h3 class="entry-title"><?php the_title(); ?></h3>
            </header>
            <div class="entry-content clearfix">
<?php the_content(); ?>
            </div>
            <!-- end of entry-content -->
          </article>
          <div class="comments">
<?php comments_template(); ?>
          </div>
<?php endwhile; ?>
        </div><!-- /.primary-col -->
<?php get_sidebar(); ?>
<?php endif; ?>
      </div><!-- /.page-main -->
<?php get_footer(); ?>