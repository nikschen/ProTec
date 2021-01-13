var password1 = document.getElementById('password1');
var password2 = document.getElementById('password2');


var checkPasswordValidity = function() {
    if (password1.value != password2.value) {
        password2.setCustomValidity('Passwörter müssen übereinstimmen!');
    } else {
        password2.setCustomValidity('');
    }
};

password1.addEventListener('change', checkPasswordValidity);
password2.addEventListener('change', checkPasswordValidity);