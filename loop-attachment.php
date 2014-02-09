<?php while (have_posts()): the_post(); ?>
          <?php if (!empty($post->post_parent)): ?>
          <p class="meta-nav"><a href="<?php echo get_permalink($post->post_parent); ?>" title="返回 <?php echo strip_tags(get_the_title($psot->post_parent)); ?>" rel="gallery"><i class="icon-arrow-left"></i><?php echo get_the_title($post->post_parent); ?></a></p>
          <?php endif; ?>
          <article <?php post_class('entry-post'); ?> id="post-<?php the_ID(); ?>">
            <header class="entry-header">
              <h3 class="entry-title">
                <?php edit_post_link('<i class="fa fa-lg fa-fw fa-edit"></i>'); ?>
                附件：<?php the_title(); ?>
              </h3>
              <h5 class="entry-details">
                <p>
                  <span class="entry-details-item">
                    <i title="发布时间" class="fa fa-calendar-o fa-fw"></i> <time ref="date"><?php the_time('Y-m-d H:i:s')?></time>
                  </span>
                  <span class="entry-details-item">
                    <i title="作者" class="fa fa-user fa-fw"></i> <?php the_author_posts_link(); ?>
                  </span>
                </p>
              </h5>
            </header>
            <div class="entry-content clearfix">
              <p class="entry-caption">
                <?php if (!empty($post->post_parent)) the_excerpt(); ?>
              </p>
              <?php if (wp_attachment_is_image()): 
                $attachments = array_values(get_children(array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID')));
                  foreach ($attachments as $k => $attachment) {
                    if ($attachment->ID == $post->ID) {
                      break;
                    }
                  }
                  $k++;
                  if (count($attachments) > 1) {
                    if (isset($attachments[$k])) {
                      $next_attachment_url = get_attachment_link($attachments[$k]->ID);
                    } else {
                      $next_attachment_url = get_attachment_link($attachments[0]->ID);
                    }
                  } else {
                    $next_attachment_url = wp_get_attachment_url();
                  }
              ?>
              <p class="attachment">
                <a href="<?php echo $next_attachment_url; ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
                <?php
                  echo wp_get_attachment_image($post->ID, array(800, 800));
                ?>
                </a>
              </p>
              <ul class="pager">
                <li class="previous"><?php previous_image_link(0, '<i class="fa fa-arrow-left fa-fw"></i>上一张'); ?></li>
                <li class="next"><?php next_image_link(0, '下一张<i class="fa fa-arrow-right fa-fw"></i>'); ?></li>
              </ul>
              <?php else: ?>
              <p>
                <a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">下载附件</a>
              </p>
              <?php endif; ?>
            </div>
            <!-- end of entry-content -->
          </article>
<?php comments_template('', true); ?>
<?php endwhile; ?>