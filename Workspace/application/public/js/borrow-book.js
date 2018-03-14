Date.prototype.addDays = function(days) {
    this.setDate(this.getDate() + parseInt(days));
    return this;
};

$(function () {
    $('body').on('click', '#check-register-btn', function () {
        $('#error-message').html('');
        var req = {};
        req['user_name'] = $('#user_name').val();
        req['book_title'] = $('#book_title').val();
        req['book_number'] = $('#book_number').val();

        $.ajax({
            url: '/borrow-book/create',
            type: 'GET',
            data: req,
            success: function (data) {
                var reg_date = new Date(data.borrowRecord['created_at']);
                var reg_day = ('0'+reg_date.getDate()).slice(-2);
                var reg_month = ('0'+(reg_date.getMonth()+1)).slice(-2);
                var current_time = new Date();
                var current_day = ('0'+current_time.getDate()).slice(-2);
                var current_month = ('0'+(current_time.getMonth()+1)).slice(-2);
                var expired_date = (new Date()).addDays(14);
                var expired_day = ('0'+expired_date.getDate()).slice(-2);
                var expired_month = ('0'+(expired_date.getMonth()+1)).slice(-2);

                $('#book_title').val(data.book['title']);
                $('#book_number').val(data.book['book_number']);

                $('#card_number').val(data.borrowCardNumber);
                $('#copy_number').val(data.copyNumber);
                $('#register_date').val(reg_date.getFullYear() + '-' + reg_month + '-' + reg_day);
                $('#status').val(data.borrowRecord['status']);
                $('#status_before').val(data.statusBefore);
                $('#borrow_record_id').val(data.borrowRecord['id']);
                $('#lent_date').val(current_time.getFullYear() + '-' + current_month + '-' + current_day);
                $('#expired_date').val(expired_date.getFullYear() + '-' + expired_month + '-' + expired_day);
            },
            error: function (data) {
                $('#card_number').val('');
                $('#copy_number').val('');
                $('#register_date').val('');
                $('#status').val('');
                $('#status_before').val('');
                $('#borrow_record_id').val('');
                $('#lent_date').val('');
                $('#error-message').append('<span class="col-sm-12 alert alert-danger">'
                    + $.parseJSON(data.responseText).message + '</span>');
            }
        })
    });
});