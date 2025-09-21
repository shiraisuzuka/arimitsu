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
    { image: 'images/img_product_01.png', text: 'AGRI' },
    { image: 'images/img_product_02.png', text: 'PUMP' },
    { image: 'images/img_product_03.png', text: 'WASHER' },
    { image: 'images/img_product_04.png', text: 'ATTACH' },
    { image: 'images/img_product_05.png', text: 'MIST' },
    { image: 'images/img_product_06.png', text: 'etc.' }
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
  const languageSelects = document.querySelectorAll('.l-header-nav-select');
  
  // 現在のページが英語ページかどうかを判定
  const isEnglishPage = window.location.pathname.includes('/english');
  
  if (languageSelects.length > 0) {
    languageSelects.forEach(function(select, index) {
      
      if (isEnglishPage) {
        select.value = 'en';
      } else {
        select.value = 'jp';
      }
      
      select.addEventListener('change', function() {
        const selectedValue = this.value;
        
        if (selectedValue === 'en') {
          window.location.href = '/english/';
        } else if (selectedValue === 'jp') {
          window.location.href = '/';
        }
      });
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

  // スティッキーナビゲーションのアクティブ状態管理
  // ----------------------------------------------//
  function initStickyNavigation() {
    const stickyLinks = document.querySelectorAll('.c-sticky-link a');
    const targetSections = [];
    
    stickyLinks.forEach(link => {
      const href = link.getAttribute('href');
      if (href && href.startsWith('#')) {
        const targetId = href.substring(1);
        const section = document.getElementById(targetId);
        if (section) {
          targetSections.push({
            id: targetId,
            element: section,
            link: link
          });
        }
      }
    });
    
    if (targetSections.length === 0) return;
    
    const observerOptions = {
      root: null,
      rootMargin: '-30% 0px -60% 0px',
      threshold: [0, 0.1, 0.5, 1.0]
    };
    
    const observer = new IntersectionObserver((entries) => {
      const visibleSections = [];
      
      entries.forEach(entry => {
        const sectionData = targetSections.find(s => s.element === entry.target);
        if (sectionData && entry.isIntersecting) {
          visibleSections.push({
            ...sectionData,
            intersectionRatio: entry.intersectionRatio,
            boundingClientRect: entry.boundingClientRect
          });
        }
      });
      
      stickyLinks.forEach(link => link.classList.remove('is-active'));
      
      if (visibleSections.length > 0) {
        let mostCenteredSection = visibleSections[0];
        let minDistanceFromCenter = Math.abs(visibleSections[0].boundingClientRect.top + visibleSections[0].boundingClientRect.height / 2);
        
        visibleSections.forEach(section => {
          const sectionCenter = section.boundingClientRect.top + section.boundingClientRect.height / 2;
          const distanceFromCenter = Math.abs(sectionCenter);
          
          if (distanceFromCenter < minDistanceFromCenter) {
            minDistanceFromCenter = distanceFromCenter;
            mostCenteredSection = section;
          }
        });
        
        mostCenteredSection.link.classList.add('is-active');
        currentActiveSection = mostCenteredSection.id;
      } else {
        currentActiveSection = null;
      }
    }, observerOptions);
    
    targetSections.forEach(sectionData => {
      observer.observe(sectionData.element);
    });
    
    stickyLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);
        
        if (targetSection) {
          const headerHeight = document.querySelector('.l-header').offsetHeight || 0;
          const offsetTop = targetSection.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
          
          window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  // タブ切り替え機能
  // ----------------------------------------------//
  function initTabMessage() {
    const container = document.querySelector('.js-tab-panel');
    if (!container) {
      return;
    }

    const tabs = container.querySelectorAll('.tab');
    const panels = container.querySelectorAll('.panel');

    if (tabs.length === 0 || panels.length === 0) {
      return;
    }

    function switchTab(targetIndex) {
      const currentPanel = container.querySelector('.panel.is-show');

      tabs.forEach(tab => {
        tab.classList.remove('is-active');
      });
      tabs[targetIndex].classList.add('is-active');

      if (currentPanel) {
        currentPanel.style.opacity = '0';

        setTimeout(() => {
          panels.forEach(panel => {
            panel.classList.remove('is-show');
          });

          const newPanel = panels[targetIndex];
          newPanel.classList.add('is-show');

          setTimeout(() => {
            newPanel.style.opacity = '1';
          }, 10);
        }, 300);
      } else {
        panels.forEach(panel => {
          panel.classList.remove('is-show');
        });

        const newPanel = panels[targetIndex];
        newPanel.classList.add('is-show');
        setTimeout(() => {
          newPanel.style.opacity = '1';
        }, 10);
      }
    }

    tabs.forEach((tab, index) => {
      tab.addEventListener('click', (e) => {
        e.preventDefault();
        switchTab(index);
      });
    });
  }
  
  // ハッシュリンクでの遷移時のオフセット処理
  // ----------------------------------------------//
  function handleHashNavigation() {
    const hash = window.location.hash;
    if (hash) {
      const targetElement = document.querySelector(hash);
      if (targetElement) {
        // 少し遅延させてヘッダーの高さが確定してから実行
        setTimeout(() => {
          const headerHeight = document.querySelector('.l-header').offsetHeight || 0;
          const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
          
          window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
          });
        }, 100);
      }
    }
  }

  // ハッシュ変更時の処理
  window.addEventListener('hashchange', function() {
    handleHashNavigation();
  });

  document.addEventListener('DOMContentLoaded', function() {
    initStickyNavigation();
    initTabMessage();
    // ページロード時にハッシュがある場合の処理
    handleHashNavigation();
  });


})();
