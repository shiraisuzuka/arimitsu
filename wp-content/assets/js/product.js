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
      const itemsToShow = 10;
      
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
        this.style.display = 'none';
      }
      
      // 高さを再調整
      if (typeof $ !== 'undefined' && $.fn.matchHeight) {
        setTimeout(() => {
          $('.p-product-lineup-item-contents').matchHeight();
        }, 100);
      }
    });
  }


  // 製品カテゴリーと目的・用途の対応関係
  // ----------------------------------------------//
  const categoryPurposeMapping = {
    'agricultural_machinery': ['spray_chemicals', 'other_purpose'], // 農業機械 → 薬剤/肥料をまく、その他
    'pump': ['spray_chemicals', 'water_pressure_supply'], // ポンプ → 薬剤/肥料をまく、水圧を供給する
    'cleaning_machine': ['spray_chemicals', 'high_pressure_motor', 'high_pressure_engine', 'high_pressure_hot_water', 'wash_containers', 'wash_other_items', 'foam_wash', 'other_purpose'], // ポンプ → 薬剤/肥料をまく、高圧洗浄系、容器/器具/パレット/部品を洗う、その他のものを洗う、泡で洗う、その他
    'attachment': ['foam_wash'], // アタッチメント → 泡で洗う
    'mist': ['cooling_dust_deodorizing'], // ミスト → 冷却/防塵/消臭
    'other_product': ['wash_other_items'] // その他 → その他のものを洗う
  };


  // 製品カテゴリー検索の動的投稿数表示
  // ----------------------------------------------//
  const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
  const submitButton = document.getElementById('category-search-submit');

  // 目的・用途チェックボックスの有効/無効を制御する関数
  function updatePurposeCheckboxes() {
    const selectedProductCategories = [];
    document.querySelectorAll('input[name="product_categories[]"]:checked').forEach(cb => {
      selectedProductCategories.push(cb.value);
    });
    
    // 選択されたカテゴリーに対応する目的を取得
    let availablePurposes = [];
    selectedProductCategories.forEach(category => {
      if (categoryPurposeMapping[category]) {
        availablePurposes = availablePurposes.concat(categoryPurposeMapping[category]);
      }
    });
    
    // 重複を除去
    availablePurposes = [...new Set(availablePurposes)];
    
    // すべての目的チェックボックスを取得
    const purposeCheckboxes = document.querySelectorAll('input[name="purpose_categories[]"]');
    
    purposeCheckboxes.forEach(checkbox => {
      const parentItem = checkbox.closest('.p-product-search-detail-contents-item');
      
      if (selectedProductCategories.length === 0) {
        // 製品カテゴリーが選択されていない場合は全て有効
        checkbox.disabled = false;
        parentItem.classList.remove('disabled');
        parentItem.style.opacity = '1';
        parentItem.style.pointerEvents = 'auto';
      } else if (availablePurposes.includes(checkbox.value)) {
        // 対応する目的は有効
        checkbox.disabled = false;
        parentItem.classList.remove('disabled');
        parentItem.style.opacity = '1';
        parentItem.style.pointerEvents = 'auto';
      } else {
        // 対応しない目的は無効
        checkbox.disabled = true;
        checkbox.checked = false;
        parentItem.classList.add('disabled');
        parentItem.classList.remove('is-checked');
        parentItem.style.opacity = '0.3';
        parentItem.style.pointerEvents = 'none';
      }
    });
  }

  if (categoryCheckboxes.length > 0 && submitButton) {
    const initialCountMatch = submitButton.value.match(/(\d+)件/);
    let totalCount = initialCountMatch ? parseInt(initialCountMatch[1]) : 0;
    
    function initializeProductCount() {
      const hasSelectedItems = document.querySelectorAll('input[name="product_categories[]"]:checked, input[name="purpose_categories[]"]:checked').length > 0;
      
      if (hasSelectedItems) {
        // 選択済みアイテムがある場合は投稿数を更新
        updateProductCount();
      } else {
        // 何も選択されていない場合は初期状態を設定
        if (totalCount > 0) {
          submitButton.disabled = false;
          submitButton.style.opacity = '1';
          submitButton.style.cursor = 'pointer';
        } else {
          submitButton.disabled = true;
          submitButton.style.opacity = '0.3';
          submitButton.style.cursor = 'not-allowed';
        }
      }
    }
    
    initializeProductCount();
    updatePurposeCheckboxes();
    
    // 製品カテゴリーのチェックボックス変更を監視
    const productCategoryCheckboxes = document.querySelectorAll('input[name="product_categories[]"]');
    productCategoryCheckboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        updatePurposeCheckboxes();
        updateProductCount();
      });
    });
    
    // 目的・用途のチェックボックス変更を監視
    const purposeCategoryCheckboxes = document.querySelectorAll('input[name="purpose_categories[]"]');
    purposeCategoryCheckboxes.forEach(checkbox => {
      checkbox.addEventListener('change', updateProductCount);
    });
    
    function updateProductCount() {
      const selectedProductCategories = [];
      const selectedPurposeCategories = [];
      
      // 選択されたカテゴリーを取得
      document.querySelectorAll('input[name="product_categories[]"]:checked').forEach(cb => {
        selectedProductCategories.push(cb.value);
      });
      
      document.querySelectorAll('input[name="purpose_categories[]"]:checked').forEach(cb => {
        selectedPurposeCategories.push(cb.value);
      });
      
      // 何も選択されていない場合は全投稿数を表示
      if (selectedProductCategories.length === 0 && selectedPurposeCategories.length === 0) {
        // 全投稿数を再取得するためのAJAXリクエスト
        const formData = new FormData();
        formData.append('action', 'get_product_count');
        
        fetch(ajax_object.ajax_url, {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            totalCount = data.data.count; // totalCountを更新
            submitButton.value = `検索する（${totalCount}件）`;
            
            if (totalCount > 0) {
              submitButton.disabled = false;
              submitButton.style.opacity = '1';
              submitButton.style.cursor = 'pointer';
            } else {
              submitButton.disabled = true;
              submitButton.style.opacity = '0.3';
              submitButton.style.cursor = 'not-allowed';
            }
          }
        })
        .catch(error => {
          console.error('Error:', error);
          submitButton.value = `検索する（${totalCount}件）`;
        });
        
        return;
      }
      
      // AJAXで投稿数を取得
      const formData = new FormData();
      formData.append('action', 'get_product_count');
      selectedProductCategories.forEach(category => {
        formData.append('product_categories[]', category);
      });
      selectedPurposeCategories.forEach(category => {
        formData.append('purpose_categories[]', category);
      });
      
      fetch(ajax_object.ajax_url, {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const count = data.data.count;
          submitButton.value = `検索する（${count}件）`;
          
          // 0件の場合はボタンを無効化
          if (count === 0) {
            submitButton.disabled = true;
            submitButton.style.opacity = '0.3';
            submitButton.style.cursor = 'not-allowed';
          } else {
            submitButton.disabled = false;
            submitButton.style.opacity = '1';
            submitButton.style.cursor = 'pointer';
          }
        }
      })
      .catch(error => {
        console.error('Error:', error);
        submitButton.value = `検索する（0件）`;
        submitButton.disabled = true;
        submitButton.style.opacity = '0.3';
        submitButton.style.cursor = 'not-allowed';
      });
    }
  }

})();
