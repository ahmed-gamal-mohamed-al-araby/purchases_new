
// checkout
// $(window).on('load', function(){
//     var x = $('#phone_id').val();
//     if(x == +20){
//         console.log($('.bfh-phone.bg-light.append').val(x));
//     }
// })

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = " تسجيل ";
  } else {
    document.getElementById("nextBtn").innerHTML = "التالى";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

// person phone
$(".phone-require").on('keyup',function()
{
    var phone1_id = $('#phone_id').val();

    var tel = $(this).val();
    if(phone1_id == +20 && tel !='') {

        var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
        var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
        var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
        var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;

        if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
          $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
        }else{
           $(this).parents().children('.tab .form-phone-invalid' ).css("display","block");
        }
    }else{
        $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
    }
});

// whats
$(".whats-require").on('keyup',function()
{
    var phone_id = $('#phone_id').val();
    var tel = $(this).val();
    if(phone_id == +20 && tel !='') {

        var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
        var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
        var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
        var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;


        if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
            $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
          }else{
             $(this).parents().children('.tab .form-phone-invalid' ).css("display","block");
          }
      }else{
        $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
      }

});


// company phone
$("#company_mobile").on('keyup',function()
{
    var phone_id = $('#phone_id').val();
    var tel = $(this).val();
    if(phone_id == +20  && tel != '') {
        var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
        var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
        var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
        var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;
        var regex4 = '';

        if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
            $('.phone_vaild' ).css("display","none");

        }else{
            $('.phone_vaild' ).css("display","block");
        }
        }else{
            $('.phone_vaild' ).css("display","none");
        }

});


function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByClassName("require");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;

        if ($(".checkout  select.invalid")[0]) {
            $('.tab .form-service-invalid' ).css("display","block")
        }




    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
    document.getElementsByClassName("step")[currentTab].innerHTML = "<i class='fa fa-check'> </i>";
      if ($(".checkout  select.invalid")[0]) {
          $('.tab .form-service-invalid' ).css("display","none")
      }
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";

}



