var saveButton = document.getElementById('form-submit');
var cancelButton = document.getElementById('form-cancel');

saveButton.disabled = true;

// initializing editors
var titleEditor = new MediumEditor('.title-editable', {
    disableToolbar: true,
    disablePlaceholders: true,
    buttonLabels: 'fontawesome'
});

var bodyEditor = new MediumEditor('.body-editable', {
    disablePlaceholders: true,
    buttonLabels: 'fontawesome'
});

$('.title-editable').on('input', function() {
    saveButton.disabled = false;
    $(cancelButton).removeClass('disabled');
});

$('.body-editable').on('input', function() {
    saveButton.disabled = false;
    $(cancelButton).removeClass('disabled');
});


$('body').on('click', '#form-submit', function(e) {
    e.preventDefault();
    //get inputted values
    $title = titleEditor.serialize();
    $body = bodyEditor.serialize();
    //set hidden form fields to be values inputted to clever editor divs
    document.getElementById('post-form-title').value = $title['post-title']['value'];
    document.getElementById('post-form-body').value = $body['post-body']['value'];
    //submit the form
    document.getElementById('post-form').submit();
});