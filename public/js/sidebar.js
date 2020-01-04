$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });

    setTimeout(function() {
        $(".alert").hide('slow');
    }, 3000);
});