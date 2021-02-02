var password1 = document.getElementById('password1');
var password2 = document.getElementById('password2');
//RFC5322 konform auch dokumentieren!!!!!!!!!!!!
var EmailHighRegex = new RegExp("^(?=.*[@])([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|([]!#-[^-~ \t]|(\\[\t -~]))+)@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");
var birthDateRegex = /^\d{2}([./-])\d{2}\1\d{4}$/
var PasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/


var checkPassword = function() {
    var error = document.getElementById("messagePassword");
    var passwordToCheck = document.getElementById("password1").value
    console.log("bin in Funktion");
    if (!passwordToCheck.match(PasswordRegex)) {
        console.log("PW unzureichend")
        error.innerHTML = "Password unzureichend. Anforderungen: min. 8 Zeichen, min. 1 Klein- und Großbuchstaben, min. 1 Sonderzeichen (@$!%*?&_-)";
        error.style.display = "inline-block";
    } else {

        if (document.getElementById("password1").value ==
            document.getElementById("password2").value) {

            var borderColorSource = window.getComputedStyle(document.getElementById("password2"), null).getPropertyValue("borderColor");
            var backgroundColorSource = window.getComputedStyle(document.getElementById("password2"), null).getPropertyValue("backgroundColor");

            document.getElementById("password2").style.borderColor = borderColorSource;
            document.getElementById("password2").style.backgroundColor = backgroundColorSource;

            error.innerHTML = "";
            error.style.display = "none";

        } else {
            document.getElementById("password2").style.borderColor = "red";
            document.getElementById("password2").style.backgroundColor = "LightCoral";
            document.get
            error.innerHTML = "Passwörte sind nicht identisch!";
            error.style.display = "block";
        }
    }
}

var checkEmail = function() {
    var email = document.getElementById("email").value
    var emailfield = document.getElementById("email")

    var backgroundColorSource = window.getComputedStyle(emailfield, null).getPropertyValue("backgroundColor");
    console.log(email);
    var error = document.getElementById("messageMail")

    if (email != 0 && !email.match(EmailHighRegex)) {
        emailfield.style.backgroundColor = "LightCoral";


        error.innerHTML = "Dies ist keine gültige E-Mail Adresse";
        error.style.display = "block"

    } else {
        emailfield.style.backgroundColor = backgroundColorSource;

        error.innerHTML = "";
        error.style.display = "none"
    }

}

var checkBirthDate = function() {
    var birthDay = document.getElementById("birthDate").value
    var birthDayfield = document.getElementById("birthDate")

    var backgroundColorSource1 = window.getComputedStyle(birthDayfield, null).getPropertyValue("backgroundColor");
    console.log(birthDay);
    var error = document.getElementById("messageDate")

    if (birthDay != 0 && !birthDay.match(birthDateRegex)) {
        birthDayfield.style.backgroundColor = "LightCoral";
        console.log("Ungültiges Format");
        error.innerHTML = "Fehler Geburtsdatum, Format nicht entsprechend Vorgabe. Bsp: 12.03.1986";
        error.style.display = "block";

    } else {
        birthDayfield.style.backgroundColor = backgroundColorSource1;

        error.innerHTML = "";
        error.style.display = "none";
    }

}