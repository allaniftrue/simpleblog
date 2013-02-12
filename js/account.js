$(document).ready(function(){
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
                                                url: [base_url,'admin/settings/change_password'].join(''),
                                                dataType:'json',
                                                data: {
                                                    oldpassword:$('#oldpassword').val(),
                                                    newpassword:$('#newpassword').val()
                                                },
                                                success: function(response) {
                                                    $('.modal-body').empty().append(['<p>',response.message,'</p>'].join(''));
                                                    $('label.ok').remove();
                                                    $('#myModal').modal("show");
                                                    console.log(response);
                                                },
                                                error: function(xhr) {
                                                    console.log(xhr);
                                                    $('.modal-body').empty().append("Unable to process your request");
                                                    $('#myModal').modal("show");
                                                }
                                        });
                                        return false;
                                },
                                // set new class to error-labels to indicate valid fields
                                success: function(label) {
                                        // set &nbsp; as text for IE
                                        label.html("&nbsp;").addClass("ok");
                                }
        });
});