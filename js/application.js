!function ($) {

	$(function(){
                
                /* Global Variables */
                var newURL = window.location.protocol + "://" + window.location.host + "/" + window.location.pathname
                var pathArray = window.location.pathname.split( '/' )
            
		/* tooltips */
		$('#tooltip').tooltip({
			placement:'bottom'
		})

		$('#avatar-holder,#tooltip-right').tooltip({
			placement:'right'
		})
                
                $('#contact,#newpassword').tooltip({
                    placement:'right',
                    trigger:'focus'
                })

		$('#avatar-holder').live({
			mouseenter: function() {
				$('#uploader').css({
					"display":"inline",
					"z-index":10
				});
			},
			mouseleave: function() {
				$('#uploader').hide();
			}
		})


		/* file upload */
                $fub = $('#uploader');
                $messages = $('#messages');
                var uploader = new qq.FileUploaderBasic({
                      button: $fub[0],
                      action: base_url + 'settings/upload',
                      debug: false,
                      allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
                      sizeLimit: 204800, // 200 kB = 200 * 1024 bytes
                      onSubmit: function(id, fileName) {
                        $messages.append('<div id="file-' + id + '" class="alert" style="margin: 20px 0 0"></div>') 
                      },
                      onUpload: function(id, fileName) {
                        $('#file-' + id).addClass('alert-info')
                                        .html('<img src="client/loading.gif" alt="Initializing. Please hold."> ' +
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
                                                            url:base_url+'settings/save_profile',
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
                                                    })
                                                    $('#myModal').modal("show");
                                            },
                                            // set new class to error-labels to indicate valid fields
                                            success: function(label) {
                                                    // set &nbsp; as text for IE
                                                    label.html("&nbsp;").addClass("ok");
                                            }
                    });//profile save
                    
                    
                    /*account settings*/
//                    if(pathArray[3] === 'admin') {
//                        $.getScript(base_url+'js/jquery.validate.password.js', function(data, textStatus, jqxhr) {
//                            
//                            $.validator.passwordRating.messages = {
//                                    "too-short": "Too short",
//                                    "very-weak": "Very Weak",
//                                    "weak": "Weak",
//                                    "good": "Good",
//                                    "strong": "Strong"
//                            }
//                            
//                            
//                            if(textStatus === 'success') {
//                                $("#newpassword").validate()
//                            }
//                        });
//                    }
                    
                    
                    
                    $("#accountform").validate({
                                            rules: {
                                                    oldpassword: "required",
                                                    newpassword: {
                                                            required: true,
                                                            minlength:8
                                                    },
                                                    newpassword_c: {
                                                            required:true,
                                                            equalTo: "#newpassword"
                                                    }
                                            },
                                            messages: {
                                                    oldpassword: "Enter your old password",
                                                    newpassword: {
                                                        required:"Enter your new password",
                                                        maxlength:"Enter at least {0} characters"
                                                    },
                                                    newpassword_c: {
                                                            required:"Confirm your new password",
                                                            equalTo: "Password mismatch"
                                                    }
                                            },
                                            errorPlacement: function(error, element) {
                                                    element.parent().find('label:first').append(error);
                                            },
                                            submitHandler: function() {
                                                
                                                    $.ajax({
                                                            type:'POST',
                                                            url:base_url+'settings/change_password',
                                                            dataType:'json',
                                                            data: {
                                                                oldpassword:$('#oldpassword').val(),
                                                                newpassword:$('#newpassword').val()
                                                            },
                                                            success: function(response) {
                                                                $('.modal-body').empty().append('<p>'+response.message+'')
                                                                $('label.ok').remove()
                                                            },
                                                            error: function(response) {
                                                                $('.modal-body').empty().append(response.message)
                                                            }
                                                    })
                                                    $('#myModal').modal("show");
                                            },
                                            // set new class to error-labels to indicate valid fields
                                            success: function(label) {
                                                    // set &nbsp; as text for IE
                                                    label.html("&nbsp;").addClass("ok");
                                            }
                    });
	})
}(window.jQuery)
