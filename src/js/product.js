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


  // 製品詳細ページのスライド
  // ----------------------------------------------//
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

  // 製品ラインナップの高さを揃える
  // ----------------------------------------------//
  if (document.querySelector('.p-product-lineup-item-contents')) {
    $(document).ready(function() {
      $('.p-product-lineup-item-contents').matchHeight();
    });
  }

})();
