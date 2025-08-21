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
  const productImage = document.querySelector('.p-top-product-image img');
  const productImageText = document.querySelector('.p-top-product-image-text');
  
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

  // ヘッダーナビゲーションのサブメニュー表示
  // ----------------------------------------------//
  const navItems = document.querySelectorAll('.l-header-nav-item');
  
  if (navItems.length > 0) {
    navItems.forEach(item => {
      const span = item.querySelector('span');
      const subList = item.querySelector('.l-header-nav-sub-list');
      let fadeTimer = null;
      
      if (span && subList) {
        span.addEventListener('mouseenter', function() {
          if (fadeTimer) {
            clearTimeout(fadeTimer);
            fadeTimer = null;
          }
          
          subList.classList.add('is-visible');
        });
        
        item.addEventListener('mouseleave', function() {
          fadeTimer = setTimeout(() => {
            subList.classList.remove('is-visible');
          }, 100);
        });
        
        subList.addEventListener('mouseenter', function() {
          if (fadeTimer) {
            clearTimeout(fadeTimer);
            fadeTimer = null;
          }
        });
      }
    });
  }

  // スクロールダウンパーツ
  // ----------------------------------------------//
  const scrollDownBtn = document.querySelector('.c-scroll-down');
  
  if (scrollDownBtn) {
    scrollDownBtn.addEventListener('click', function() {
      const nextSection = document.querySelector('.p-top-news');
      if (nextSection) {
        const headerHeight = document.querySelector('.l-header').offsetHeight;
        const targetPosition = nextSection.offsetTop - headerHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });

    scrollDownBtn.style.cursor = 'pointer';
    scrollDownBtn.addEventListener('mouseenter', function() {
      this.style.opacity = '0.7';
      this.style.transition = 'opacity 0.3s ease';
    });
    
    scrollDownBtn.addEventListener('mouseleave', function() {
      this.style.opacity = '1';
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

  // 内部リンクスクロールアニメーション ----------------------------------------------//
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  const anchorLinksArr = Array.prototype.slice.call(anchorLinks);
  
  anchorLinksArr.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const targetId = link.hash;
      const targetElement = document.querySelector(targetId);
      const targetOffsetTop = window.pageYOffset + targetElement.getBoundingClientRect().top;
      window.scrollTo({
        top: targetOffsetTop,
        behavior: "smooth"
      });
    });
  });
})();
