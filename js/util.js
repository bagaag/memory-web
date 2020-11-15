// shortISO formats a date as YYYY-MM-DD.
function shortISO(date) {
    let zeroPrefix = function(n) {
        if (String(n).length < 2) {
            return '0'+String(n);
        } else return String(n)
    }
    return date.getFullYear() + '-' + 
        zeroPrefix(date.getMonth()) + '-' +
        zeroPrefix(date.getDay());
}
