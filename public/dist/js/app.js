import { 
    showElement,
    scrollY} from "./modules/dom.js";

/**
 * preloader
 */
 const preloader = document.querySelector('#preloader');
 if (preloader) window.addEventListener('load', () => preloader.remove())
 
 // activate search nav
 const actionSearch = document.querySelector('#action-search')
 const navSearch = document.querySelector('#nav-search')
 if (navSearch && actionSearch) {
    (actionSearch, navSearch)
 }
 
 // activate notification nav
 const actionBell = document.querySelector('#option-bell')
 const navBell = document.querySelector('#nav-bell')
 if (actionBell && navBell) showElement(actionBell, navBell)
 
 const navShow = document.querySelector('#navbar a')
 const nav = document.querySelector('#nav-menu')
 const navClose = nav.querySelector('#close-nav')
 if (navShow && navClose && nav) {
     navShow.addEventListener('click', (e) => {
         e.preventDefault()
         nav.classList.add('active')
     })
 
     navClose.addEventListener('click', (e) => {
         e.preventDefault()
         nav.classList.remove('active')
     })
 }
 
const header = document.querySelector('#header')
if (header) scrollY(header, 60)

const scrolltop = document.querySelector('#scrolltop')
if (scrolltop) scrollY(scrolltop, 400)

