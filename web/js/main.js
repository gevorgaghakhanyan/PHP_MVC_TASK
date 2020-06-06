$( document ).ready(function() {
  let email_error = $('#email_error');
  let user_error = $('#user_error');
  let description_error = $('#description_error');
  let login_error = $('#login_error');
  let password_error = $('#password_error');
  if(email_error.text() != ''){email_error.removeClass('hidden-error-box');}
  if(user_error.text() != ''){user_error.removeClass('hidden-error-box');}
  if(description_error.text() != ''){description_error.removeClass('hidden-error-box');}
  if(login_error.text() != ''){login_error.removeClass('hidden-error-box');}
  if(password_error.text() != ''){password_error.removeClass('hidden-error-box');}

});




