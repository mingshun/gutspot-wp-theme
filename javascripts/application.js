/*
 * scripts for docs
 */
(function ($) {
  /*
   * regex selector extention 
   */
  $.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(','),
      validLabels = /^(data|css):/,
      attr = {
        method: matchParams[0].match(validLabels) ? matchParams[0].split(':')[0] : 'attr',
        property: matchParams.shift().replace(validLabels,'')
      },
      regexFlags = 'ig',
      regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g,''), regexFlags);
    return regex.test(jQuery(elem)[attr.method](attr.property));
  }


  /*
   * auto-growing textarea
   */ 
  $.fn.autogrow = function() {
    return this.each(function() {
      if (this.tagName.toLowerCase() !== 'textarea') {
        return;
      }

      var self = $(this)
        , mirror = $('<div></div>').addClass('autogrow-textarea-mirror');

      self.css('overflow', 'hidden').after(mirror);

      mirror.css({
        'display': 'none',
        'width': $(this).css('width'),
        'border-width': $(this).css('border-width'),
        'padding': $(this).css('padding'),
        'line-height': $(this).css('line-height'),
        'font-family': $(this).css('font-family'),
        'font-size': $(this).css('font-size'),
        'word-wrap': $(this).css('word-wrap')
      });

      $(this).bind('keydown keyup', function() {
        mirror.html(textEscape(self.val()) + '.<br>.');
        self.height(mirror.height());
      });

      function textEscape(text) {
        return text
          .replace(/&/g,'&amp;')
          .replace(/ {2}/g, '&nbsp;')
          .replace(/<|>/g, '&gt;')
          .replace(/\n/g, '<br>');
      }
    });
  };


  /*
   * replace obfuscation links to a real one
   */
  $(function() {
    $('a:regex(href, ^\\[[0-9|a-f]+\\]$)').each(function() {
      var self = $(this)
        , obfu = self.attr('href')
        , text = ''
        , rand
        , i;

      obfu = obfu.substring(1, obfu.length - 1);
      rand = parseInt(obfu.substr(0, 2), 16);
      
      for (i = 1; i < obfu.length / 2; ++i) {
        text += String.fromCharCode(parseInt(obfu.substr(i * 2, 2), 16) ^ rand);
      }
      self.attr('href', text);
    });
  });


  /*
   * bind collapse action on resize event of window
   */
  $(function() {
    var $win = $(window)
      , $nav = $('.subnav')
      , isCollapse = 0;

    $win.ready(subnavCollapse);
    $win.resize(subnavCollapse);

    function subnavCollapse() {
      var width = $win.width();

      if (width <= 767 && !isCollapse) {
        isCollapse = 1;
        $nav.addClass('nav-collapse');

      } else if (width > 768 && isCollapse){
        isCollapse = 0;
        $nav.removeClass('nav-collapse');
      }
    }
  });


  /*
   * bind subnav fixed top action on scroll event of window
   */
  $(function() {
    var $win = $(window)
      , $body = $('body')
      , $nav = $('.subnav')
      , navHeight = $('.subnav').height()
      , navTop = $('.subnav').length && $('.subnav').offset().top
      , marginTop = parseInt($body.css('margin-top'), 10)
      , isFixed = 0;

    $win.ready(processScroll);
    $win.scroll(processScroll);
    $win.resize(fixNavTop);

    function processScroll() {
      if ($body.width() <= 767) {
        return;
      }

      var scrollTop = $win.scrollTop();

      if (scrollTop >= navTop && !isFixed) {
        isFixed = 1;
        $nav.addClass('subnav-fixed');
        $body.css('margin-top', marginTop + navHeight + 'px');

      } else if (scrollTop <= navTop && isFixed) {
        isFixed = 0;
        $nav.removeClass('subnav-fixed');
        $body.css('margin-top', marginTop + 'px');
      }
    }

    function fixNavTop() {
      navHeight = $('.subnav').height();
      navTop = $('#header').height() + $('#header').offset().top;
    }
  });


  /*
   * bind top icon stay at bottom on scroll event of window
   */
  $(function() {
    var $win = $(window)
      , topIcon = $('#goto-top-icon')
      , distance = 300;

    $win.scroll(function() {
      if ($win.scrollTop() > distance) {
        topIcon.fadeIn();
      } else {
        topIcon.fadeOut();
      }
    });

    topIcon.click(function() {
      $('html, body').animate({
        scrollTop: 0
      }, 1000, 'easeInOutQuart');
    });
  });


  /*
   * bind autogrow actions to .comment-postbox textarea
   */
  $(function() {
    $('#respond textarea').autogrow();
  });
})(window.jQuery);