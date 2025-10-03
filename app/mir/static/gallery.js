(function () {
  function unlockScrollIfIdle() {
    if (!document.body.classList.contains('is-nav-open') && !document.querySelector('.lightbox.is-open')) {
      document.body.classList.remove('no-scroll');
    }
  }

  function initNav() {
    var toggle = document.querySelector('[data-nav-toggle]');
    var nav = document.getElementById('primary-nav');
    if (!toggle || !nav) {
      return;
    }
    var backdrop = document.querySelector('.site-nav__backdrop');
    var navLinks = Array.prototype.slice.call(nav.querySelectorAll('a'));

    function openNav() {
      document.body.classList.add('is-nav-open');
      document.body.classList.add('no-scroll');
      toggle.setAttribute('aria-expanded', 'true');
    }

    function closeNav() {
      if (!document.body.classList.contains('is-nav-open')) {
        return;
      }
      document.body.classList.remove('is-nav-open');
      toggle.setAttribute('aria-expanded', 'false');
      unlockScrollIfIdle();
    }

    toggle.addEventListener('click', function () {
      if (document.body.classList.contains('is-nav-open')) {
        closeNav();
      } else {
        openNav();
      }
    });

    navLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        closeNav();
      });
    });

    if (backdrop) {
      backdrop.addEventListener('click', function () {
        closeNav();
      });
    }

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' || event.key === 'Esc') {
        closeNav();
      }
    });

    window.addEventListener('resize', function () {
      if (window.innerWidth > 768) {
        closeNav();
      }
    });
  }

  function initGallery() {
    var galleryNodes = Array.prototype.slice.call(document.querySelectorAll('.gallery img'));
    if (!galleryNodes.length) {
      return;
    }

    var lightbox = document.querySelector('.lightbox');
    if (!lightbox) {
      return;
    }
    var imageEl = lightbox.querySelector('.lightbox__image');
    var captionEl = lightbox.querySelector('.lightbox__caption');
    var prevBtn = lightbox.querySelector('.lightbox__nav--prev');
    var nextBtn = lightbox.querySelector('.lightbox__nav--next');
    var closeTriggers = lightbox.querySelectorAll('[data-lightbox-close]');
    var closeBtn = lightbox.querySelector('.lightbox__close');
    var currentIndex = 0;
    var focusReturnTarget = null;
    var total = galleryNodes.length;

    galleryNodes.forEach(function (img, index) {
      img.dataset.index = index;
      img.setAttribute('tabindex', '0');
      img.addEventListener('click', function () {
        open(index, img);
      });
      img.addEventListener('keydown', function (event) {
        var key = event.key || event.code;
        if (key === 'Enter' || key === ' ' || key === 'Spacebar') {
          event.preventDefault();
          open(index, img);
        }
      });
    });

    function open(index, trigger) {
      currentIndex = index;
      focusReturnTarget = trigger || document.activeElement;
      updateDisplayedImage();
      lightbox.classList.add('is-open');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.classList.add('no-scroll');
      if (closeBtn) {
        closeBtn.focus();
      }
      document.addEventListener('keydown', handleKeydown);
    }

    function closeLightbox() {
      if (!lightbox.classList.contains('is-open')) {
        return;
      }
      lightbox.classList.remove('is-open');
      lightbox.setAttribute('aria-hidden', 'true');
      imageEl.removeAttribute('src');
      imageEl.removeAttribute('alt');
      captionEl.textContent = '';
      document.removeEventListener('keydown', handleKeydown);
      unlockScrollIfIdle();
      if (focusReturnTarget && document.contains(focusReturnTarget)) {
        focusReturnTarget.focus();
      }
    }

    function updateDisplayedImage() {
      var active = galleryNodes[currentIndex];
      if (!active) {
        return;
      }
      var src = active.getAttribute('data-large-src') || active.getAttribute('src');
      var alt = active.getAttribute('alt') || '游戏截图';
      imageEl.src = src;
      imageEl.alt = alt;
      captionEl.textContent = alt;

      var controlsDisabled = total <= 1;
      prevBtn.disabled = controlsDisabled;
      nextBtn.disabled = controlsDisabled;
    }

    function showNext() {
      currentIndex = (currentIndex + 1) % total;
      updateDisplayedImage();
    }

    function showPrev() {
      currentIndex = (currentIndex - 1 + total) % total;
      updateDisplayedImage();
    }

    function handleKeydown(event) {
      if (!lightbox.classList.contains('is-open')) {
        return;
      }
      var key = event.key || event.code;
      if (key === 'Escape' || key === 'Esc') {
        event.preventDefault();
        closeLightbox();
        return;
      }
      if (key === 'ArrowRight' || key === 'Right' || key === 'KeyD') {
        event.preventDefault();
        showNext();
        return;
      }
      if (key === 'ArrowLeft' || key === 'Left' || key === 'KeyA') {
        event.preventDefault();
        showPrev();
      }
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', function () {
        if (!prevBtn.disabled) {
          showPrev();
        }
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function () {
        if (!nextBtn.disabled) {
          showNext();
        }
      });
    }

    closeTriggers.forEach(function (trigger) {
      trigger.addEventListener('click', function (event) {
        event.preventDefault();
        closeLightbox();
      });
    });

    lightbox.addEventListener('click', function (event) {
      if (event.target === lightbox) {
        closeLightbox();
      }
    });

    var dialog = lightbox.querySelector('.lightbox__dialog');
    if (dialog) {
      dialog.addEventListener('click', function (event) {
        event.stopPropagation();
      });
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    initNav();
    initGallery();
  });
})();
