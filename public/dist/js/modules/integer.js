
/**
 * Permet de faire la somme des valeurs dans un tableau
 * 
 * @param {int[]|float[]} values 
 */
export function sum(values) {
    let data = 0
    values.forEach(v => {
        data += v
    })
    return data
}

/**
 * 
 * @param {float|int} value 
 * @param {int} mult 
 */
export function priceSum(value, mult) {
    return value * mult
}



/**
 * 
 * @param {Element} cart 
 */
export function calculer(cart) {

    const unit = cart.querySelector("#price-unit")
    const total = cart.querySelector("#price-total")
    const stocks = cart.querySelector('#stock')
    const stock = parseInt(stocks.getAttribute('stock'))
    const quantity = cart.querySelector("#quantity")

    quantity.setAttribute('max', stock)
    quantity.setAttribute('min', 1)
    let value = quantity.value
    if (value !== "") {
        let valueParse = parseInt(value)
        if (valueParse <= 0) value = 1
        if (valueParse > stock) value = stock
        const price = parseInt(unit.getAttribute('price'))
        let p = priceSum(price, value)
        if (p <= 0) p = price
        total.innerHTML = `${p}$`
        cart.setAttribute('forbuy', p)
        quantity.value = value
    }

}

/**
 * 
 * @param {Element[]} carts 
 * @param {Element} prices 
 */
export function calculerAll(carts, prices) {
    let data = 0
    prices.setAttribute('prices', '0')
    carts.forEach(cart => {
        const v = cart.getAttribute('forbuy')
        if (v) {
            data += parseInt(v)
        }

    })

    const input = document.querySelector("#price-input")
    if (input) {
        input.value = data
    }

    prices.setAttribute('prices', data)
    prices.innerHTML = `${data}$`
}

/**
 * 
 * @param {Element} cart 
 * @param {Element} total 
 */
export function calculRemoveCart(cart, total) {
    const priceCart = parseFloat(cart.getAttribute('forbuy'))
    const prices = parseFloat(total.getAttribute('prices'))
    const price = (prices - priceCart)
    total.setAttribute('prices', price)
    total.innerHTML = `${price}$`
}