// ビューポートの処理
(function() {
  const viewport = document.querySelector('meta[name="viewport"]');
  const switchViewport = () => {
    const value = window.outerWidth > 370 ? 'width=device-width,initial-scale=1' : 'width=370';
    if (viewport.getAttribute('content') !== value) {
      viewport.setAttribute('content', value);
    }
  };
  
  window.addEventListener('resize', switchViewport, { passive: true });
  switchViewport();
})();
