(function() {
  // 製品検索詳細の開閉
  // ----------------------------------------------//
  const searchDetailBtn = document.querySelector('.p-product-search-detail-spbtn');
  const searchDetailWrapper = document.querySelector('.p-product-search-detail-contents-wrapper');
  
  if (searchDetailBtn && searchDetailWrapper) {
    searchDetailBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      const isVisible = searchDetailWrapper.style.display === 'block';
      
      if (isVisible) {
        searchDetailWrapper.style.display = 'none';
        searchDetailBtn.classList.remove('is-open');
      } else {
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


  // 製品詳細ページのスライド
  // ----------------------------------------------//
  const mainSlideElement = document.querySelector("#main-slide");
  const thumbnailSlideElement = document.querySelector("#thumbnail-slide");
  
  if (mainSlideElement && thumbnailSlideElement) {
    const main = new Splide("#main-slide", {
      type: "fade",
      rewind: true,
      pagination: false,
      arrows: false,
    });

    const thumbnails = new Splide("#thumbnail-slide", {
      perPage: 5,
      pagination: false,
      arrows: false,
      isNavigation: true,
      drag: false,
      gap: '1rem',
      breakpoints: {
        767: {
          gap: '0.4rem',
        }
      }
    });
    main.sync(thumbnails);
    main.mount();
    thumbnails.mount();
  }

  // 製品ラインナップの高さを揃える
  // ----------------------------------------------//
  if (document.querySelector('.p-product-lineup-item-contents')) {
    $(document).ready(function() {
      $('.p-product-lineup-item-contents').matchHeight();
    });
  }

  // 製品ラインナップ「もっと表示する」機能
  // ----------------------------------------------//
  const loadMoreBtn = document.getElementById('load-more-products');
  
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      // 非表示になっているアイテムを取得
      const hiddenItems = document.querySelectorAll('.p-product-lineup-item[style*="display: none"], .p-product-lineup-item.hidden-item[style*="display: none"]');
      const loaded = parseInt(this.dataset.loaded);
      const total = parseInt(this.dataset.total);
      const itemsToShow = 10; // 一度に表示する件数
      
      let showCount = 0;
      
      // 隠れているアイテムを順番に表示
      for (let i = 0; i < hiddenItems.length && showCount < itemsToShow; i++) {
        const item = hiddenItems[i];
        item.style.display = 'block';
        item.classList.remove('hidden-item');
        showCount++;
      }
      
      // 読み込み済み件数を更新
      const newLoaded = loaded + showCount;
      this.dataset.loaded = newLoaded;
      
      // 残り件数を計算
      const remaining = total - newLoaded;
      
      if (remaining <= 0) {
        // すべて表示した場合はボタンを非表示
        this.style.display = 'none';
      }
      
      // 高さを再調整（jQueryのmatchHeightプラグインが使用されている場合）
      if (typeof $ !== 'undefined' && $.fn.matchHeight) {
        setTimeout(() => {
          $('.p-product-lineup-item-contents').matchHeight();
        }, 100);
      }
    });
  }

})();
