(function($) {
  $(function() {
    $('a[data-obfu]').each(function() {
      var self = $(this)
        , obfu = self.data('obfu')
        , text = ''
        , rand
        , i;

      rand = parseInt(obfu.substr(0, 2), 16);
      
      for (i = 1; i < obfu.length / 2; ++i) {
        text += String.fromCharCode(parseInt(obfu.substr(i * 2, 2), 16) ^ rand);
      }
      self.attr('href', text);
    });
  });

  $(function() {
    $('.navbar-search-form input').click(function() {
      var width = $('body').width();
      $(this).parent().parent().addClass('open');
    });

    $('.navbar-search-form input').blur(function() {
      var width = $('body').width();
      if (!trim($(this).val())) {
        $(this).val('');
        $(this).parent().parent().removeClass('open');
      }
    });

    function trim(str) {
      return str.replace(/(^\s*)|(\s*$)/g, '');
    }
  });

  $(function() {
    var $win = $(window)
      , topIcon = $('#goto-top-icon')
      , distance = 300;

    $win.scroll(function() {
      if ($win.scrollTop() > distance) {
        topIcon.focusout();
        topIcon.fadeIn();
      } else {
        topIcon.focusout();
        topIcon.fadeOut();
      }
    });

    topIcon.click(function() {
      $('html, body').animate({
        scrollTop: 0
      }, 1000);
    });
  });
})(window.jQuery);