/*
 * scripts for loading and displaying github repos.
 */
(function ($) {
  /*
   * load and display github repos.
   */
  $(function() {
    var github_type = $('#repos').data('github-type')
      , github_login = $('#repos').data('github-login')
      , github_repos_url = 'https://api.github.com/' + github_type + 's/' + github_login + '/repos'
      , repos = [];

    $.getJSON(github_repos_url, 'sort=pushed', success_cb);

    /*
     * callback of successful ajax getting. 
     */
    function success_cb(response, status, xhr) {
      if (status !== 'success') {
        return;
      }

      var links = page_links(xhr.getResponseHeader('Link'));

      repos = repos.concat(response);

      if (links && links['next']) {
        $.getJSON(links['next'], success_cb);

      } else {
        display_repos();
      }
    }

    /*
     * parse page link from ajax response header.
     */
    function page_links(link_header) {
      if (!link_header) {
        return;
      }

      var link_splits = link_header.split(',')
        , regex = /<(.+)>\s*\;\s*rel="(\w+)"/
        , obj = {}
        , temp
        , i;

      for (i = 0; i < link_splits.length; ++ i) {
        temp = regex.exec(link_splits[i]);
        obj[temp[2]] = temp[1];
      }

      return obj;
    }

    /*
     * display repositories.
     */
    function display_repos() {
      var repos_div = $('#repos')
        , temp
        , i
        , j;

      repos_div.empty();
      for (i = 0; i < repos.length; i += 4) {
        temp = $('<div></div>').addClass('row-fluid');

        for (j = i; j < ((repos.length > i + 4) ? (i + 4) : repos.length); ++ j) {
          temp.append(assemble_repo_node(repos[j]));
        }
        repos_div.append(temp);
      }
    }

    /*
     * assemble a repository node by the github repository object.
     */
    function assemble_repo_node(repo_obj) {
      return $('<div></div>')
        .addClass('span3')
        .addClass('well')
        .addClass('repo')
        .addClass(language_css_class(repo_obj.language))
        .append($('<a></a>')
          .attr('href', repo_obj.html_url)
          .attr('target', '_blank')
          .attr('rel', 'noreferrer')
          .append($('<h2></h2>')
            .text(repo_obj.name)
            .append(assemble_repo_meta(repo_obj.language, 'repo-language'))
            .append(assemble_repo_meta(repo_obj.pushed_at, 'repo-update', date_styler)))
          .append(assemble_repo_meta(repo_obj.description)));
    }

    /*
     * assemble repository meta data node.
     */
    function assemble_repo_meta(meta_data, css_class, styler) {
      var obj;
      if (meta_data) {
        obj = $('<p></p>');

        if (styler) {
          obj.text(styler(meta_data));
        } else {
          obj.text(meta_data);
        }

        if (css_class) {
          obj.addClass(css_class);
        }
        return obj;
      }
    }

    /*
     * style the date retrieving from the ajax response.
     */
    function date_styler(date) {
      var d = new Date(date);
      return d.getFullYear() + '/' + (d.getMonth() + 1) + '/' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
    }

    /*
     * retrieve the css class for the given language name.
     */
    function language_css_class(language) {
      if (!language) {
        return;
      }

      var lang_class = language.toLowerCase();

      switch (lang_class) {
        case 'c++':
          lang_class = 'cpp';
          break;

        case 'c#':
          lang_class = 'cs';
          break;

        default:
          break;
      }

      return lang_class;
    }
  });
})(window.jQuery);