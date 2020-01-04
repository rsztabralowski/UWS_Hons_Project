$(document).ready(function()
{
    $('#users_table').DataTable({
        'processing': true,
        "responsive": true,
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],
        "pageLength": -1,
        'ajax': 'users/getdata',
        'columns':[
            { 'data': 'username'},
            { 'data': 'first_name'},
            { 'data': 'last_name'},
            { 'data': 'email'},
            { 'data': 'address'},
            { 'data': 'phone'},
            { 'data': 'action', orderable:false, searchable: false}
        ]
    });
});    
