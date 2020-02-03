$(document).ready(function () {
    $("#datatable").DataTable({keys: !0});
    $("#datatable-buttons").DataTable({
        lengthChange: !1,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
        ],
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
    $("#selection-datatable").DataTable({select: {style: "multi"}});
});