$(document).ready(function(){
    
    /*initialize tinymce wysiwyg*/
    tinyMCE.init({
        mode : "textareas",
        content_css: [base_url,"css/content.css"].join(''),
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        plugins:"autoresize",
        onchange_callback: function(editor) {
                tinyMCE.triggerSave();
                $("#" + editor.id).valid();
        }
    });
    
    var addValidator = $("#entry-form").submit(function() {
        tinyMCE.triggerSave();
    }).validate({
        ignore: "",
        rules: {
                title: "required",
                blogentry:"required"
        },
        errorPlacement: function(error, element) {
                element.parent().find('label:first').removeClass('ok').append(error);
        },
        submitHandler: function() {
                $('#savecontent').button('loading');
                var request = $.ajax({
                        type: 'POST',
                        url: [base_url,"admin/posts/add"].join(''),
                        dataType:"json",
                        data:{title:$('#title').val(),blogentry:$('#blogentry').val()}
                });
                    
                request.done(function(response) {
                    $('#myModalLabel').empty().append('Result');
                    $('.modal-body').empty().append(['<p>',response.message,'</p>'].join(''));
                    $('#myModal').modal('show');
                    $('#blogentry').tinymce().focus();
                    $('#savecontent').button('reset');
                    if(response.status == 1) {
                        tinyMCE.activeEditor.setContent('');
                        $('#title').val('');
                        $('label').remove('.error');
                    }
                    return false;
                });
                
                request.fail(function() {
                    $('#myModalLabel').empty().append('Error');
                    $('.modal-body').empty().append('<p>Unable to process request</p>');
                    $('#myModal').modal('show');
                    $('#blogentry').tinymce().focus();
                    $('#savecontent').button('reset');
                });
        },
        success: function(label) {
                label.html("&nbsp;").addClass("ok");
        }
    });    
    
    addValidator.focusInvalid = function() {
            if(this.settings.focusInvalid) {
                    try {
                            var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
                            if (toFocus.is("textarea")) {
                                    tinyMCE.get(toFocus.attr("id")).focus();
                            } else {
                                    toFocus.filter(":visible").focus();
                            }
                    } catch(e) {
                            // ignore IE throwing errors when focusing hidden elements
                    }
            }
    } 
});