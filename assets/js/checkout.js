

function hidePaymentNumber() {
        console.log("klappt doch")
        document.getElementById('paymentNumber').setAttribute("style","display:none");
        document.getElementById('paymentNumber').required=false;

}

function showPaymentNumber() {
    console.log("klappt doch")
    document.getElementById('paymentNumber').setAttribute("style","display:block");
    document.getElementById('paymentNumber').required=true;

}