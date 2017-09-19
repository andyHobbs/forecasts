$(document).ready(function () {
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var game = button.data('game');
        var modal = $(this);
        modal.find('.modal-body input.game-attr').val(game);
    });


    $("#rateForm").submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize()
        })
            .done(function (data) {
                if (typeof data.message !== 'undefined') {
                    var modal = $('#exampleModal');
                    modal.modal('hide');
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if (typeof jqXHR.responseJSON !== 'undefined') {
                    if (jqXHR.responseJSON.hasOwnProperty('form')) {
                        $('#form_body').html(jqXHR.responseJSON.form);
                    }

                    $('.form_error').html(jqXHR.responseJSON.message);

                } else {
                    alert(errorThrown);
                }

            });
    });
});