(function() {
  // よくあるアコーディオン開閉
  // ----------------------------------------------//
  $(function () {
    $(".js-accordion-title").on("click", function () {
      $(this).next().slideToggle(300);
      $(this).toggleClass("open", 300);
    });
  });

  // 募集要項のタブ切り替え機能
  // ----------------------------------------------//
  $(function () {
    function showTabFromHash() {
      const hash = window.location.hash;
      
      if (hash === '#tab-1' || hash === '#tab-2') {
        const $tabPanel = $('.js-tab-panel');
        const $tabs = $tabPanel.find('.tab');
        const $panels = $tabPanel.find('.panel');
        
        $tabs.removeClass('is-active');
        $panels.removeClass('is-show');
        
        let $targetPanel;
        
        if (hash === '#tab-1') {
          $tabs.filter('.tab-1').addClass('is-active');
          $targetPanel = $panels.filter('.tab-1').addClass('is-show');
        } else if (hash === '#tab-2') {
          $tabs.filter('.tab-2').addClass('is-active');
          $targetPanel = $panels.filter('.tab-2').addClass('is-show');
        }
        
        if ($targetPanel && $targetPanel.length > 0) {
          setTimeout(function() {
            $('html, body').animate({
              scrollTop: $targetPanel.offset().top - 100
            }, 500);
          }, 100);
        }
      }
    }
    
    showTabFromHash();
    
    $(window).on('hashchange', showTabFromHash);
    
    $('.js-tab-panel .tab').on('click', function() {
      const $this = $(this);
      const $tabPanel = $this.closest('.js-tab-panel');
      const $tabs = $tabPanel.find('.tab');
      const $panels = $tabPanel.find('.panel');
      
      $tabs.removeClass('is-active');
      $panels.removeClass('is-show');
      
      $this.addClass('is-active');
      
      if ($this.hasClass('tab-1')) {
        $panels.filter('.tab-1').addClass('is-show');
        history.replaceState(null, null, '#tab-1');
      } else if ($this.hasClass('tab-2')) {
        $panels.filter('.tab-2').addClass('is-show');
        history.replaceState(null, null, '#tab-2');
      }
    });
  });
})();
