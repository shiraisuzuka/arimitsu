(function() {

  const splide = new Splide('.p-technology-slide', {
      perPage: 3,
      perMove: 1,
      pauseOnHover: false,
      pagination: false,
  });
  
  splide.mount();

})();