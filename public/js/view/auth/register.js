import Form from "../../components/form.js";

$('#register-submit').on('click', () => {
    Form.validate('register-form');
})