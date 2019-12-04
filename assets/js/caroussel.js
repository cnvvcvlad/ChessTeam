var slideIndex, slides, dots, captionText, captionTitle;

initGallery();

function initGallery() {
    
    slideIndex = 0;
    slides = document.getElementsByClassName("imageHolder");
    slides[slideIndex].style.opacity = 1;

    captionText = document.querySelector(".captionHolder .captionText");
    captionTitle = document.querySelector(".captionHolder .captionTitle");


    captionText.innerText = slides[slideIndex].querySelector(".captionText").innerText;
    captionTitle.innerText = slides[slideIndex].querySelector(".captionTitle").innerText;


    dots = [];
    var dotsContainer=document.getElementById("dotsContainer");

    for(var i=0; i < slides.length; i++) {
        var dot=document.createElement("span");
        dot.classList.add("dots");
        dot.setAttribute("onClick", "moveSlide("+i+")");
        dotsContainer.append(dot);
        dots.push(dot);
    }

    dots[slideIndex].classList.add("active");

}

function plusSlides(n) {
    moveSlide(slideIndex + n);
}

function moveSlide(n) {
    var i, current, next;
    var moveSlideAnimClass = {
        forCurrent:"",
        forNext:""
    }
    var slideTextAnimClass;
    var slideTitleAnimClass;
    if(n > slideIndex) {
        if(n >= slides.length) {n = 0}
        moveSlideAnimClass.forCurrent = "moveLeftCurrentSlide";
        moveSlideAnimClass.forNext = "moveLeftNextSlide";
        slideTextAnimClass = "slideTextFromTop";
        slideTitleAnimClass = "slideTitleFromTop";

    } else if(n < slideIndex) {
        if(n < 0) {n = slides.length-1}
        moveSlideAnimClass.forCurrent = "moveRightCurrentSlide";
        moveSlideAnimClass.forNext = "moveRightNextSlide";
        slideTextAnimClass = "slideTextFromBottom";
        slideTitleAnimClass = "slideTitleFromBottom";

    }

    if(n!=slideIndex) {
        next = slides[n];
        current = slides[slideIndex];
        for(i = 0; i < slides.length; i++) {
            slides[i].className = "imageHolder";
            slides[i].style.opacity = 0;
            dots[i].classList.remove("active");
        }
        current.classList.add(moveSlideAnimClass.forCurrent);
        next.classList.add(moveSlideAnimClass.forNext);
        dots[n].classList.add("active");
        slideIndex = n;

    }
    captionText.style.display = "none";    
    captionText.className = "captionText" + slideTextAnimClass;
    captionText.innerText = slides[n].querySelector(".captionText").innerText;
    captionText.style.display = "block";

    captionTitle.style.display = "none";    
    captionTitle.className = "captionTitle" + slideTitleAnimClass;
    captionTitle.innerText = slides[n].querySelector(".captionTitle").innerText;
    captionTitle.style.display = "block";
}

var timer = null;
function setTimer() {
    timer = setInterval(function() {
        plusSlides(1);
    }, 5000)

}
setTimer();

function playPauseSlides() {
    var playPauseSlides = document.getElementById("playPauseBtn");
    if(timer == null) {
        setTimer();
        playPauseBtn.style.backgroundPositionY = "0px";
    }else {
        clearInterval(timer);
        timer = null;
        playPauseBtn.style.backgroundPositionY = "-33px";
    }
}