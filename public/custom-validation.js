$(document).ready(function(){

  jQuery.validator.addMethod("extension", function(value, element) {
  // allow any non-whitespace characters as the host part
  return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
}, 'Please enter a valid email address.');

    $.validator.addMethod("customemail",
            function (value, element) {
                return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
            });

    $.validator.addMethod('decimal', function (value, element) {
        return this.optional(element) || /^((\d+(\\.\d{0,2})?)|((\d*(\.\d{1,2}))))$/.test(value);
    }, "");

   $.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
   }, "Please enter letters");   

   
});


//login form validation
$(function() {
 
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  var link = $('body').data('baseurl');
 
  $("form[name='auth']").validate({
    
    rules: {

      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },

    messages: {
   
      password: {
        required: "Please enter password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: {
        required: "Please enter email",
        email: "Please enter a valid email address"
      },
    },

    submitHandler: function(form) {
        form.submit();
    }
  });  

  $("form[name='forgot-auth']").validate({
    
    rules: {

      email: {
        required: true,
        email: true
      },
    },

    messages: {
   
      password: {
        required: "Please enter password",
        minlength: "Your password must be at least 5 characters long"
      },
    },

    submitHandler: function(form) {
        form.submit();
    }
  });


  //change password
  $("form[name='reset-auth']").validate({
      rules: {
          verification_code:{
              required : true,
           },
          password: {
              required: true,
              maxlength: 20,
              minlength: 6
          },
          confirm_password: {
              required: true,
              minlength: 6,
              maxlength: 20,
              equalTo: "#password"
          }
      },
      messages: {

        verification_code: {
              required: "We have sent you an OTP on the registered email id.Please enter it here to verify your account!.",
          },

          password: {
              required: "Please enter  password field.",
              maxlength: "Password maximun length should be 20 character.",
              minlength: "Password minimum length should be 6 character",
          },

          confirm_password: {
              required: "Confirm password should be equal to  password.",
              equalTo:   "Password and confirm password do not match.",
              minlength: "Confirm Password minimum length should be 6 character",
              maxlength: "Confirm Password maximun length should be 20 character.",
             
          },

      },
//          
  });


//change password
    $("#changepassword_form").validate({

        rules: {
            password:{
                required : true,
                maxlength : 20,
                minlength : 5
             },
            newPassword: {
                required: true,
                maxlength: 20,
                minlength: 6
            },
            confirmPassword: {
                required: true,
                maxlength: 20,
                minlength: 6,
                equalTo: "#newPassword"
            },
        },
        messages: {

          password: {
                required: "Please enter password field",

                maxlength: "New Password maximum length should be 20 character",

                minlength: "Your password must be at least 6 characters long"
            },

            newPassword: {
                required: "Please enter new password field",
                maxlength: "New Password maximum length should be 20 character",
                minlength: "Your password must be at least 5 characters long"
            },

        confirmPassword: {
          required: "Please enter confirm password field",
          equalTo:   "New password and confirm password do not match",
          minlength: "Confirm Password minimum length should be 6 character",
          maxlength: "Confirm Password maximun length should be 20 character",
         
      },
    },
//          
    });

/*-----------------------------------------------*/
//   For addEditUser (ADMIN)
    $("form[name='addEditUser']").validate({
    
    rules: {

      name: {
        required: true
      },

      password: {
        required : true,
        maxlength : 20,
        minlength : 5
     },

     confirm_password: {
        required: true,
        minlength: 6,
        maxlength: 20,
        equalTo: "#password"
    },

    email: {
      required: true,
      email: true
    },

    mobile_number: {
      required: true,
      number: true,
      minlength: 10
      
    },

    address: {
      required: true,
    },

    country_id: {
      required: true
    },

    state_id: {
      required: true
    },

    city_id: {
      required: true
    },
    phone_code: {
      required: true
    }

    },

    messages: {
   
      email: {
        required: "Please enter email",
        email: "Please enter a valid email address"
      },
      name: {
        required: "Please enter name",
      },
      password: {
        required: "Please enter password",
        maxlength: "Password maximum length should be 20 character",
        minlength: "Your password must be at least 6 characters long"
      },
      confirm_password: {
        required: "Please enter password.",
        equalTo:   "Password and confirm password do not match.",
        minlength: "Confirm Password minimum length should be 6 character",
        maxlength: "Confirm Password maximun length should be 20 character.",
      },
      mobile_number: {
        required: "Please enter mobile number",
        minlength: "Your mobile number must be at least 10 characters long",
        number: "mobile number accepts only numeric value"
      },
      address: {
        required: "Please enter address"
      },
      country_id: {
        required: "please select a country"
      },
      state_id: {
        required: "Please select state"
      },
      city_id: {
        required: "Please select city"
      },
      phone_code: {
        required: "Please enter phone code"
      },

    },

    submitHandler: function(form) {
        form.submit();
    }
  });


/*-----------------------------------------------*/
// For addEditCompanies (ADMIN)

$("form[name='addEditCompanies']").validate({
    
    rules: {

      title: {
        required: true
      },

      owner_name: {
        required: true
      },

    email: {
      required: true,
      email: true
    },

    contact_number_1: {
      required: true,
      number: true,
      minlength: 10
      
    },
    contact_number_2: {
      required: true,
      number: true,
      minlength: 10
      
    },

    address: {
      required: true,
    },

    tin_number: {
      required: true
    },

    gst_number: {
      required: true
    },

    country: {
      required: true
    },

    state: {
      required: true
    },

    city: {
      required: true
    },

    postal_code: {
      required: true
    },

    description: {
      required: true
    }

    },

    messages: {
   
     title: {
        required: "Please enter title.",
      },
      owner_name: {
        required: "Please enter owner name.",
      },
      email: {
        required: "Please enter email.",
        email: "Please enter a valid email address."
      },
      contact_number_1: {
        required: "Please enter mobile number.",
        minlength: "Your mobile number must be at least 10 characters long.",
        number: "mobile number accepts only numeric value"
      },
      contact_number_1: {
        required: "Please enter alternate number.",
        minlength: "Your mobile number must be at least 10 characters long.",
        number: "mobile number accepts only numeric value."
      },
      address: {
        required: "Please enter address."
      },
      tin_number: {
        required: "Please enter tin number."
      },
      gst_number: {
        required: "Please select gst number."
      },
      country: {
        required: "Please select country."
      },
      state: {
        required: "Please select state."
      },
      city: {
        required: "Please select city."
      },
      postal_code: {
        required: "Please enter postal code."
      },
      description: {
        required: "Please enter description."
      },

    },

    submitHandler: function(form) {
        form.submit();
    }
  });


/*-----------------------------------------------*/
//   For addEditVouchers (ADMIN)
    $("form[name='addEditVouchers']").validate({
    
    rules: {

      company_id: {
        required : true
      },

      bill_number: {
        required: true
      },

      reciept_number: {
        required: true
      },

      payment_mode: {
        required: true
      },

      remark: {
        required: true
      },
      
      type: {
        required: true
      },

      amount: {
        required: true,
        decimal : true
      },

    },

    messages: {
      company_id : {
        required : "Please select a company",
      },
      bill_number: {
        required: "Please enter bill number.",
      },
      reciept_number: {
        required: "Please enter reciept number.",
      },
      payment_mode: {
        required: "Please select payment mode.",
      },
      remark: {
        required: "Please enter remark.",
      },
      type: {
        required: "Please select a type",
      },
      amount: {
        required: "Please enter a amount",
      },

    },

    submitHandler: function(form) {
        form.submit();
    }
  });

/*-----------------------------------------------*/
// For addEditCompanies (ADMIN)

$("form[name='addEditCategories']").validate({
    
    rules: {

      title: {
        required: true
      }
     
    },

    messages: {
   
     title: {
        required: "Please enter title.",
      }
     
    },

    submitHandler: function(form) {
        form.submit();
    }
  });



});




