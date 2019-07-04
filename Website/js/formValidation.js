$(document).ready(function() {
    $("#passwordchange-form").validate({
        rules: {
            current_password: 'required',
            newPassword:{
                required: true,
                minlength:6,
                // max:15,
            },
            newCheckPassword:{
                required: true,
                equalTo:'#newPassword',
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $("#form").validate({
        rules: {
            title: 'required',
            description: 'required',
            fileToUpload:{
                required: true,
                accept:"jpg,png,jpeg,gif",
                filesize:500

            }
        },
        messages: {
            title: 'This field is required.',
            description: 'This field is required.',
            fileToUpload: {
                required: "Promo image is required.",
                accept: "Only image type jpg/png/jpeg/gif is allowed"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#editpromoform").validate({
        rules: {
            title: 'required',
            description: 'required',
            fileToUpload:{
                accept:"jpg,png,jpeg,gif",
                filesize:500
            }
        },
        messages: {
            title: 'This field is required.',
            description: 'This field is required.',
            fileToUpload: {
                required: "Promo image is required.",
                accept: "Only image type jpg/png/jpeg/gif is allowed"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });


    $("#form-register-customer").validate({
        rules: {
            fname: 'required',
            lname: 'required',
            email:{
                required:true,
                email:true
            },
            
            username:{
                required: true,
                minlength:6
            },
            password:{
                required: true,
                minlength:6


            },
            confirm:{
                required: true,
                equalTo: "#password"


            }

        },
        messages: {
            fname: 'This field is required',
            lname: 'This field is required',
            email: {
                required: 'This field is required'

            },
            username: {
                required:'This field is required',
                minlength: 'At least 6 characters are required.'
            },

            password: {
                required: 'This field is required'
            },
            confirm: {
                required: "This field is required."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#form-register-promoter").validate({
        rules: {
            promoter_name: 'required',
            email:{
                required:true,
                email:true
            },
            username: 'required',
            username:{
                required: true,
                minlength:6
            },
            password:{
                required: true,
                minlength:6
            },

            confirm:{
                required: true,
                equalTo: "#password"
            },

            phone_number:{
                required: true,
                // phone:true
                phoneSL:true
            }

        },
        messages: {
            promoter_name: 'This field is required',
            email: {
                required: 'This field is required'

            },
            
            username: {
                required: 'This field is required',
                minlength: 'At least 6 characters are required.'

            },
            password: {
                required: 'This field is required'


            },
            confirm: {
                required: "This field is required."


            },
            phone_number: {
                required: 'This field is required',
                // phone: "Enter a valid phone number"
                phoneSL: "Enter a valid phone number"

            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#changeemailForm").validate({
        rules: {
            current_password: 'required',
            email:{
                required: true,
                email:true,
                // max:15,
            },

        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#changeWebsiteForm").validate({
        rules: {
            current_password: 'required',
            website:{
                required: true,

            },

        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#changeFBForm").validate({
        rules: {
            current_password: 'required',
            fb:{
                required: true,

            },

        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param*1024)
    }, 'File size must be less than {0} KB');

    jQuery.validator.addMethod("phoneSL", function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^(?:0|94|\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(0|2|3|4|5|7|9)|7(0|1|2|5|6|7|8)\d)\d{6}$/);
        // phone_number.match(/^7|0|(?:\+94)[0-9]{9,10}$/)&&phone_number.length<=10;
    }, "Please specify a valid phone number");
    
    $('.deletemember').click(function() {

        if (confirm('Are you sure?')) {
            var url = $(this).attr('href');

            location.href=url;
        }
    });

    $('.saveconfirm').click(function() {

        if (confirm('Save edits?')) {
            var url = $(this).attr('href');

            location.href=url;
        }
    });

    

});


// Validating Image
//
// $('input[type="submit"]').prop("disabled", true);
// var a=0;
// //binds to onchange event of your input field
// $('#fileToUpload').bind('change', function() {
//     if ($('input:submit').attr('disabled',false)){
//         $('input:submit').attr('disabled',true);
//     }
//     var ext = $('#fileToUpload').val().split('.').pop().toLowerCase();
//     if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
//         $('#error1').slideDown("slow");
//         $('#error2').slideUp("slow");
//         a=0;
//     }else{
//         var picsize = (this.files[0].size);
//         if (picsize > 1000000){
//             $('#error2').slideDown("slow");
//             a=0;
//         }else{
//             a=1;
//             $('#error2').slideUp("slow");
//         }
//         $('#error1').slideUp("slow");
//         if (a==1){
//             $('input:submit').attr('disabled',false);
//         }
//     }
// });

