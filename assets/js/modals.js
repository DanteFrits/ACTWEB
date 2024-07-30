// Ambil elemen tombol dan popup
var btn = document.getElementById("openPopup");
var popup = document.getElementById("popup");
var span = document.getElementsByClassName("close")[0];

// Ketika tombol ditekan, tampilkan popup
btn.onclick = function(event) {
    event.preventDefault(); // Mencegah tindakan default dari tautan
    popup.style.display = "block";
}

// Ketika tombol close ditekan, sembunyikan popup
span.onclick = function() {
    popup.style.display = "none";
}

// Ketika pengguna mengklik di luar popup, sembunyikan popup
window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
}