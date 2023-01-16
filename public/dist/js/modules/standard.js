/**
 * 
 * @param {Object|null} obj 
 */
export function isEmptyObject(obj) {
    if (!obj) return
    const keys = Object.keys(obj)
    return keys.length === 0
}