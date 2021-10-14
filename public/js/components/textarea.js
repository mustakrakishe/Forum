function resize(textarea){
    $(textarea).css({
        'height': $(textarea).prop('scrollHeight'),
    });
}

export default resize;