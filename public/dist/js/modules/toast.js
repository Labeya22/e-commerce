
/**
 * 
 * @param {HTMLUListElement} parentNode 
 * @param {HTMLLIElement} target 
 * @param {int} timer 
 */
export const optionToast = (parentNode, target, timer = 5000) =>  {
    parentNode.appendChild(target)
    target.timer = setTimeout(() => removeToast(target), timer)
    const close = target.querySelector('.toast-close')
    if (close) {
        close.addEventListener('click', () => removeToast(target))
    }
}


/**
 * 
 * @param {HTMLLIElement} target 
 */
export const removeToast = (target) => {
    target.classList.add('hide')
    if (target.timer) {
        clearTimeout(target.timer)
    }
    setTimeout(() => target.remove(), 600)
}



/**
 * Permet de créer un toast
 * 
 * @param {HTMLUListElement} nodeAppend 
 * @param {string} id 
 * @param {string} message 
 */
export const createToast = (nodeAppend, id, message = null) => {
    const toasts = {
        success: {
            legend: 'succès',
            icon: 'fa fa-circle-check',
            text: "votre compte a bien été supprimé."
        },
        danger: {
            legend: 'erreur',
            icon: 'fa-solid fa-circle-xmark',
            text: "votre compte n'existe plus."
        },
        warning: {
            legend: 'avertissement',
            icon: 'fa fa-triangle-exclamation',
            text: "en supprimant votre compte vous serez plus à mesure de vous connectez."
        },
        info: {
            legend: 'info',
            icon: 'fa-solid fa-circle-info',
            text: "un utilisateur vient d'être ajouter."
        }
    }
    
    if (!nodeAppend) {
        nodeAppend = createToastParent()
    }
    const toast = document.createElement('li')
    toast.className = `toast ${id}`
    let {legend, text, icon} = toasts[id]
    if (!message) {
        message = text
    }
    toast.innerHTML = `
            <div class="content">
                <span class="${icon} icon-type"></span>
                <span class="text">
                    <strong> ${legend} :</strong> ${message}
                </span>
            </div>
            <span class="fa-solid fa-xmark toast-close"></span>`

    optionToast(nodeAppend, toast)
}


export function createToastParent() {
    let toast = document.querySelector("ul.toasts")
    if (toast) {
        return toast;
    }
    toast = document.createElement('ul')
    toast.className = 'toasts';
    document.body.appendChild(toast)
    return toast
}