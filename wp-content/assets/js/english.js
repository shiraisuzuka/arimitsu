(function() {
  
  // スマホ用セレクトボックス風タブ機能
  // ----------------------------------------------//
  function initMobileSelectTab() {
    const container = document.querySelector('.js-tab-panel');
    if (!container) return;

    const tabs = container.querySelectorAll('.tab');
    const panels = container.querySelectorAll('.panel');
    
    if (tabs.length === 0 || panels.length === 0) return;

    let clickFlag = true;

    function initializeState() {
      if (window.innerWidth <= 768) {
        tabs.forEach(tab => tab.classList.remove('check'));
        tabs[0].classList.add('check');
        
        tabs.forEach((tab, index) => {
          if (index !== 0) {
            tab.style.display = 'none';
          } else {
            tab.style.display = 'block';
          }
        });
      }
    }

    // タブクリック時の処理
    function handleTabClick(clickedTab, clickedIndex) {
      // PC時は処理を実行しない
      if (window.innerWidth > 768) {
        return;
      }
      
      if (!clickFlag) return;
      
      clickFlag = false;
      tabs.forEach(tab => tab.classList.remove('check'));
      clickedTab.classList.add('check');

      if (window.innerWidth <= 768) {
        const hiddenTabs = Array.from(tabs).filter(tab => 
          !tab.classList.contains('check') && tab.style.display === 'none'
        );
        const isOpening = hiddenTabs.length > 0;

        if (isOpening) {
          container.classList.add('is-open');
        }

        let animationCount = 0;
        const totalAnimations = tabs.length - 1;

        tabs.forEach((tab, index) => {
          if (!tab.classList.contains('check')) {
            $(tab).fadeToggle(400, function() {
              animationCount++;
              if (animationCount === totalAnimations) {
                clickFlag = true;
                
                if (!isOpening) {
                  container.classList.remove('is-open');
                }
              }
            });
          }
        });

        if (totalAnimations === 0) {
          clickFlag = true;
        }
      } else {
        clickFlag = true;
      }

      switchPanel(clickedIndex);
    }

    // パネル切り替え処理
    function switchPanel(targetIndex) {
      const currentPanel = container.querySelector('.panel.is-show');

      if (currentPanel) {
        currentPanel.style.opacity = '0';

        setTimeout(() => {
          panels.forEach(panel => {
            panel.classList.remove('is-show');
          });

          const newPanel = panels[targetIndex];
          if (newPanel) {
            newPanel.classList.add('is-show');
            setTimeout(() => {
              newPanel.style.opacity = '1';
            }, 10);
          }
        }, 300);
      } else {
        panels.forEach(panel => {
          panel.classList.remove('is-show');
        });

        const newPanel = panels[targetIndex];
        if (newPanel) {
          newPanel.classList.add('is-show');
          setTimeout(() => {
            newPanel.style.opacity = '1';
          }, 10);
        }
      }
    }

    // スマホの場合のみイベントリスナーを設定
    function setupEventListeners() {
      if (window.innerWidth <= 768) {
        tabs.forEach((tab, index) => {
          tab.addEventListener('click', (e) => {
            e.preventDefault();
            handleTabClick(tab, index);
          });
        });
      }
    }

    function handleResize() {
      if (window.innerWidth > 768) {
        // PC時はスタイルをリセット
        tabs.forEach(tab => {
          tab.style.display = '';
          tab.classList.remove('check');
        });
        container.classList.remove('is-open');
      } else {
        // スマホ時は初期化
        initializeState();
        setupEventListeners();
      }
    }

    initializeState();
    setupEventListeners();

    window.addEventListener('resize', handleResize);
  }

  document.addEventListener('DOMContentLoaded', function() {
    initMobileSelectTab();
  });

})();