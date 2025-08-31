(function() {
  const catalogList = $('.p-catalog-list');
  if (catalogList.length > 0) {
    catalogList.each(function() {
      $(this).find('h3').matchHeight();
    });
  }
})();