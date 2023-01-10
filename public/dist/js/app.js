import { 
    showElement,
    scrollY, 
    closeElement} from "./modules/dom.js";

import { calculer, calculerAll } from "./modules/integer.js";
import { createToast, optionToast } from "./modules/toast.js";

 // activate search nav
 const actionSearch = document.querySelector('#action-search')
 const navSearch = document.querySelector('#nav-search')
 if (navSearch && actionSearch) {
    (actionSearch, navSearch)
 }
 
 // activate notification nav
 const actionBell = document.querySelector('#option-bell')
 const navBell = document.querySelector('#nav-bell')
 
 if (actionBell && navBell) {
    showElement(actionBell, navBell)
 }
 
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
 if (header) {
     scrollY(header, 60)
 }

 const scrolltop = document.querySelector('#scrolltop')
 if (scrolltop) {
     scrollY(scrolltop, 400)
 }

/**
 * Permet de calculer les prix total d'un produit
 */
 const carts = document.querySelectorAll('#carts #cart')
 const prices = document.querySelector('#prices')
 if (carts && prices) {

    carts.forEach((cart) => {
        const quantity = cart.querySelector("#quantity")

        calculer(cart)

        quantity.addEventListener('input', () => {
            calculer(cart)
            calculerAll(carts, prices)
        })

        const cartRemove = cart.querySelector('#cart-remove')
        cartRemove.addEventListener('click', (e) => {
            e.preventDefault()
            cart.classList.add('anime-remove')
            calculerAll(carts, prices)
        })
    })

    calculerAll(carts, prices)
   
    // on récupère un produit en particulière.
 }

/**
 * 
 * @param {Elemnt} el 
 */
function removeActive (el) {
    el.querySelectorAll(".active").forEach(link => {
        link.classList.remove('active')
    })
}

const tabs = document.querySelector('#tabs')
if (tabs) {
    tabs.querySelectorAll("#tab-menus a").forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault()
            link.classList.add('active')
            const id = link.getAttribute('href')
            const tab = tabs.querySelector(`${id}`)
            if (!tab) return
            removeActive(tabs)
            tab.classList.add('active')
        })
    })
    
}

