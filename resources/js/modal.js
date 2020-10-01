$(function() {
  $('#create-items').click(function(){
    $('#create-items-show').fadeIn();
  });
  
  $('.close-modal').click(function(){
    $('#create-items-show').fadeOut();
  });
  
  $('#create-tags').click(function(){
    $('#create-tags-show').fadeIn();
  });
  
  $('.close-modal').click(function(){
    $('#create-tags-show').fadeOut();
  });
  
});

// $(function () {
//     $('.more-button').prevAll().hide();
//     $('.more-button').click(function () {
//         if ($(this).prevAll().is(':hidden')) {
//             $(this).prevAll().slideDown();
//             $(this).text('閉じる').addClass('close');
//         } else {
//             $(this).prevAll().slideUp();
//             $(this).text('プロフィールをみる').removeClass('close');
//         }
//     });
// });
