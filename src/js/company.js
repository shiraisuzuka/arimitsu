(function() {
  // タブ切り替え機能
  // ----------------------------------------------//
  function initTabMessage() {
    const container = document.querySelector('.p-company-tab-panel');
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
  
  document.addEventListener('DOMContentLoaded', function() {
    initTabMessage();
  });
  
})();
