let invoiceList = document.getElementById("invoice-list-wrapper")
let invoiceListWrapper = document.getElementById("invoicelist")
invoiceListWrapper.style.visibility = "hidden"

function invoiceListOpen() {
    if(invoiceListWrapper.style.visibility == "hidden") {
        invoiceListWrapper.style.visibility = "visible";
    } else {
        invoiceListWrapper.style.visibility = "hidden";
    }
}