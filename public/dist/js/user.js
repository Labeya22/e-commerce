import { createToast, optionToast } from "./modules/toast.js"

const toasts = document.querySelector('.toasts')
if (toasts) {
    const toastAction = document.querySelectorAll('.toast-action button')
    const toastGenerate = toasts.querySelectorAll("#toast-generate")

    if (toastAction) {
        toastAction.forEach( button => {
            button.addEventListener('click', () => createToast(button.id))
        })
    }
    
    if (toastGenerate) {
        toastGenerate.forEach(toast => {
            optionToast(toasts, toast, toast.deleteTime ?? 10000)
        })
    }
}


createToast(null, 'success', "vous")