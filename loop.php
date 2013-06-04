<?php while (have_posts()): the_post(); ?>
          <article <?php post_class('entry-post'); ?> id="post-<?php the_ID(); ?>">
            <header class="entry-header">
              <h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
              <h5 class="entry-details">
                <i title="发布时间" class="icon-calendar"></i><time ref="date"><?php the_time('Y-m-d H:i:s')?></time>
                &nbsp;&nbsp;&nbsp;
                <i title="作者" class="icon-user"></i><?php the_author_posts_link(); ?>
                <br />
                <i title="分类" class="icon-bookmark"></i><?php the_category(' > '); ?>
                <?php the_tags('<br /><i title="标签" class="icon-tag"></i>', ', ');?>
              </h5>
            </header>
            <div class="entry-content clearfix">
<?php the_excerpt(); ?>
              <p class="read-more"><a ref="nofollow" href="<?php the_permalink(); ?>" class="btn btn-primary btn-small">阅读全文<i class="icon-hand-right"></i></a></p>
            </div>
            <!-- end of entry-content -->
          </article>
<?php endwhile; ?>
          <ul class="pager">
            <li class="previous"><?php previous_posts_link('<i class="icon-circle-arrow-left"></i>上一页'); ?></li>
            <li class="next"><?php next_posts_link('下一页<i class="icon-circle-arrow-right"></i>'); ?></li>
          </ul>
