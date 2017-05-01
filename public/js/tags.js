jQuery(document).ready(function($) {

  $('#submitForm').keypress(function(e) {
    if (e.keyCode == '13') {
      console.log('test');
      e.preventDefault();
      //your code here
    }
  });

  var tags = $('#tags').inputTags({
    max: 15
  });
});
