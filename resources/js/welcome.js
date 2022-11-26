import jQuery, { css } from 'jquery';
import Alpine from 'alpinejs';

window.$ = jQuery;
window.Alpine = Alpine;

Alpine.start();

var dropdown = "close";
$("#dropdownDefault").on('click', () => {
    if(dropdown == "close")
    {
        $("#dropdown").show();
        dropdown = "open";
    }
    else
    {
        $("#dropdown").hide();
        dropdown = "close";
    }
});