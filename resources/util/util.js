const objectToQueryString = (obj) => {
    const query = Object.entries(obj).map((item) => [
        item[0],
        encodeURIComponent(item[1]),
    ].join('=')).join('&')

    return query
}

const arrayToQueryString = (array, key) => {
    const values = Object.values(array)
        .filter((elem, pos, arr) => elem && arr.indexOf(elem) === pos)
        .map((value) => {
            const element = [
                `${key}[]`,
                value,
            ].join('=')

            return element
        }).join('&')

    return values
}

const complexToQueryString = (object, parentNode = null) => {
    const query = Object.entries(object).map((item) => {
        const key = parentNode ? `${parentNode}[${item[0]}]` : item[0]
        const value = item[1]

        if (Array.isArray(value)) {
            return arrayToQueryString(value, key)
        }

        if (value instanceof Object) {
            return complexToQueryString(value, key)
        }

        if (item[1]) {
            return [
                key,
                encodeURIComponent(item[1]),
            ].join('=')
        }

        return ''
    })
        .filter(empty => empty)
        .join('&')

    return query
}

export {
    complexToQueryString,
}
