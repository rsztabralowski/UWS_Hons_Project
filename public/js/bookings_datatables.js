$(document).ready(function(){
    let table = '';

    $('#current').attr('style', 'font-weight: 700');

    table = $('#bookings_table').DataTable({
              'processing': true,
              "responsive": true,
              "order": [[ 2, "asc" ]],
              "lengthMenu": [
                  [10, 25, 50, 100, 200, -1],
                  [10, 25, 50, 100, 200, "All"]
              ],
              "pageLength": -1,
              'ajax': 'bookings/getdata',
              'columns':[
                  { 'data': 'username'},
                  { 'data': 'email'},
                  { 'data': 'time_from'},
                  { 'data': 'time_to'},
                  { 'data': 'room_number'},
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
              'processing': true,
              "responsive": true,
              "order": [[ 2, "asc" ]],
              "lengthMenu": [
                  [10, 25, 50, 100, 200, -1],
                  [10, 25, 50, 100, 200, "All"]
              ],
              "pageLength": -1,
              'method': 'GET',
              'ajax': 'bookings/getdata' + query,
              'columns':[
                  { 'data': 'username'},
                  { 'data': 'email'},
                  { 'data': 'time_from'},
                  { 'data': 'time_to'},
                  { 'data': 'room_number'},
                  { 'data': 'action', orderable:false, searchable: false}
              ]
          });
      });
  });