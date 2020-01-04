$(document).ready(function()
{
    $('#btn-show-all-children').on('click', function(){
        // Expand row details
        table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
    });

    // Handle click on "Collapse All" button
    $('#btn-hide-all-children').on('click', function(){
        // Collapse row details
        table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
    });

    let table = $('#rooms_table').DataTable({
        'processing': true,
        "responsive": true,
        'columnDefs': [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
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