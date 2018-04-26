$(function () {
    $("#open-register-modal").on('click', function () {
        if ($('#borrow-modal').find('.modal-body table tbody tr').length) {
            $('#borrow-modal').modal('show');
        } else {
            alert("Please select at least one book to register!");
        }
    });

    $('body').on('change', '.book-list input.book-selector', function () {
        if ($(this).is(':checked')) {
            var clone = $(this).parent().parent().clone();
            $('#borrow-modal').find('.modal-body table tbody').append(clone);
        } else {
            var old = $('#borrow-modal').find('input.book-selector[value="' + $(this).val() + '"]');
            old.parent().parent().remove();
        }
    }).on('click', '.pagination-btn', function () {
        var req = {};
        req['page'] = $(this).data('page');

        $.ajax({
            url: '/register-to-borrow-book/create',
            data: req,
            type: 'GET',
            success: function (data) {
                $('#book-list').html(data.html);
                $('#borrow-modal').find('input.book-selector').each(function (key, input) {
                    $('#book-list').find('input.book-selector[value="' + $(input).val() + '"]').prop('checked', true);
                });
            }
        });
    });

    $("#open-borrow-modal-button").on('click', function () {
        var bookIDs = [];

        $('#borrow-modal').find('input.book-selector:checked').each(function (key, input) {
            bookIDs[key] = input.value;
        });

        $("input[name='book-ids']").val(JSON.stringify(bookIDs))
            .parent().submit();
    });
});