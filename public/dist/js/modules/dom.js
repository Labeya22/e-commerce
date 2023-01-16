import { isEmptyObject } from "./standard.js"

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


/**
 * 
 * @param {Object} errors 
 * @param {HTMLElement|null} form 
 */
export function setErrorInput(errors, form) {
    if (!form) return
    const inputs = form.querySelectorAll('.input-form')
    if (inputs) {
        inputs.forEach(input => {
            const node = input.parentNode
            let error = node.querySelector('.error-field')
            const message = !errors || !errors[input.id] ? '' : errors[input.id]
            if (error) error.innerHTML = message
            else {
                error =  createElement('div', {class: 'error-field'})
                error.innerHTML = message
                node.append(error)
            }
        })
    }
}

export function createElement(tag, attributes) {
    const element = document.createElement(tag)
    for (const key in attributes) {
        const attribute = attributes[key]
        element.setAttribute(key, attribute)
    }
    return element
}

export function preloader() {
    const preloader = createElement('div', {id: 'preloader'})
    document.body.append(preloader)
}

/**
 * 
 * @param {Element} el 
 * @param {string} leaver
 */
export function leaveEnter(el, leaver = 'no-fetch') {
    el.addEventListener('mouseenter', () => el.classList.add(leaver))
    el.addEventListener('mouseleave', () => el.classList.remove(leaver))
}
