$('.modal').on('show.bs.modal', (event) => {
    let modal = $(event.target);
    let textareas = $(modal).find('textarea');

    $.each(textareas, (index, textarea) => {
        let initHeight = $(textarea).attr('initHeight');
        $(textarea).height(initHeight);
    });
})