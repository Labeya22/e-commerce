export const REGEX = {
    i: "(^[0-9]+$)",
    az: "(^[a-z]+$)" 
}

/**
 * 
 * @param {string} regex 
 * @param {string} data 
 * @returns {boolean}
 */
export function isMatch(data, regex = 'i') {
    return (new RegExp(REGEX[regex])).test(data)
}

/**
 * 
 * @param {string} len 
 * @param {int} min 
 * @returns {boolean}
 */
export function lenghtMin(len, min = 4) {
    return len.length < min
}


/**
 * 
 * @param {string} len 
 * @param {int} max 
 * @returns {boolean}
 */
export function lenghtMax(len, max = 4) {
    return len.length > max
}


/**
 * 
 * @param {string} len 
 * @param {int} max 
 * @returns {boolean}
 */
export function lenghtBetween(len, max = 4) {
    const size = len.length
    return size < min || size > max
}

/**
 * 
 * @param {string} len 
 * @param {int} limit 
 * @returns {string}
 */
export function extract(len, limit = 50) {
    const size = len.length
    if (size <= limit) return len
    return len.slice(0, limit) + '...'
}