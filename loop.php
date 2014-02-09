<?php while (have_posts()): the_post(); ?>
          <article <?php post_class('entry-post'); ?> id="post-<?php the_ID(); ?>">
            <header class="entry-header">
              <h4 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                  <?php the_title(); ?>
                </a>
              </h4>
              <h5 class="entry-details">
                <p>
                  <span class="entry-details-item">
                    <i title="发布时间" class="fa fa-calendar-o fa-fw"></i> <time ref="date"><?php the_time('Y-m-d H:i:s')?></time>
                  </span>
                  <span class="entry-details-item">
                    <i title="作者" class="fa fa-user fa-fw"></i> <?php the_author_posts_link(); ?>
                  </span>
                  <span class="entry-details-item">
                    <i title="评论" class="fa fa-comments-o fa-fw"></i> <?php comments_popup_link('没有评论', '1 条评论', '% 条评论'); ?>
                  </span>
                </p>
                <p>
                  <span class="entry-details-item">
                    <i title="分类" class="fa fa-bookmark fa-fw"></i> <?php the_category(' > '); ?>
                  </span>
                  <span class="entry-details-item">
                    <?php the_tags('<i title="标签" class="fa fa-tag fa-fw"></i>', ', ');?>
                  </span>
                </p>
              </h5>
            </header>
            <div class="entry-content clearfix">
<?php the_excerpt(); ?>
              <p class="read-more pull-right">
                <a href="<?php the_permalink(); ?>" ref="nofollow">
                  阅读全文<i class="fa fa-chevron-right fa-fw"></i>
                </a>
              </p>
            </div>
            <!-- end of entry-content -->
          </article>
<?php endwhile; ?>
          <ul class="pager">
            <li class="previous"><?php previous_posts_link('<i class="fa fa-arrow-left fa-fw"></i>上一页'); ?></li>
            <li class="next"><?php next_posts_link('下一页<i class="fa fa-arrow-right fa-fw"></i>'); ?></li>
          </ul>
