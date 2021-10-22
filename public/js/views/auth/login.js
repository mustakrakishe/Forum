import Form from "../../components/form.js";

const LOGIN_FORM = '#loginForm';

$(document).on('submit', LOGIN_FORM, tryLogin);

async function tryLogin(event){
    event.preventDefault();

    let form = event.target;
    let url = $(form).attr('action');
    let data = $(form).serialize();

    let errors = await $.post(url, data);

    if(errors){
        Form.formatWithErrors(form, errors);
    }
    else{
        location.reload();
    }
}