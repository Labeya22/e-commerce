import { priceSum } from "./integer.js"

/**
 * 
 * @param {Element} target 
 * @param {Element} showElement 
 */
export function showElement(target, showElement) {
    target.addEventListener('click', (e) => {
        e.preventDefault()
        showElement.classList.toggle('active')
        target.classList.toggle('active')
    })

    document.addEventListener('mouseup', (e) => {
        e.preventDefault()
        if (!target.contains(e.target) && !showElement.contains(e.target)) {
            showElement.classList.remove('active')
            target.classList.remove('active')
        }
    })
}

export function closeElement(target, closeElement) {
    target.addEventListener('click', (e) => {
        e.preventDefault()
        closeElement.classList.remove('active')
        target.classList.remove('active')
    })
}


/**
 * Permet de mettre une classe html dans un el quand on scroll le window
 * 
 * @param {Element} el 
 * @param {int} max 
 * @param {string} activate 
 */
export function scrollY(el, max = 60, activate = 'active') {
    window.addEventListener('scroll', () => {
        window.scrollY >= max ? el.classList.add(activate) : el.classList.remove(activate)
    })
}
