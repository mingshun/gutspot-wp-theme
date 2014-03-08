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
    var $win = $(window)
      , $body = $('body')
      , $navbar = $('#navbar')
      , $navbarContainer = $('#navbar .container')
      , $navbarCollapse = $('#navbar .navbar-collapse')
      , navHeight = $('#navbar').height()
      , navTop = $('#navbar').length && $('#navbar').offset().top
      , marginTop = parseInt($body.css('margin-top'), 10);

    $win.ready(processScroll);
    $win.scroll(processScroll);
    $win.resize(processScroll);
    $win.ready(fixNavTop);
    $win.resize(fixNavTop);

    function processScroll() {
      var scrollTop = $win.scrollTop()
        , navTop = $('#banner').height() + $('#banner').offset().top
        , navHeight = $('#navbar').height();

      if ($body.width() < 768) {
        $navbar.removeClass('navbar-fixed-top');
        return;
      }

      if (scrollTop >= navTop) {
        $navbar.addClass('navbar-fixed-top');
        $navbarContainer.removeClass('navbar-container-style');
        $body.css('margin-top', marginTop + navHeight + 'px');

      } else if (scrollTop <= navTop) {
        $navbar.removeClass('navbar-fixed-top');
        $navbarContainer.addClass('navbar-container-style');
        $body.css('margin-top', marginTop + 'px');
      }
    }

    function fixNavTop() {
      if ($body.width() < 768) {
        $navbarCollapse.removeClass('navbar-collapse-style');
      }

      if ($body.width() > 750) {
        $navbarCollapse.addClass('navbar-collapse-style');
      }
    }
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