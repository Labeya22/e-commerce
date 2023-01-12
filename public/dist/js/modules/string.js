/**
 * 
 * @param {string} regex 
 * @param {string} data 
 * @returns {boolean}
 */
export function regex(data, regex = 'i') {
    const regexTab = {
        i: "(^[0-9]+$)",
        az: "(^[a-z]+$)" 
    }
    return data.match(regexTab[regex])
}