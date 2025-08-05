(function() {
  // ビューポートの処理
  // ----------------------------------------------//
  const viewport = document.querySelector('meta[name="viewport"]');
  const switchViewport = () => {
    const value = window.outerWidth > 370 ? 'width=device-width,initial-scale=1' : 'width=370';
    if (viewport.getAttribute('content') !== value) {
      viewport.setAttribute('content', value);
    }
  };
  
  window.addEventListener('resize', switchViewport, { passive: true });
  switchViewport();

  // mainタグmargin-topを追加
  // ----------------------------------------------//
  function setMainMarginTop() {
    const headerHeight = $(".l-header").outerHeight();
    $(".l-main").css("margin-top", headerHeight + "px");
  }

  setMainMarginTop();

  $(window).on("load resize", function() {
    setMainMarginTop();
  });

  $(window).on("scroll", function() {
    setMainMarginTop();
  });

  // ニュースカテゴリーの幅を統一
  // ----------------------------------------------//
  function setNewsCategoryWidth() {
    const categoryWraps = document.querySelectorAll('.p-top-news-item-category-wrap');
    
    if (categoryWraps.length === 0) return;
    
    categoryWraps.forEach(wrap => {
      wrap.style.width = 'auto';
    });
    
    let maxWidth = 0;
    categoryWraps.forEach(wrap => {
      const width = wrap.getBoundingClientRect().width;
      if (width > maxWidth) {
        maxWidth = width;
      }
    });
    
    categoryWraps.forEach(wrap => {
      wrap.style.width = maxWidth + 'px';
    });
  }

  setNewsCategoryWidth();

  $(window).on("load resize", function() {
    setNewsCategoryWidth();
  });

  // 製品セクションのホバーアニメーション
  // ----------------------------------------------//
  const productItems = document.querySelectorAll('.p-top-products-item');
  const productImage = document.querySelector('.p-top-products-image.is-pc img');
  const productImageText = document.querySelector('.p-top-products-image-text.is-pc');
  
  // 各製品項目に対応する画像とテキストのデータ
  const productData = [
    { image: 'images/img_products_01.jpg', text: 'agriculture' },
    { image: 'images/img_products_02.jpg', text: 'pump' },
    { image: 'images/img_products_03.jpg', text: 'washer' },
    { image: 'images/img_products_04.jpg', text: 'attachment' },
    { image: 'images/img_products_05.jpg', text: 'mist' },
    { image: 'images/img_products_06.jpg', text: 'other' }
  ];

  // デフォルトの画像とテキストを保存
  const defaultImage = productImage ? productImage.src : '';
  const defaultText = productImageText ? productImageText.textContent : '';

  if (productItems.length > 0 && productImage && productImageText) {
    productItems.forEach((item, index) => {
      item.addEventListener('mouseenter', function() {
        if (productData[index]) {
          productImage.style.transition = 'transform 0.3s ease';
          productImage.style.transform = 'scale(1.1)';
          
          setTimeout(() => {
            productImage.src = productData[index].image;
            productImageText.textContent = productData[index].text;
            productImage.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
              productImage.style.transform = 'scale(1)';
            }, 50);
          }, 300);
        }
      });
    });
  }

  // GSAPフェードインアニメーション
  // ----------------------------------------------//
  const animationElements = document.querySelectorAll('.js-animation');

  if (animationElements.length > 0) {
    gsap.set(animationElements, {autoAlpha: 0, y: 20});

    animationElements.forEach((element, index) => {
      gsap.to(element, {
        autoAlpha: 1,
        y: 0,
        delay: 0.1,
        duration: 0.6,
        scrollTrigger: {
          trigger: element,
          start: '20% bottom',
        }
      });
    });
  }

})();
