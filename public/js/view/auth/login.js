import Form from "../../components/form.js";

$('#login-submit').on('click', () => {
    Form.validate('login-form');
})