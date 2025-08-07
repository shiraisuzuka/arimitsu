(function() {
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
  const productItems = document.querySelectorAll('.p-top-product-item');
  const productImage = document.querySelector('.p-top-product-image.is-pc img');
  const productImageText = document.querySelector('.p-top-product-image-text.is-pc');
  
  // 各製品項目に対応する画像とテキストのデータ
  const productData = [
    { image: 'images/img_product_01.jpg', text: 'agriculture' },
    { image: 'images/img_product_02.jpg', text: 'pump' },
    { image: 'images/img_product_03.jpg', text: 'washer' },
    { image: 'images/img_product_04.jpg', text: 'attachment' },
    { image: 'images/img_product_05.jpg', text: 'mist' },
    { image: 'images/img_product_06.jpg', text: 'other' }
  ];

  // デフォルトの画像とテキストを保存
  const defaultImage = productImage ? productImage.src : '';
  const defaultText = productImageText ? productImageText.textContent : '';

  if (productItems.length > 0 && productImage && productImageText) {
    productItems.forEach((item, index) => {
      item.addEventListener('mouseenter', function() {
        if (productData[index]) {
          productImage.style.transition = 'opacity 0.3s ease';
          productImage.style.opacity = '0';
          productImageText.style.transition = 'opacity 0.3s ease';
          productImageText.style.opacity = '0';
          
          setTimeout(() => {
            productImage.src = productData[index].image;
            productImageText.textContent = productData[index].text;
            productImage.style.opacity = '1';
            productImageText.style.opacity = '1';
          }, 300);
        }
      });
    });
  }

  // ハンバーガーメニューの開閉
  // ----------------------------------------------//
  const hamburgerBtn = document.querySelector('.l-header-nav-btn');
  const hamburgerNav = document.querySelector('.l-header-nav-hamburger');
  const body = document.body;

  if (hamburgerBtn && hamburgerNav) {
    let isOpen = false;

    hamburgerBtn.addEventListener('click', function() {
      if (!isOpen) {
        // メニューを開く
        hamburgerNav.classList.add('is-active');
        hamburgerBtn.classList.add('is-active');
        body.classList.add('is-menu-open');
        isOpen = true;
      } else {
        // メニューを閉じる
        hamburgerNav.classList.remove('is-active');
        hamburgerBtn.classList.remove('is-active');
        body.classList.remove('is-menu-open');
        isOpen = false;
      }
    });

    // メニュー外をクリックした時に閉じる
    document.addEventListener('click', function(e) {
      if (isOpen && !hamburgerNav.contains(e.target) && !hamburgerBtn.contains(e.target)) {
        hamburgerNav.classList.remove('is-active');
        hamburgerBtn.classList.remove('is-active');
        body.classList.remove('is-menu-open');
        isOpen = false;
      }
    });

    // ESCキーでメニューを閉じる
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && isOpen) {
        hamburgerNav.classList.remove('is-active');
        hamburgerBtn.classList.remove('is-active');
        body.classList.remove('is-menu-open');
        isOpen = false;
      }
    });

    // サブメニューの開閉
    const hamburgerItems = hamburgerNav.querySelectorAll('.l-header-nav-hamburger-item');
    hamburgerItems.forEach(item => {
      const link = item.querySelector('a.no-arrow');
      const submenu = item.querySelector('ul');
      
      if (link && submenu) {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          
          // 他のサブメニューを閉じる
          hamburgerItems.forEach(otherItem => {
            if (otherItem !== item) {
              otherItem.classList.remove('is-open');
            }
          });
          
          // 現在のサブメニューをトグル
          item.classList.toggle('is-open');
        });
      }
    });
  }

  // 言語選択による遷移
  // ----------------------------------------------//
  const languageSelect = document.querySelector('.l-header-nav-select');
  
  if (languageSelect) {
    languageSelect.addEventListener('change', function() {
      const selectedValue = this.value;
      
      if (selectedValue === 'en') {
        window.location.href = '/english';
      } else if (selectedValue === 'jp') {
        window.location.href = '/';
      }
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
