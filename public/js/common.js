'use strict';
$(document).ready(function () {
  let btnSwitchMenu = $('#btn-switch_header_menu');
  let btnUserMenu = $('#user-menu');

  btnSwitchMenu.on('click', function () {
    $(this).find('svg').toggle('hidden');
    $('#wrap-mobile_header_menus').toggle('hidden');
    $('#wrap-mobile_specific_menus').toggle('hidden');
  });

  btnUserMenu.on('click', function () {
    if ($(this).parent().siblings('div').hasClass('hidden')) {
      $(this).parent().siblings('div').removeClass('hidden');
    } else {
      $(this).parent().siblings('div').addClass('hidden');
    }
  });
});