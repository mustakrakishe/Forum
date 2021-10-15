function resize(textareas){
    $(textareas).each(function(){
        $(this).css({
            'height': $(this).prop('scrollHeight'),
        });
    })
}

export default resize;