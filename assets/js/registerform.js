var password1 = document.getElementById('password1');
var password2 = document.getElementById('password2');
//RFC5322 konform auch dokumentieren!!!!!!!!!!!!
var EmailHighRegex = new RegExp("^(?=.*[@])([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|([]!#-[^-~ \t]|(\\[\t -~]))+)@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");
var birthDateRegex = /^\d{2}([./-])\d{2}\1\d{4}$/
    //var email = document.getElementById("email");

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

var checkEmail = function() {
    var email = document.getElementById("email").value
    var emailfield = document.getElementById("email")

    var backgroundColorSource = window.getComputedStyle(emailfield, null).getPropertyValue("backgroundColor");
    console.log(email);
    var error = document.getElementById("message")

    if (email != 0 && !email.match(EmailHighRegex)) {
        emailfield.style.backgroundColor = "LightCoral";

        error.innerHTML = "Dies ist keine gültige E-Mail Adresse";

    } else {
        emailfield.style.backgroundColor = backgroundColorSource;

        error.innerHTML = "";
    }

}

var checkBirthDate = function() {
    var birthDay = document.getElementById("birthDate").value
    var birthDayfield = document.getElementById("birthDate")

    var backgroundColorSource1 = window.getComputedStyle(birthDayfield, null).getPropertyValue("backgroundColor");
    console.log(birthDay);
    //var error = document.getElementById("message")

    if (birthDay != 0 && !birthDay.match(birthDateRegex)) {
        birthDayfield.style.backgroundColor = "LightCoral";
        console.log("Ungültiges Format");
        //error.innerHTML = "Dies ist keine gültige E-Mail Adresse";

    } else {
        birthDayfield.style.backgroundColor = backgroundColorSource1;

        //error.innerHTML = "";
    }

}