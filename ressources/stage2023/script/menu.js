
const menuHamburger = document.querySelector(".menu-hamburger")
const navLinks = document.querySelector("header ul.list")

menuHamburger.addEventListener('click',()=>{
navLinks.classList.toggle('mobile-menu')
})

addEventListener("scroll", () => {
    navLinks.classList.remove('mobile-menu')
});