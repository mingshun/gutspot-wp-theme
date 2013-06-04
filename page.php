<?php get_header(); ?>
      <div class="main-content row-fluid">
<?php if (have_posts()): ?>
        <div class="span9 well primary-col">
<?php while (have_posts()): the_post(); ?>
          <article <?php post_class('entry-post'); ?> id="post-<?php the_ID(); ?>">
            <header class="entry-header">
              <h4 class="entry-title"><?php the_title(); ?></h4>
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
        </div>
<?php get_sidebar(); ?>
<?php endif; ?>
      </div>
      <!-- end of main-content -->
<?php get_footer(); ?>