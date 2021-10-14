import Form from "../../components/form.js";

let EDIT_FORM_ID = '#edit-topic-form';
let UPDATE_FORM_ID = '#update-topic-form';
let TOPIC_CONTENT_ID = "#topic-content";

let isValid = false;

$(EDIT_FORM_ID).on('submit', (event) => {
    event.preventDefault();
    editTopicHandler(EDIT_FORM_ID, TOPIC_CONTENT_ID, UPDATE_FORM_ID);
});

async function editTopicHandler(editFormId, topicContentId, updateFormId){
    let updateFormView = await Form.xhrAction(editFormId);
    $(topicContentId).html(updateFormView);
    
    $(updateFormId).on('submit', (event) => {
        event.preventDefault();
        updateTopicHandler(updateFormId, topicContentId);
    });
}

async function updateTopicHandler(updateFormId, topicContentId){
    if(!isValid){
        let description = $(topicContentId).find('[name=fake-description]').html().trim();
        $(updateFormId).find('[name=description]').val(description);

        isValid = await Form.xhrValidate(updateFormId);
        console.log('validation: ' + isValid);
        if(isValid){
            $(updateFormId).trigger('submit');
        }
    }
    else{
        let updatedTopicView = await Form.xhrAction(updateFormId);
        $(topicContentId).html(updatedTopicView);
        isValid = false;
    }
}