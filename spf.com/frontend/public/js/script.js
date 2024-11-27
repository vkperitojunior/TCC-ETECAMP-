let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menuIcon.onclick = () =>{
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}

let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');

window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let ofsset = sec.offsetTop - 150;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if(top >= ofsset && top < ofsset +height){
            navLinks.forEach(links => {
                links.classList.remove('active');
                document.querySelector('header nav a[href*=' + id + ']').classList.add('active');
            })
        }
    })
}

let header = document.querySelector('header');

header.classList.toggle('sticky', window.scrollY > 100);

document.addEventListener("DOMContentLoaded", function() {
    var icon = document.getElementById("icon");
    var currentPage = window.location.pathname;

    function updateImagesForDarkMode() {
        var imgHome = document.getElementById("img-light-mode");
        if (imgHome) imgHome.src = "frontend/public/imagens/imagens_home/Paulo Freire 1 Dark Mode.png";

        if (currentPage.includes("sobre")) {
            var imgSobre1 = document.getElementById("img-light-mode1");
            var imgSobre2 = document.getElementById("img-light-mode2");
            var imgSobre3 = document.getElementById("img-light-mode3");

            if (imgSobre1) imgSobre1.src = "frontend/public/imagens/imagens_sobre/Paulo Freire 1 Dark Mode.png";
            if (imgSobre2) imgSobre2.src = "frontend/public/imagens/imagens_sobre/Paulo Freire 2 Dark Mode.png";
            if (imgSobre3) imgSobre3.src = "frontend/public/imagens/imagens_sobre/Cantor Dark Mode.png";
        }
    }

    function updateImagesForLightMode() {
        var imgHome = document.getElementById("img-light-mode");
        if (imgHome) imgHome.src = "frontend/public/imagens/imagens_home/Paulo Freire 1 Light Mode.png";

        if (currentPage.includes("sobre")) {
            var imgSobre1 = document.getElementById("img-light-mode1");
            var imgSobre2 = document.getElementById("img-light-mode2");
            var imgSobre3 = document.getElementById("img-light-mode3");

            if (imgSobre1) imgSobre1.src = "frontend/public/imagens/imagens_sobre/Paulo Freire 1 Light Mode.png";
            if (imgSobre2) imgSobre2.src = "frontend/public/imagens/imagens_sobre/Paulo Freire 2 Light Mode.png";
            if (imgSobre3) imgSobre3.src = "frontend/public/imagens/imagens_sobre/Cantor Light Mode.png";
        }
    }

    function applyDarkMode() {
        document.body.classList.add("dark-theme");
        icon.src = "frontend/public/imagens/geral/sol.png";
        updateImagesForDarkMode();
    }

    function removeDarkMode() {
        document.body.classList.remove("dark-theme");
        icon.src = "frontend/public/imagens/geral/lua.png";
        updateImagesForLightMode();
    }

    if (localStorage.getItem("theme") === "dark") {
        applyDarkMode();
    } else {
        removeDarkMode();
    }

    icon.onclick = function() {
        if (document.body.classList.contains("dark-theme")) {
            removeDarkMode();
            localStorage.setItem("theme", "light");
        } else {
            applyDarkMode();
            localStorage.setItem("theme", "dark");
        }
    }
});


let slideIndex = 0;
const slides = document.querySelector('.slides');
const totalSlides = document.querySelectorAll('.slides img').length;

// Função para atualizar a posição do slide
function updateSlidePosition() {
    slides.style.transform = `translateX(${-slideIndex * (100 / totalSlides)}%)`;
}

// Função para mover o slide
function moveSlide(step) {
    slideIndex += step;

    if (slideIndex >= totalSlides) {
        slideIndex = 0; // Vai para o primeiro slide após o último
    } else if (slideIndex < 0) {
        slideIndex = totalSlides - 1; // Volta ao último slide se passar do primeiro
    }

    updateSlidePosition();
}

// Função de autoplay
function autoPlay() {
    setInterval(() => {
        moveSlide(1); // Muda para o próximo slide
    }, 3000); // Intervalo de 3 segundos
}

// Inicia o autoplay
autoPlay();