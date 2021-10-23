import Form from "../../components/form.js";

const REGISTER_FORM = '#register-form';

$(document).on('submit', 'form#register-form', tryRegister);

async function tryRegister(event){
    event.preventDefault();

    let form = event.target;
    
    let errors = await Form.xhtAction(form, true);

    if(!errors){
        location.reload();
    }
}