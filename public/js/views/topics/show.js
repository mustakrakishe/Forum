import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

let EDIT_TOPIC_FORM = '#edit-topic-form';
let UPDATE_TOPIC_FORM = '#update-topic-form';
let TOPIC_SHOW_COMPONENT = "#topic-show-component";
let TOPIC_EDIT_COMPONENT = "#topic-edit-component";
let TOPIC_DESCRIPTION_TEXTAREA = "#topic-description";

let CREATE_COMMENT_FORMS = 'form[name=create-comment-form]';
let STORE_COMMENT_FORMS = 'form[name=store-comment-form]';
const COMMENT_SUB_TREES = '[name=comment-sub-tree]';
const TOPIC_COMMENTS_CONTAINER = "#topic-comments-container"
const COMMENT_CONTAINERS = '[name=comment-container]';
let DELETE_COMMENT_MODAL = '#delete-comment-modal';
let DELETE_COMMENT_FORM = 'form#delete-comment-form';

let commentToDeleteContainer = null;

$(document).on('submit', EDIT_TOPIC_FORM, editTopicHandler);
$(document).on('submit', UPDATE_TOPIC_FORM, updateTopicHandler);
$(document).on('reset', UPDATE_TOPIC_FORM, cancelTopicEditHandler);

$(document).on('submit', CREATE_COMMENT_FORMS, createCommentHandler);
$(document).on('submit', STORE_COMMENT_FORMS, storeCommentHandler);
$(document).on('reset', STORE_COMMENT_FORMS, cancelCommentCreateHandler);
$(document).on('show.bs.modal', DELETE_COMMENT_MODAL, fillDeleteCommentModal);
// $(document).on('hide.bs.modal', DELETE_COMMENT_MODAL, function(){ commentToDeleteContainer = null; });
$(document).on('submit', DELETE_COMMENT_FORM, deleteCommentHandler);

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
    let parentSubTree = $(form).closest(COMMENT_SUB_TREES);

    let createFormDestination = $(parentSubTree).find(COMMENT_SUB_TREES).first()
    if($(createFormDestination).length == 0){
        createFormDestination = TOPIC_COMMENTS_CONTAINER;
    }

    let createForm = await Form.xhrAction(form);
    
    $(document).find(':focus').trigger('blur');
    $(createFormDestination).prepend(createForm);
}

async function storeCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let isValid = await Form.xhrValidate(form);

    if(isValid){
        let createdComment = await Form.xhrAction(form);

        let currentCommentContainer = $(form).closest(COMMENT_CONTAINERS)
        $(currentCommentContainer).replaceWith(createdComment);
    }
}

function cancelCommentCreateHandler(event) {
    $(event.target).closest(COMMENT_CONTAINERS).remove();
}

function wrapCommentView(commentView, pl){
    $(commentView).wrap('<div name="' + COMMENT_CONTAINER_NAME + '" style="padding-left: ' + pl + 'px;"></div>');
}

function fillDeleteCommentModal(event){
    let deleteButton = $(event.relatedTarget);
    let commentId = deleteButton.val();

    commentToDeleteContainer = $(deleteButton).closest(commentContainers);
    
    let action = $(DELETE_COMMENT_FORM).attr('action');
    let commentIdPos = action.lastIndexOf('/') + 1;
    let newUrl = action.slice(0, commentIdPos) + commentId;
    $(DELETE_COMMENT_FORM).attr('action', newUrl);
}

async function deleteCommentHandler(event){
    event.preventDefault();


    await Form.xhrAction(DELETE_COMMENT_FORM);

    $(commentToDeleteContainer).remove();

    $(DELETE_COMMENT_MODAL).modal('toggle');
}