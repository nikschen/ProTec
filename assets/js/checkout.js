function hidePaymentNumber() {
    document.getElementById('paymentNumber').setAttribute("style", "display:none");
    document.getElementById('paymentNumber').required = false;

}

function showPaymentNumber() {
    document.getElementById('paymentNumber').setAttribute("style", "display:block");
    document.getElementById('paymentNumber').required = true;

}