import { fetchJson } from "./modules/apifetch.js"
import { createToast } from "./modules/toast.js"

const table = document.querySelector('.table')
if (table) {
    table.querySelectorAll('tbody tr').forEach(tr => {
        const a = tr.querySelector('#delete-product')
        console.log(a);
        if (!a) return
        a.addEventListener('click', (e) => {
            e.preventDefault()
            const ok = confirm("vous voulez vraiment effectuer cette action ?")
            if (!ok) return
            const url = a.getAttribute('href')
            const r = fetchJson(url)
            r.then(del => {
                if (del.success) {
                    createToast(null, 'success', 'un type a été supprimé.')
                    tr.remove()
                } 
                else createToast(null, 'danger', "nous n'avons pas pu effectuer cette action.")
            })
        })
    })
}