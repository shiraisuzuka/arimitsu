(function() {

  const SlideElement = document.querySelector(".p-technology-slide");

  if (SlideElement) {
    const splide = new Splide('.p-technology-slide', {
        perPage: 3,
        perMove: 1,
        pauseOnHover: false,
        pagination: false,
        breakpoints: {
          768: {
            perPage: 1,
            perMove: 1,
          },
        },
    });
    
    splide.mount();
  }

})();