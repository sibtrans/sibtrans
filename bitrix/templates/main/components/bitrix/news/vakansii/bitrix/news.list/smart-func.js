

function click_item() {
    $('.item0').on('click', function () {
        if ($('.item_detail0').css('display') === 'none') {

            $('.item_detail0').show()
        } else if ($('.item_detail0').css('display') !== 'none') {

            $('.item_detail0').hide()
        }
    });
}