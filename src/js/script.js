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

  // ハンバーガーメニューの位置とサイズを調整
  // ----------------------------------------------//
  function setHamburgerMenuPosition() {
    const headerHeight = $(".l-header").outerHeight();
    const hamburgerNav = document.querySelector('.l-header-nav-hamburger');
    
    if (hamburgerNav) {
      hamburgerNav.style.top = headerHeight + "px";
      hamburgerNav.style.height = `calc(100vh - ${headerHeight}px)`;
    }
  }

  // 初期設定とリサイズ時の調整
  setHamburgerMenuPosition();

  $(window).on("load resize", function() {
    setHamburgerMenuPosition();
  });

  $(window).on("scroll", function() {
    setHamburgerMenuPosition();
  });

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

  // 製品検索詳細の開閉
  // ----------------------------------------------//
  const searchDetailBtn = document.querySelector('.p-product-search-detail-spbtn');
  const searchDetailWrapper = document.querySelector('.p-product-search-detail-contents-wrapper');
  
  if (searchDetailBtn && searchDetailWrapper) {
    searchDetailBtn.addEventListener('click', function() {
      const isVisible = searchDetailWrapper.style.display === 'block';
      
      if (isVisible) {
        // 閉じる
        searchDetailWrapper.style.display = 'none';
        searchDetailBtn.classList.remove('is-open');
      } else {
        // 開く
        searchDetailWrapper.style.display = 'block';
        searchDetailBtn.classList.add('is-open');
      }
    });
  }

  // 製品検索チェックボックスの背景色変更
  // ----------------------------------------------//
  const checkboxes = document.querySelectorAll('.p-product-search-detail-contents-item .checkbox');
  
  if (checkboxes.length > 0) {
    checkboxes.forEach(checkbox => {
      const parentItem = checkbox.closest('.p-product-search-detail-contents-item');
      
      if (checkbox.checked) {
        parentItem.classList.add('is-checked');
      }
      
      checkbox.addEventListener('change', function() {
        if (this.checked) {
          parentItem.classList.add('is-checked');
        } else {
          parentItem.classList.remove('is-checked');
        }
      });
    });
  }

  // 製品検索リセットボタンの処理
  // ----------------------------------------------//
  const resetBtn = document.querySelector('.p-product-search-detail-reset');
  
  if (resetBtn && checkboxes.length > 0) {
    resetBtn.addEventListener('click', function() {

      setTimeout(() => {
        checkboxes.forEach(checkbox => {
          const parentItem = checkbox.closest('.p-product-search-detail-contents-item');
          if (checkbox.checked) {
            parentItem.classList.add('is-checked');
          } else {
            parentItem.classList.remove('is-checked');
          }
        });
      }, 0);
    });
  }

})();
