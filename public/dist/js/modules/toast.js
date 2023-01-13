
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
            legend: 'bravo',
            icon: 'fa fa-circle-check',
            text: "votre compte a bien été supprimé."
        },
        danger: {
            legend: 'echoué',
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
    toast.className = `toast`
    let {legend, text, icon} = toasts[id]
    if (!message) {
        message = text
    }
    toast.innerHTML = `
        <p class="toast-message">
            <i class="${icon} toast-${id} toast-icon"></i>
            ${message}
        </p>`

    optionToast(nodeAppend, toast)
}


{/* <ul class="toasts">
<li class="toast">
    <p class="toast-message">
        <i class="fa fa-check-circle toast-success toast-icon"></i>
        <strong class="toast-legend">labeya</strong> votre compte
    </p>
</li>
<li class="toast">
    <p class="toast-message">
        <i class="fa fa-xmark-circle toast-danger toast-icon"></i>
        <strong class="toast-legend">labeya</strong> votre compte
    </p>
</li>

<li class="toast show">
    <p class="toast-message">
        <i class="fa fa-circle-exclamation toast-warning toast-icon"></i>
        <strong class="toast-legend">labeya</strong> votre compte
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati illo illum cupiditate eligendi, nam voluptatibus dignissimos totam provident alias dolorum
    </p>
</li>

<li class="toast">
    <p class="toast-message">
        <i class="fa fa-check-circle toast-success toast-icon"></i>
        <strong class="toast-legend">labeya</strong> votre compte
    </p>
</li>
</ul> */}

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