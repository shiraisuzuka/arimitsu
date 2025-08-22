(function() {
  // よくあるアコーディオン開閉
  // ----------------------------------------------//
  $(function () {
    $(".js-accordion-title").on("click", function () {
      $(this).next().slideToggle(300);
      $(this).toggleClass("open", 300);
    });
  });
})();
