$(function () {
    var btnExport = false;
    var firstName;
    var lastName;
    var age;
    var place;
    var perpage;
    var page;

    var get_data = function (firstName = '', lastName='', age='', place='', page = 1, perpage = 10) {
        $.ajax({
            url: gUrl + 'table_item.php',
            type: 'get',
            data: {
                first_name: firstName,
                last_name: lastName,
                age: age,
                place: place,
                page: page,
                perpage: perpage
            },
            beforeSend: function () {
                $('.loading').show();
            },
            complete: function () {
                $('.loading').hide();
            },
            success: function (data) {
                $('#list-data').html(data);
            }
        });
    }

    get_data();

    $('body').on('click', 'ul.pagination li a', function () {
        var is_page = $(this).attr('href');
        page = (is_page != 'javascript:void(0)' && is_page != '#') ? is_page.substring(7) : 1;
        if (is_page != 'javascript:void(0)') {
            get_data(firstName, lastName, age, place, page, perpage);
        }

    });

    var clickSearch = function () {
        firstName = $('input[name=first_name]').val();
        lastName = $('input[name=last_name]').val();
        place = $('input[name=place]').val();
        age = $('input[name=age]').val();
        perpage = $('select[name=perpage]').val();
        page = 1;
        if(btnExport){
            btnExport = false;
            return false;
        }
        get_data(firstName, lastName, age, place, page, perpage);
    }

    $('body').on('click', '#btnSearch', function () {
        clickSearch();
    });

    $('body').on('change', 'select[name=perpage]', function () {
        clickSearch();
    });


    $('#searchform').on('keypress', function (e) {
        var code = e.keycode || e.which;
        if (code == 13) {
            $('#btnSearch').trigger('click');
            return false;
        }
    });

    // export excel
    $('#btnExport').on('click', function(e){
        e.preventDefault();
        btnExport = true;
        clickSearch();
        var url = gUrl + 'export_item.php?first_name='+firstName+'&last_name='+lastName+'&age='+age+'&place='+place;
        window.open(url, '_blank');
    });
});