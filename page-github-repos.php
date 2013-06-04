<?php get_header(); ?>
      <div class="main-content row-fluid">
        <div id="repos" data-github-type="<?php print get_option('gutspot_github_type'); ?>" data-github-login="<?php print get_option('gutspot_github_login'); ?>">
          <div class="row-fluid">
            <p class="text-center">
              <i class="icon-refresh icon-spin icon-4x" id="github-loading"></i>
            </p>
          </div>
        </div>
      </div>
      <!-- end of main-content -->
<?php get_footer(); ?>