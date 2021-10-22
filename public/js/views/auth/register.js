import Form from "../../components/form.js";

const REGISTER_FORM = '#register-form';

$(document).on('submit', REGISTER_FORM, tryRegister);

async function tryRegister(event){
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