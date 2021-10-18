import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

let EDIT_TOPIC_FORM = '#edit-topic-form';
let UPDATE_TOPIC_FORM = '#update-topic-form';
let TOPIC_SHOW_COMPONENT = "#topic-show-component";
let TOPIC_EDIT_COMPONENT = "#topic-edit-component";
let TOPIC_DESCRIPTION_TEXTAREA = "#topic-description";

let CREATE_COMMENT_FORMS = 'form[name=create-comment-form]';
let STORE_COMMENT_FORMS = 'form[name=store-comment-form]';
let COMMENT_COUNT_CONTAINER = '#comment-count';
let COMMENT_CONTAINERS = 'div[name=comment]';

$(document).on('submit', EDIT_TOPIC_FORM, editTopicHandler);
$(document).on('submit', UPDATE_TOPIC_FORM, updateTopicHandler);
$(document).on('reset', UPDATE_TOPIC_FORM, cancelTopicEditHandler);

$(document).on('submit', CREATE_COMMENT_FORMS, createCommentHandler);
$(document).on('submit', STORE_COMMENT_FORMS, storeCommentHandler);
$(document).on('reset', STORE_COMMENT_FORMS, cancelCommentCreateHandler);

async function editTopicHandler(event) {
    event.preventDefault();

    let updateFormView = await Form.xhrAction(EDIT_TOPIC_FORM);

    $(TOPIC_SHOW_COMPONENT).after(updateFormView);
    $(TOPIC_SHOW_COMPONENT).attr('hidden', 'hidden');

    Textarea.resize(TOPIC_DESCRIPTION_TEXTAREA);
}

async function updateTopicHandler(event){
    event.preventDefault();

    let isValid = await Form.xhrValidate(UPDATE_TOPIC_FORM);

    if (isValid) {
        let updatedTopicView = await Form.xhrAction(UPDATE_TOPIC_FORM);
        $(TOPIC_EDIT_COMPONENT).after(updatedTopicView);
        $(TOPIC_EDIT_COMPONENT).remove();
        $(TOPIC_SHOW_COMPONENT).remove();
    }
}

function cancelTopicEditHandler() {
    $(TOPIC_EDIT_COMPONENT).remove();
    $(TOPIC_SHOW_COMPONENT).removeAttr('hidden');
}

async function createCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let createCommentView = await Form.xhrAction(form);
    
    $(document).find(':focus').trigger('blur');
    $(COMMENT_COUNT_CONTAINER).after(createCommentView);
}

async function storeCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let isValid = await Form.xhrValidate(form);

    if(isValid){
        let newCommentView = await Form.xhrAction(form);

        $(form).closest(COMMENT_CONTAINERS).after(newCommentView);
        $(form).closest(COMMENT_CONTAINERS).remove();
    }
}

function cancelCommentCreateHandler(event) {
    $(event.target).closest(COMMENT_CONTAINERS).remove();
}