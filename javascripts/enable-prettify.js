/*
 * scripts for enable prettify
 */
(function ($) {
  /*
   * enable prettify print and add copy code link to pre tag
   */
  $(function() {

    // run prettify print
    prettyPrint();

    // detect if flash 10 is avaliable
    if (!swfobject.hasFlashPlayerVersion('10.0.0')) {
      return;
    }

    // add copy code link to each pre block
    $('pre.prettyprint').each(function() {
      var self = $(this)
        , raw = this.innerText || this.textContent;

      $('<div><span>复制代码</span></div>')
        .addClass('copy-code')
        .appendTo(self)
        .zclip({
          path: templateDir + '/javascripts/zclip/ZeroClipboard.swf',
          copy: raw,
          afterCopy: function() {
            var modal = createModal('代码已经复制到剪贴板上了！');

            modal
              .appendTo(self)
              .on('hidden', function() {
                modal.remove();
              })
              .css({
                'margin-left': function() {
                  return -(modal.width() / 2);
                }, 
                'top': function() {
                  return ($(window).height() - modal.height()) / 2;
                }
              })
              .modal('show');

            setTimeout(function() {
              modal.modal('hide');
            }, 2000);
          }
        });
    });

    // create modal window
    function createModal(text) {
      return $('<div></div>')
        .addClass('modal')
        .addClass('hide')
        .addClass('fade')
        .css({
          'width': 'auto',
          'height': 'auto',
          'background-color': '#0072e6'
        })
        .append($('<div></div>')
          .addClass('modal-header')
          .css({
            'font-size': '20px',
            'font-weight': 'bold',
            'color': '#fff',
            'cursor': 'default',
            'margin': '20px'
          })
          .text(text));
    }
  });
})(window.jQuery);