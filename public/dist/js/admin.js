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
                    createToast(null, 'success', del.message)
                    tr.remove()
                } 
                else createToast(null, 'danger', "nous n'avons pas pu effectuer cette action.")
            })
        })
    })
}


const formUploaded = document.querySelector("#uploader")
const progress = document.querySelector(".progress-bar")
if (formUploaded) {
    const file = formUploaded.querySelector('#uploader-file')
    formUploaded.addEventListener('submit', (e) => {
        e.preventDefault()
        const httpRequest = new XMLHttpRequest()
        httpRequest.open('POST', formUploaded.getAttribute('action'))

        httpRequest.upload.addEventListener('progress', ({loaded, total}) => {
            const load = Math.floor((loaded / total) * 100)
            progress.style.width = `${load}%`
        })


        
        httpRequest.addEventListener('load', () => {
            if (httpRequest.status === 200 && httpRequest.readyState === 4) {
                console.log(httpRequest.response);
                // const response = JSON.parse(httpRequest.response)
                // if (response.errors) {
                //     createToast(null, 'danger', response.errors)
                // }  else if (response.expirate) window.location.reload()
            }
        })

        const data = new FormData(formUploaded)
        httpRequest.send(data)
    })
}



