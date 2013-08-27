<?php get_header(); ?>
      <div class="main-content row-fluid">
        <div id="repos" data-github-type="<?php print get_option('gutspot_github_type'); ?>" data-github-login="<?php print get_option('gutspot_github_login'); ?>">
          <div class="row-fluid">
            <div id="github-loading">
              <div class="outer-circle"></div>
              <div class="inner-circle"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- end of main-content -->
<?php get_footer(); ?>