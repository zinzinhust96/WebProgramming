$(function () {
    $('body').on('click', '#check-borrow-record-btn', function () {
        $('#error-message').html('');
        var req = {};
        req['user_name'] = $('#user_name').val();
        req['card_number'] = $('#card_number').val();
        req['book_title'] = $('#book_title').val();
        req['book_number'] = $('#book_number').val();
        req['copy_number'] = $('#copy_number').val();

        $.ajax({
            url: '/return-book/create',
            type: 'GET',
            data: req,
            success: function (data) {
                var current_time = new Date();
                var current_day = ('0' + current_time.getDate()).slice(-2);
                var current_month = ('0' + (current_time.getMonth() + 1)).slice(-2);
                var lent_date = new Date(data.borrowRecordInfo['lent_date']);
                var lent_day = ('0' + lent_date.getDate()).slice(-2);
                var lent_month = ('0' + (lent_date.getMonth() + 1)).slice(-2);
                var expired_date = new Date(data.borrowRecordInfo['expired_date']);
                var expired_day = ('0' + expired_date.getDate()).slice(-2);
                var expired_month = ('0' + (expired_date.getMonth() + 1)).slice(-2);

                $('#user_name').val(data.userName);
                $('#card_number').val(data.cardNumber);
                $('#book_title').val(data.bookTitle);
                $('#book_number').val(data.bookNumber);
                $('#copy_number').val(data.copyNumber);
                $('#borrow_record_id').val(data.borrowRecordInfo['borrow_record_id']);
                $('#status_before').val(data.borrowRecordInfo['status_before']);
                $('#lent_date').val(lent_date.getFullYear() + '-' + lent_month + '-' + lent_day);
                $('#expired_date').val(expired_date.getFullYear() + '-' + expired_month + '-' + expired_day);
                $('#returned_date').val(current_time.getFullYear() + '-' + current_month + '-' + current_day);
                $('#borrow_fee').val(data.borrowRecordInfo['borrow_fee']);
                $('#pre_paid').val(data.borrowRecordInfo['pre_paid']);
            },
            error: function (data) {
                $('#borrow_record_id').val('');
                $('#status_before').val('');
                $('#lent_date').val('');
                $('#expired_date').val('');
                $('#returned_date').val('');
                $('#borrow_fee').val('');
                $('#pre_paid').val('');
                $('#error-message').append('<span class="col-sm-12 alert alert-danger">'
                    + $.parseJSON(data.responseText).message + '</span>');
            }
        })
    });
});
