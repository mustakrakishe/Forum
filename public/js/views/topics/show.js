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
let COMMENT_CONTAINER_NAME = 'comment-container';
let DELETE_COMMENT_MODAL = '#delete-comment-modal';
let DELETE_COMMENT_FORM = 'form#delete-comment-form';

let commentContainers = 'div[name=' + COMMENT_CONTAINER_NAME + ']';
let commentToDeleteContainer = null;

$(document).on('submit', EDIT_TOPIC_FORM, editTopicHandler);
$(document).on('submit', UPDATE_TOPIC_FORM, updateTopicHandler);
$(document).on('reset', UPDATE_TOPIC_FORM, cancelTopicEditHandler);

$(document).on('submit', CREATE_COMMENT_FORMS, createCommentHandler);
$(document).on('submit', STORE_COMMENT_FORMS, storeCommentHandler);
$(document).on('reset', STORE_COMMENT_FORMS, cancelCommentCreateHandler);
$(document).on('show.bs.modal', DELETE_COMMENT_MODAL, fillDeleteCommentModal);
$(document).on('hide.bs.modal', DELETE_COMMENT_MODAL, () => { commentToDeleteContainer = null; });
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

    let createCommentView = $.parseHTML(await Form.xhrAction(form));

    $(document).find(':focus').trigger('blur');
    
    let commentPreviousContainer = COMMENT_COUNT_CONTAINER;
    let pl = 0;

    let targetComment = $(form).closest(commentContainers);
    if(targetComment.length){
        commentPreviousContainer = targetComment;
        pl = parseInt($(commentPreviousContainer).css('padding-left')) + 70;
    }

    $(commentPreviousContainer).after(createCommentView);
    wrapCommentView(createCommentView, pl);
}

async function storeCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let isValid = await Form.xhrValidate(form);

    if(isValid){
        let newCommentView = await Form.xhrAction(form);
        $(form).closest(commentContainers).html(newCommentView);
    }
}

function cancelCommentCreateHandler(event) {
    $(event.target).closest(commentContainers).remove();
}

function wrapCommentView(commentView, pl){
    $(commentView).wrap('<div name="' + COMMENT_CONTAINER_NAME + '" style="padding-left: ' + pl + 'px;"></div>');
}

function fillDeleteCommentModal(event){
    let deleteButton = $(event.relatedTarget);
    let commentId = deleteButton.val();

    commentToDeleteContainer = $(deleteButton).closest(commentContainers);
    
    let action = $(DELETE_COMMENT_FORM).attr('action');
    $(DELETE_COMMENT_FORM).attr('action', action.slice(0, -1) + commentId);
}

async function deleteCommentHandler(event){
    event.preventDefault();

    $deleteConfirmed = await Form.xhrAction(DELETE_COMMENT_FORM);
console.log($deleteConfirmed);
    if($deleteConfirmed){
        // $(commentToDeleteContainer).remove();
        // $(DELETE_COMMENT_MODAL).hide();
    }
}