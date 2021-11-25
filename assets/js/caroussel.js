window.addEventListener('DOMContentLoaded', () => {
  var slideIndex, slides, dots, captionText, captionTitle
  const playPauseBtn = document.getElementById('playPauseBtn')
  const slideRight = document.getElementById('slideRight')
  const slideLeft = document.getElementById('slideLeft')

  initGallery()

  function initGallery() {
    slideIndex = 0
    slides = document.getElementsByClassName('imageHolder')
    if (slides[slideIndex]) {
      slides[slideIndex].style.opacity = 1

      captionText = document.querySelector('.captionHolder .captionText')
      captionTitle = document.querySelector('.captionHolder .captionTitle')

      captionText.innerText = slides[slideIndex].querySelector(
        '.captionText',
      ).innerText
      captionTitle.innerText = slides[slideIndex].querySelector(
        '.captionTitle',
      ).innerText
    }

    dots = []
    var dotsContainer = document.getElementById('dotsContainer')

    for (var i = 0; i < slides.length; i++) {
      var dot = document.createElement('span')
      dot.classList.add('dots')
      // TODO : add event listener to each dot
      // dot.setAttribute('onClick', 'moveSlide(' + i + ')')
      dotsContainer.append(dot)
      dots.push(dot)
    }
    if (dots[slideIndex]) {
      dots[slideIndex].classList.add('active')
    }
  }

  slideRight.addEventListener('click', function(){
    moveSlide(slideIndex + 1)
  })
  slideLeft.addEventListener('click', function(){
    moveSlide(slideIndex - 1)
  })

  function plusSlides(n) {
    moveSlide(slideIndex + n)
  }

  function moveSlide(n) {
    var i, current, next
    var moveSlideAnimClass = {
      forCurrent: '',
      forNext: '',
    }
    var slideTextAnimClass
    var slideTitleAnimClass
    if (n > slideIndex) {
      if (n >= slides.length) {
        n = 0
      }
      moveSlideAnimClass.forCurrent = 'moveLeftCurrentSlide'
      moveSlideAnimClass.forNext = 'moveLeftNextSlide'
      slideTextAnimClass = 'slideTextFromTop'
      slideTitleAnimClass = 'slideTitleFromTop'
    } else if (n < slideIndex) {
      if (n < 0) {
        n = slides.length - 1
      }
      moveSlideAnimClass.forCurrent = 'moveRightCurrentSlide'
      moveSlideAnimClass.forNext = 'moveRightNextSlide'
      slideTextAnimClass = 'slideTextFromBottom'
      slideTitleAnimClass = 'slideTitleFromBottom'
    }

    if (n != slideIndex) {
      next = slides[n]
      current = slides[slideIndex]
      for (i = 0; i < slides.length; i++) {
        slides[i].className = 'imageHolder'
        slides[i].style.opacity = 0
        dots[i].classList.remove('active')
      }
      current.classList.add(moveSlideAnimClass.forCurrent)
      next.classList.add(moveSlideAnimClass.forNext)
      dots[n].classList.add('active')
      slideIndex = n
    }
    if (captionText) {
      captionText.style.display = 'none'
      captionText.className = 'captionText' + slideTextAnimClass
      captionText.innerText = slides[n].querySelector('.captionText').innerText
      captionText.style.display = 'block'

      captionTitle.style.display = 'none'
      captionTitle.className = 'captionTitle' + slideTitleAnimClass
      captionTitle.innerText = slides[n].querySelector(
        '.captionTitle',
      ).innerText
      captionTitle.style.display = 'block'
    }
  }

  var timer = null
  function setTimer() {
    timer = setInterval(function () {
      plusSlides(1)
    }, 5000)
  }
  setTimer()

  playPauseBtn.addEventListener('click', function () {
    if (timer == null) {
      setTimer()
      playPauseBtn.style.backgroundPositionY = '0px'
      playPauseBtn.title = 'Pause'
    } else {
      clearInterval(timer)
      timer = null
      playPauseBtn.style.backgroundPositionY = '-40px'
      playPauseBtn.title = 'Play'
    }
  }) 
})
