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

$('.body-editable').on('input', function() {
    $a = bodyEditor.serialize();
    $body = $a['post-body']['value'];
    $bodyField = document.getElementById('body');
    $bodyField.value = $body;
});

$('.title-editable').on('input', function() {
    $b = titleEditor.serialize();
    $title = $b['post-title']['value'];
    $titleField = document.getElementById('title');
    $titleField.value = $title;
});




/*
$(function () {
    // initializing insert image on body editor
    $('.body-editable').mediumInsert({
        editor: bodyEditor,
        images: true,
        imagesUploadScript: "{{ URL::to('upload') }}"
    });
    // deactivate editors on show view
    if ($('#hideEditor').length) {
        $('.body-editable').mediumInsert('disable');
        bodyEditor.deactivate();
        titleEditor.deactivate();
    }
});
// hiding messages
$('.error').hide().empty();
$('.success').hide().empty();

// create post
$('body').on('click', '#form-submit', function(e){
    e.preventDefault();
    var postTitle = titleEditor.serialize();
    var postContent = bodyEditor.serialize();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url : "{{ URL::action('PostsController@store') }}",
        data: { title: postTitle['post-title']['value'], body: postContent['post-body']['value'] },
        success: function(data) {
            if(data.success === false)
            {
                $('.error').append(data.message);
                $('.error').show();
            } else {
                $('.success').append(data.message);
                $('.success').show();
                setTimeout(function() {
                    window.location.href = "{{ URL::action('PostsController@index') }}";
                }, 2000);
            }
        },
        error: function(xhr, textStatus, thrownError) {
            alert('Something went wrong. Please Try again later...');
        }
    });
    return false;
});

// update post
$('body').on('click', '#form-update', function(e){
    e.preventDefault();
    var postTitle = titleEditor.serialize();
    var postContent = bodyEditor.serialize();

    $.ajax({
        type: 'PUT',
        dataType: 'json',
        url : "{{ URL::action('PostsController@update', array(Request::segment(2))) }}",
        data: { title: postTitle['post-title']['value'], body: postContent['post-body']['value'] },
        success: function(data) {
            if(data.success === false)
            {
                $('.error').append(data.message);
                $('.error').show();
            } else {
                $('.success').append(data.message);
                $('.success').show();
                setTimeout(function() {
                    window.location.href = "{{ URL::action('PostsController@index') }}";
                }, 2000);
            }
        },
        error: function(xhr, textStatus, thrownError) {
            alert('Something went wrong. Please Try again later...');
        }
    });
    return false;
});

    */