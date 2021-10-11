import Form from "../components/form.js";

$('#create-topic-submit').on('click', () => {
    Form.validate('create-topic-form');
})