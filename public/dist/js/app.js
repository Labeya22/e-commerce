import { 
    showElement,
    scrollY,
    leaveEnter} from "./modules/dom.js";
import { fetchJson, fetchText } from "./modules/apifetch.js"
import { createToast } from "./modules/toast.js";

/**
 * preloader
 */
 const preloader = document.querySelector('#preloader');
 if (preloader) window.addEventListener('load', () => preloader.remove())
 
 // activate search nav
//  const actionSearch = document.querySelector('#action-search')
//  const navSearch = document.querySelector('#nav-search')
//  if (navSearch && actionSearch) {
//     (actionSearch, navSearch)
//  }
 
 // activate notification nav
 const actionBell = document.querySelector('#option-bell')
 const navBell = document.querySelector('#nav-bell')
 if (actionBell && navBell) {
    showElement(actionBell, navBell)
    const url = actionBell.getAttribute('url')
    setInterval(() => {
        const r = fetchJson(url)
        r.then(status => {
            if (status.eye) {
                actionBell.classList.add('no-eye')
            } else {
                actionBell.classList.remove('no-eye')
            }
        })
    }, 1000)
    const bellBody = navBell.querySelector(".bell-body")
    if (bellBody) {
        const url = navBell.getAttribute('url')
        leaveEnter(navBell)
        setInterval(() => {
            if (!navBell.classList.contains('no-fetch')) {
                const response = fetchText(url)
                response.then(r => {
                    bellBody.innerHTML = r
                }).catch(err => {
                    console.log(err);
                })
            }
        }, 1000)
    }
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
if (header) scrollY(header, 60)

const scrolltop = document.querySelector('#scrolltop')
if (scrolltop) scrollY(scrolltop, 400)


const notifications = document.querySelectorAll("#block-notification")
if (notifications) {
    notifications.forEach(notification => {
        const action = notification.querySelector('#delete-notification')
        if (action) {
            action.addEventListener('click', (e) => {
                e.preventDefault()
                const yes = confirm("vous voulez vraiment effectuer cette action ?")
                if (!yes) return
                const url = action.getAttribute('href')
                const r = fetchJson(url)
                r.then(data => {
                    if (data.success) {
                        const onDelete = document.querySelector(`#generate-${data.id}`)
                        if (onDelete) onDelete.remove()
                        createToast(null, 'success', "une notification a été supprimé.")
                        notification.remove()
                    } else if (data.danger) {
                        createToast(null, 'danger', data.danger)
                    }
                })
            })
        }
    })
}