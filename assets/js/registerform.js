var password1 = document.getElementsByClassName('password1')[0];
var password2 = document.getElementsByClassName('password2')[0];
//RFC5322 konform auch dokumentieren!!!!!!!!!!!!
var EmailHighRegex = new RegExp("^(?=.*[@])([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|([]!#-[^-~ \t]|(\\[\t -~]))+)@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");
var birthDateRegex = /^\d{2}([./-])\d{2}\1\d{4}$/
var PasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/




var checkPassword = function() {
    var password1 = document.getElementsByClassName('password1')[0];
    var password2 = document.getElementsByClassName('password2')[0];
    var error = document.getElementsByClassName("messagePassword")[0];
    console.log(password1.value);
    if (!password1.value.match(PasswordRegex)) {
        console.log("PW unzureichend")
        error.innerHTML = "Password unzureichend. Anforderungen: min. 8 Zeichen, min. 1 Klein- und Großbuchstaben und Zahl, min. 1 Sonderzeichen (@$!%*?&_-)";
        error.style.display = "inline-block";
    } else {

        if (password1.value ==
            password2.value) {

            var borderColorSource = window.getComputedStyle(password2, null).getPropertyValue("borderColor");
            var backgroundColorSource = window.getComputedStyle(password2, null).getPropertyValue("backgroundColor");

            password2.style.borderColor = borderColorSource;
            password2.style.backgroundColor = backgroundColorSource;

            error.innerHTML = "";
            error.style.display = "none";

        } else {
            password2.style.borderColor = "red";
            password2.style.backgroundColor = "LightCoral";
            document.get
            error.innerHTML = "Passwörte sind nicht identisch!";
            error.style.display = "block";
        }
    }
}

var checkEmail = function() {
    var email = document.getElementsByClassName("emailToCheck")[0].value
    console.log(email);
    var emailfield = document.getElementsByClassName("emailToCheck")[0]

    var backgroundColorSource = window.getComputedStyle(emailfield, null).getPropertyValue("backgroundColor");
    console.log(email);
    var error = document.getElementsByClassName("messageMail")[0]

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
    var birthDay = document.getElementsByClassName("birthDateToCheck")[0].value
    var birthDayfield = document.getElementsByClassName("birthDateToCheck")[0]

    var backgroundColorSource1 = window.getComputedStyle(birthDayfield, null).getPropertyValue("backgroundColor");
    console.log(birthDay);
    var error = document.getElementsByClassName("messageDate")[0]

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