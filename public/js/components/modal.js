$('.modal').on('show.bs.modal', (event) => {
    let modal = $(event.target);
    let textareas = $(modal).find('textarea');

    $.each(textareas, (index, textarea) => {
        let initHeight = $(textarea).attr('initHeight');
        $(textarea).height(initHeight);
    });
})

$('.modal').on('hidden.bs.modal', (event) => {
    let modal = $(event.target);
    
    $(modal).find('.invalid-feedback').remove();
    $(modal).find('.is-invalid').removeClass('is-invalid');
    $(modal).find('form').trigger('reset');
})