jQuery(document).ready(function ($) {
  $("#block-govind-main-menu li a").hover(function () {
    $(this).find(".sub-menu").toggle();
  });
});
