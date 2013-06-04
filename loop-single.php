<?php while (have_posts()): the_post(); ?>
          <article <?php post_class('entry-post'); ?> id="post-<?php the_ID(); ?>">
            <header class="entry-header">
              <h4 class="entry-title"><?php the_title(); ?><?php edit_post_link('&nbsp;&nbsp;&nbsp;<i class="icon-edit-sign"></i>'); ?></h4>
              <h5 class="entry-details">
                <i title="发布时间" class="icon-calendar"></i><time ref="date"><?php the_time('Y-m-d H:i:s')?></time>
                &nbsp;&nbsp;&nbsp;
                <i title="作者" class="icon-user"></i><?php the_author_posts_link(); ?>
                &nbsp;&nbsp;&nbsp;
                <i title="评论" class="icon-comment"></i><?php comments_popup_link('没有评论', '1 条评论', '% 条评论'); ?>
                <br />
                <i title="分类" class="icon-bookmark"></i><?php the_category(' > '); ?>
                <?php the_tags('<br /><i title="标签" class="icon-tag"></i>', ', ');?>
              </h5>
            </header>
            <div class="entry-content clearfix">
<?php the_content(); ?>
            </div>
            <!-- end of entry-content -->
          </article>
<?php comments_template('', true); ?>
<?php endwhile; ?>