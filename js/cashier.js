function test() {
    swal("Pembayaran Berhasil", "Klik OK untuk melakukan transaksi selanjutnya!", "success");
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

// Clock
const date = new Date()
document.getElementById('date').innerHTML = `${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`

setInterval(() => {
const today = new Date();
let h = today.getHours();
let m = today.getMinutes();
let s = today.getSeconds();
console.log(s)
    document.getElementById('time').innerHTML = `${h}:${m}:${s}`
}, 1000);