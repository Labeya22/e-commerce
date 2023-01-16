const table = document.querySelector("#table-responsive")
if (table) {
    const th = Array.from(table.querySelectorAll('th')).map((t) => {
        return t.innerText
    })

    table.querySelectorAll('th').forEach(t => {
        th.push(t.innerText)
    })
    table.querySelectorAll("tbody td").forEach((td, index) => {
        td.setAttribute('data-label', th[index % th.length])
    })
}

const printFacture = document.querySelector("facture-print")
if (printFacture) {
    printFacture.addEventListener('click', (e) => {
        e.preventDefault()
        window.print()
    })
}
