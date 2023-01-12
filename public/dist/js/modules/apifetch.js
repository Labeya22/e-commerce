export async function fetchJson(url) {
    const r = await fetch(url, {
        method: 'GET'
    })

    if (r.ok) {
        return await r.json()
    }

    throw new Error("une erreur est survenue")
}

export async function fetchJsonPost(url, data) {
    const r = await fetch(url, {
        method: 'POST',
        body: data
    })

    if (r.ok) {
        return await r.json()
    }

    throw new Error("une erreur est survenue")
}