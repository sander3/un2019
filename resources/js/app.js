
require('./bootstrap');

$(function () {
    $('button[type="submit"]').click(function (e) {
        $('form').submit();

        $(this).prop('disabled', true);

        $('#phonenumber').remove();

        setInterval(function () {
            $('.pipeline .invisible:first').removeClass('invisible');
        }, 800);
    });
});
