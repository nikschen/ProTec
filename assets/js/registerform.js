var password1 = document.getElementById('password1');
var password2 = document.getElementById('password2');

console.log(password1);
console.log(password2);




function changeColor() {
    var Words = document.getElementById("test");
    Words.style.backgroundColor = "green";
}




function Start() {

    var para = document.createElement("DIV"); // Create a <div> element
    para.setAttribute("id", "calculatorBox")
    para.style.width = "320px";
    para.style.height = "500px";
    para.style.border = "thin solid grey"
    para.style.backgroundColor = "#e0c4be"
    para.style.position = "relative"
    para.style.textAlign = "center";
    para.style.margin = "100px"
    para.style.boxShadow = "10px 10px 5px grey"
        //para.style.display = "table-cell"


    document.getElementsByTagName("BODY")[0].appendChild(para);
}


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