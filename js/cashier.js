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
        title: "Yakin ingin Logout?",
        text: "Klik OK untuk melanjutkan!",
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
 /* Tanpa Rupiah */
 /* Dengan Rupiah */
 var tunai = document.getElementById('tunai');
 tunai.addEventListener('keyup', function(e)
 {
     tunai.value = formatRupiah(this.value, '');
 });
 
 /* Fungsi */
 function formatRupiah(angka, prefix)
 {
     var number_string = angka.replace(/[^,\d]/g, '').toString(),
         split    = number_string.split(','),
         sisa     = split[0].length % 3,
         rupiah     = split[0].substr(0, sisa),
         ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
         
     if (ribuan) {
         separator = sisa ? '.' : '';
         rupiah += separator + ribuan.join('.');
     }
     
     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
     return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
 }