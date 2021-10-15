$('.modal').on('show.bs.modal', function(){
    let textareas = $(this).find('textarea');

    $.each(textareas, function(){
        let initHeight = $(this).attr('initHeight');

        $(this).css({
            'min-height': initHeight + 'px',
        });
    });
})

$('.modal').on('hidden.bs.modal', function(){
    $(this).find('.invalid-feedback').remove();
    $(this).find('.is-invalid').removeClass('is-invalid');
    $(this).find('form').trigger('reset');
})