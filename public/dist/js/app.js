import { fetchJson } from "./modules/apifetch.js";
import { 
    showElement,
    scrollY} from "./modules/dom.js";

import { calculRemoveCart, calculer, calculerAll } from "./modules/integer.js";
import { createToast } from "./modules/toast.js";

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

        quantity.addEventListener('keyup', () => {
            calculer(cart)
            calculerAll(carts, prices)
            const reqFetch = quantity.getAttribute('reqFetch')
            fetchJson(reqFetch).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            })
        })

        const cartRemove = cart.querySelector('#cart-remove')
        if (cartRemove) {
            cartRemove.addEventListener('click', (e) => {
                e.preventDefault()
                const url = cartRemove.getAttribute('href')
                const r = fetchJson(url)
                r.then(response => {
                    if (response.success) {
                        calculRemoveCart(cart, prices)
                        cart.remove()
                        createToast(null, 'success', "un produit a été supprimé.")
                    } else {
                        createToast(null, 'danger', "nous n'avons pas pu effectuer cette action.")
                    }
                }).catch(error => {
                    createToast(null, 'danger', error)
                })
            })
        }
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

// const tabs = document.querySelector('#tabs')
// if (tabs) {
//     tabs.querySelectorAll("#tab-menus a").forEach(link => {
//         link.addEventListener("click", (e) => {
//             e.preventDefault()
//             link.classList.add('active')
//             const id = link.getAttribute('href')
//             const tab = tabs.querySelector(`${id}`)
//             if (!tab) return
//             removeActive(tabs)
//             tab.classList.add('active')
//         })
//     })
    
// }

const addProduct = document.querySelector("#add-product")
console.log(addProduct);
if (addProduct) {
    addProduct.addEventListener('click', (e) => {
        e.preventDefault()
        const url = addProduct.getAttribute('href')
        const r = fetchJson(url)
        r.then(response => {
            if (response.ok === true && response.query === 'INSERT') {
                addProduct.innerHTML = `<i class="fa fa-check-double"></i> est dans le panier`
                createToast(null, 'success', 'le produit a été ajouté dans le panier.')
            }
        }).catch(error => {
            createToast(null, 'danger', `
            une erreur est survenue, merci de réessayer.
            (${error})
            `)
        })
    })
}