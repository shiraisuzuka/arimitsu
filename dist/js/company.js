(function() {
  // スティッキーナビゲーションのアクティブ状態管理
  // ----------------------------------------------//
  function initStickyNavigation() {
    const stickyLinks = document.querySelectorAll('.p-company-sticky-link a');
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
    
    let currentActiveSection = null;
    
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
  
  document.addEventListener('DOMContentLoaded', initStickyNavigation);
  
})();
