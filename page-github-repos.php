<?php get_header(); ?>
      <div class="page-main row">
        <div id="repos" data-github-type="<?php print get_option('gutspot_github_type'); ?>" data-github-login="<?php print get_option('gutspot_github_login'); ?>">
          <div id="github-loading">
            <div class="outer-circle"></div>
            <div class="inner-circle"></div>
          </div>
        </div>
      </div><!-- /.page-main -->
<?php get_footer(); ?>