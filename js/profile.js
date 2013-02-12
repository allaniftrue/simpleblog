$(document).ready(function(){
    /* tooltips */
    $('#tooltip').tooltip({
            placement:'bottom'
    });

    $('#avatar-holder,#tooltip-right').tooltip({
            placement:'right'
    });

    $('#contact,#newpassword').tooltip({
        placement:'right',
        trigger:'focus'
    });

    $('#avatar-holder').on({
            mouseenter: function() {
                    $('#uploader').css({
                            "display":"inline",
                            "z-index":10
                    });
            },
            mouseleave: function() {
                    $('#uploader').hide();
            }
    });
    
    /* file upload */
    $fub = $('#uploader');
    $messages = $('#messages');
    var uploader = new qq.FileUploaderBasic({
          button: $fub[0],
          action: base_url + 'admin/settings/upload',
          debug: false,
          allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
          sizeLimit: 204800, // 200 kB = 200 * 1024 bytes
          onSubmit: function(id, fileName) {
            $messages.append('<div id="file-' + id + '" class="alert" style="margin: 20px 0 0"></div>') 
          },
          onUpload: function(id, fileName) {
            $('#file-' + id).addClass('alert-info')
                            .html('<img src="'+base_url+'img/preloader.gif" alt="Initializing. Please hold."> ' +
                                  'Initializing ' +
                                  '“' + fileName + '”')
          },
          onProgress: function(id, fileName, loaded, total) {
            if (loaded < total) {
              progress = Math.round(loaded / total * 100) + '% of ' + Math.round(total / 1024) + ' kB';
              $('#file-' + id).removeClass('alert-info')
                              .html('<img src="'+base_url+'img/preloader.gif" alt="In progress. Please hold."> ' +
                                    'Uploading ' +
                                    '“' + fileName + '” ' +
                                    progress)
            } else {
              $('#file-' + id).addClass('alert-info')
                              .html('<img src="'+base_url+'img/preloader.gif" alt="Saving. Please hold."> ' +
                                    'Saving ' +
                                    '“' + fileName + '”')
            }
          },
          onComplete: function(id, fileName, responseJSON) {
            if (responseJSON.status === "Success") {

              $('#file-' + id).removeClass('alert-info')
                              .addClass('alert-success')
                              .html('<i class="icon-ok"></i> ' + 'Successfully saved '+'“' + fileName + '”')
                              .delay(3000).hide("slow");

              $('.img-polaroid').attr("src",responseJSON.filename);
              $('#uploader').hide();
              $('#avatar-holder').tooltip("hide")

            } else {
              $('#file-' + id).removeClass('alert-info')
                              .addClass('alert-error')
                              .html('<i class="icon-exclamation-sign"></i> ' +
                                    'Error with ' +
                                    '“' + fileName + '”: ' +
                                    responseJSON.error)
            }
          }
        }) /* end of file upload */

        /* validate profile*/
        $("#profileform").validate({
                                rules: {
                                        firstname: "required",
                                        lastname: "required",
                                        email: {
                                                required: true,
                                                email: true
                                        },
                                        contact: {
                                                required: true,
                                                digits: true
                                        },
                                        address: "required"
                                },
                                messages: {
                                        firstname: "Enter your firstname",
                                        lastname: "Enter your lastname",
                                        email: {
                                                required: "Please enter a valid email address",
                                                minlength: "Please enter a valid email address"
                                        },
                                        contact:"Enter a valid contact number",
                                        address:"Enter your full address"
                                },
                                errorPlacement: function(error, element) {
                                        element.parent().find('label:first').append(error);
                                },
                                submitHandler: function() {
                                        $.ajax({
                                                type:'POST',
                                                url:base_url+'admin/settings/save_profile',
                                                dataType:'json',
                                                data: {
                                                    lastname:$('#lastname').val(),
                                                    firstname:$('#firstname').val(),
                                                    email:$('#email').val(),
                                                    contact:$('#contact').val(),
                                                    address:$('#address').val()
                                                },
                                                success: function(response) {
                                                    $('.modal-body').empty().append('<p>'+response.message+'')
                                                    $('label.ok').remove()
                                                },
                                                error: function(response) {
                                                    $('.modal-body').empty().append(response.message)
                                                }
                                        });
                                        $('#myModal').modal("show");
                                        return false;
                                },
                                // set new class to error-labels to indicate valid fields
                                success: function(label) {
                                        // set &nbsp; as text for IE
                                        label.html("&nbsp;").addClass("ok");
                                }
        });//profile save
});