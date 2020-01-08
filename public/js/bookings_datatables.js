$(document).ready(function(){
    let table = '';

    $('#current').attr('style', 'font-weight: 700');

    $('#btn-show-all-children').on('click', function(){
        // Expand row details
        table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
    });

    // Handle click on "Collapse All" button
    $('#btn-hide-all-children').on('click', function(){
        // Collapse row details
        table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
    });

    table = $('#bookings_table').DataTable({
              "responsive": true,
              'columnDefs': [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ],
              "order": [[ 3, "asc" ]],
              "lengthMenu": [
                  [10, 25, 50, 100, 200, -1],
                  [10, 25, 50, 100, 200, "All"]
              ],
              "pageLength": -1,
              'ajax': 'bookings/getdata',
              'columns':[
                { 'data': 'id'},
                { 'data': 'username'},
                { 'data': 'email'},
                { 'data': 'time_from'},
                { 'data': 'time_to'},
                { 'data': 'room_number'},
                { 'data': 'nights'},
                { 'data': 'price'},
                { 'data': 'deposit'},
                { 'data': 'status'},
                { 'data': 'action', orderable:false, searchable: false}
              ]
          });

    $(('#current, #past, #all')).on('click', function(e)
    {
        e.preventDefault();
        $('.list-inline-item a').removeAttr('style');
        $(this).attr('style', 'font-weight: 700');

        let query = $(this).data('get');
        table.destroy();
        table = $('#bookings_table').DataTable({
              "responsive": true,
              'columnDefs': [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 }
              ],
              "order": [[ 3, "asc" ]],
              "lengthMenu": [
                  [10, 25, 50, 100, 200, -1],
                  [10, 25, 50, 100, 200, "All"]
              ],
              "pageLength": -1,
              'method': 'GET',
              'ajax': 'bookings/getdata' + query,
              'columns':[
                { 'data': 'id'},
                { 'data': 'username'},
                { 'data': 'email'},
                { 'data': 'time_from'},
                { 'data': 'time_to'},
                { 'data': 'room_number'},
                { 'data': 'nights'},
                { 'data': 'price'},
                { 'data': 'deposit'},
                { 'data': 'status'},
                { 'data': 'action', orderable:false, searchable: false}
              ],
          });
      });
  });