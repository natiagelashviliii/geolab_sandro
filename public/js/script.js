function isEmail(email) {
    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (email.search(emailRegEx) == -1) {
        return (false);
    }
    return (true);
}

function validate(e, type) {
    switch (type) {
        case 'int':
            return validateDouble(e);
            break;

        case 'double':
            return validateDouble(e, 1);
            break;

        case 'alpha':
            return validateAlpha(e);
            break;
    }
}
function validateDouble(e, _double) {
    if (!validateKeys(e, _double)) {
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}

function validateAlpha(e) {
    if (!validateKeys(e)) {
        return;
    }
    // Ensure that it is a alpha and stop the keypress
    if (!(e.keyCode > 64 && e.keyCode < 91)) {
        e.preventDefault();
    }
}
function validateKeys(e, _double) {
    // Allow: backspace, delete, tab, escape and enter
    var keyCodes = [32, 57, 48, 46, 8, 9, 27, 13];
    if (_double) {
        keyCodes.push(110);
        keyCodes.push(190);
    }
    if ($.inArray(e.keyCode, keyCodes) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: Ctrl+C
        (e.keyCode == 67 && e.ctrlKey === true) ||
        // Allow: Ctrl+X
        (e.keyCode == 88 && e.ctrlKey === true) ||
        // Allow: Ctrl+9
        (e.keyCode == 57 && e.ctrlKey === true) ||
        // Allow: Ctrl+0
        (e.keyCode == 48 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return false;
    }
    return true;
}
function maxZ() {
    var maxZ = Math.max.apply(null, $.map($('body *'), function(e, n) {
        if ($(e).css('position') == 'absolute' || $(e).css('position') == 'relative' || $(e).css('position') == 'fixed')
            return parseInt($(e).css('z-index')) || 1;
    }));
    return maxZ;
}

$(document).ready(function(){
    $('select').formSelect();
});