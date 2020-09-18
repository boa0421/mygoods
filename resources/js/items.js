$(function() {
  $('#create-items').click(function(){
    $('#create-items-show').fadeIn();
  });
  
  $('.close-modal').click(function(){
    $('#create-items-show').fadeOut();
  });
});