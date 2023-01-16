import { fetchJson, fetchPostJson } from "./modules/apifetch.js"
import { calculRemoveCart, calculer, calculerAll } from "./modules/integer.js"
import { isMatch } from "./modules/string.js"
import { createToast } from "./modules/toast.js"

/**
 * Permet de calculer les prix total d'un produit
 */
const carts = document.querySelectorAll('#carts #cart')
const prices = document.querySelector('#prices')
const totalElement = document.querySelector(".cart-total")
if (carts && totalElement && prices) {

   carts.forEach((cart) => {
       const quantity = cart.querySelector(".quantity")

       calculer(cart)

       quantity.addEventListener('input', () => {
           calculer(cart)
           calculerAll(carts, prices)
       })

       quantity.addEventListener('keyup', () => {
           setTimeout(() => {
                const value = quantity.value
                const parseQuantity = parseInt(value)            
                if (!isNaN(parseQuantity) && parseQuantity >= 1 && isMatch(value)) {
                    const reqFetch = quantity.getAttribute('reqFetch') + `&quantity=${parseQuantity}`
                    const r = fetchJson(reqFetch)
                    if (r === null) {
                        createToast(null, 'warning', "vous devez être connecté.")
                        return 
                    } 
                    r.then(response => {
                        if (response.success) createToast(null, 'success', 'la quantité a été mis à jour.')
                    }).catch(error => {
                        createToast(null, 'danger', "nous n'avons pas pu mettre la quantité à jour.")
                        quantity.value = 1
                    })
                }
           }, 1000)
       })
       

       const cartRemove = cart.querySelector('#cart-remove')
       if (cartRemove) {
           cartRemove.addEventListener('click', (e) => {
               e.preventDefault()
               const ok = confirm('Êtes-vous sûr ?')
               if (!ok) return
               const url = cartRemove.getAttribute('href')
               const r = fetchJson(url)
               r.then(response => {
                   if (response.success) {
                       calculRemoveCart(cart, prices)
                       cart.remove()
                       if (prices.getAttribute('prices') == '0') totalElement.remove()
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


const addProduct = document.querySelector("#add-product")
if (addProduct) {
    addProduct.addEventListener('click', (e) => {
        e.preventDefault()
        const url = addProduct.getAttribute('href')
        const r = fetchJson(url)
        if (r === null) {
            createToast(null, 'warning', "vous devez être connecté.")
            return 
        } 
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

const modalElements = document.querySelectorAll("[aria-modal]")
if (modalElements) {
    modalElements.forEach(modalElement => {
        modalElement.addEventListener('click', (e) => {
            e.preventDefault()
            const modalClick = modalElement.getAttribute('aria-modal')
            const modal = document.querySelector(`[element=${modalClick}]`)
            if (!modal) return
            modal.classList.add('active')
            const closeModal = modal.querySelector('.close-modal')
            if (!closeModal) return
            closeModal.addEventListener('click', () => modal.classList.remove('active'))
        })
    })
}

const checkout = document.querySelector('#carts')
if (checkout) {
    checkout.addEventListener('submit', (e) => {
        e.preventDefault()
        const yes = confirm("Êtes-vous sûr ?")
        if (!yes) return
        const url = checkout.getAttribute('action')
        const data = new FormData(checkout)
        const r = fetchPostJson(url, data)
        r.then(data => {
            if (data.warning) {
                createToast(null, 'warning', data.warning)
            } else if (data.danger) {
                createToast(null, 'danger', data.danger)
            } else if (data.success) {
                window.location.href = data.success
            }
        }).catch(err => {
            createToast(null, 'danger', err)
        })
    })
}

const cartShop = document.querySelector("#cart-shop")
if (cartShop) {
    const url = cartShop.getAttribute('url')
    setInterval(() => {
        const r = fetchJson(url)
        r.then(res => {
            if (res.news) {
                cartShop.classList.add('no-eye')
            } else {
                cartShop.classList.remove('no-eye')
            }
        })

    }, 1000)
}