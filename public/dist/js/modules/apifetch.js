export async function fetchJson(url) {
    const r = await fetch(url, {
        method: 'GET'
    })

    if (r.ok) {
        return await r.json()
    }

    throw new Error("une erreur est survenue")
}
