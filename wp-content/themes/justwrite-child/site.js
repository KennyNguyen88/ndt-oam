"use strict"; // start of use strict
jQuery(function($){$(document).ready(function() {
    $('.widget_nav_menu div div').css('display', 'none');
    $('#nav_menu-2 div div').css('display', 'block');
    $('.widget_nav_menu .sb-content .sidebar-heading').click(function(){
        if($(this).parent().find('div').css('display') == 'none'){
            $('.widget_nav_menu div div').css('display', 'none');
            $(this).parent().find('div').slideToggle('slow');
        }else{
            $(this).parent().find('div').slideToggle('slow');
        }
    });
})});