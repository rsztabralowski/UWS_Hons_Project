$(document).ready(function()
{
    let d = new Date();
    let month = d.getMonth() + 1;
    if(month >= 1 && month <=9) month = '0'+ month;
    let year = d.getFullYear();

    $('[name=year]').val(year);
    $('[name=month]').val(month);

    $.ajax({
        url: 'calendar/getallbookings',
        data: {
            year: year,
            month: month
        },
        method: 'GET',
        success: function(result)
        {
            $('#selected_time').html('<h2>'+$('#month option:selected').text()+ ' ' +$('#year option:selected').text()+'</h2>');
            $('.calendar').html(result);
           
            $('.weekdays').each(function(){
                if($(this).html() == "Sat" || $(this).html() == "Sun") 
                {
                    $(this).css("background-color", "darkgray");
                }
            });
        }
    });

    $('#year,#month').on('change', function(){
        
        let year = $('#year').val();
        let month = $('#month').val();

        $.ajax({
            url: 'calendar/getallbookings',
            data: {
                year: year,
                month: month
            },
            method: 'GET',
            success: function(result)
            {
                $('#selected_time').html('<h2>'+$('#month option:selected').text()+ ' ' +$('#year option:selected').text()+'</h2>');
                $('.calendar').html(result);

                $('.weekdays').each(function(){
                    if($(this).html() == "Sat" || $(this).html() == "Sun") 
                    {
                        $(this).css("background-color", "darkgray");
                    }
                });
            }
        });
    });
});