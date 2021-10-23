import Form from "../../components/form.js";

$(document).on('submit', 'form#login-form', tryLogin);

async function tryLogin(event){
    event.preventDefault();

    let form = event.target;
    
    let errors = await Form.xhtAction(form, true);

    if(!errors){
        location.reload();
    }
}