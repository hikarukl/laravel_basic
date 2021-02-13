'use strict';
$(document).ready(function () {
  let btnSwitchMenu = $('#btn-switch_header_menu');

  btnSwitchMenu.on('click', function () {
    $(this).find('svg').toggle('hidden');
    $('#wrap-mobile_header_menus').toggle('hidden');
  });
});