document.addEventListener('DOMContentLoaded', function () {
    // Dapatkan semua tombol navbar
    var navButtons = document.querySelectorAll('.nav-link');

    // Dapatkan URL saat ini tanpa parameter query
    var currentURL = window.location.pathname.split("/").pop();

    // Loop melalui setiap tombol navbar
    navButtons.forEach(function (button) {
        // Dapatkan nama halaman dari href tombol
        var buttonPage = button.href.split("/").pop();

        // Jika nama halaman tombol sama dengan nama halaman saat ini, tambahkan kelas "active"
        if (buttonPage === currentURL) {
            button.classList.add('active');
        }
    });
});
