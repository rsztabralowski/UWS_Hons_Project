$(document).ready(function()
{
    $('#rooms_table').DataTable({
        'processing': true,
        "responsive": true,
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],
        "pageLength": -1,
        'ajax': 'rooms/getdata',
        'columns':[
            { 'data': 'room_number'},
            { 'data': 'price'},
            { 'data': 'description'},
            { 'data': 'action', orderable:false, searchable: false}
        ]
    });
});