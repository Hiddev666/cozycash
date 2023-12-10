function table() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("table").innerHTML = this.responseText;
    }
    xhttp.open("GET", "cashier-table.php");
    xhttp.send();
}

function detail() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("detail-realtime").innerHTML = this.responseText;
    }
    xhttp.open("GET", "detail-realtime.php");
    xhttp.send();
}

setInterval(() => {
    table();
    detail()
}, 1000);

function test() {
    swal("Pembayaran Berhasil", "Klik OK untuk melakukan transaksi selanjutnya!", "success");
}

function logoutConfirm() {
    swal({
        title: "Are you sure?",
        text: "Are you sure that you want to leave this page?",
        icon: "warning",
        dangerMode: true,
      })
      .then(willDelete => {
        if (willDelete) {
          swal("Deleted!", "Your imaginary file has been deleted!", "success");
          window.location = "../logout-control.php";
        }
      });
}

document.addEventListener("keyup", 
    function (event) { 
        if (event.key === "b") { 
                event.preventDefault(); 
                test(); 
            } 
}); 

function dropdownShow() {
    let canvas = document.getElementById('canvas')
    canvas.style.right = "0%"
}

function dropdownHide() {
    let canvas = document.getElementById('canvas')
    canvas.style.right = "-30%"
}

// // Clock
// const date = new Date()
// document.getElementById('date').innerHTML = `${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`

setInterval(() => {

}, 1000);