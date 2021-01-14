var password1 = document.getElementById('password1');
var password2 = document.getElementById('password2');

console.log(password1);
console.log(password2);

var checkPassword = function() {
    if (document.getElementById("password1").value ==
        document.getElementById("password2").value) {

        var borderColorSource = window.getComputedStyle(document.getElementById("password2"), null).getPropertyValue("borderColor");
        var backgroundColorSource = window.getComputedStyle(document.getElementById("password2"), null).getPropertyValue("backgroundColor");

        document.getElementById("password2").style.borderColor = borderColorSource;
        document.getElementById("password2").style.backgroundColor = backgroundColorSource;
    } else {
        document.getElementById("password2").style.borderColor = "red";
        document.getElementById("password2").style.backgroundColor = "LightCoral";
    }
}