import 'bootstrap';
import $ from 'jquery';

$(document).ready(function () {
    $('.navbar-toggler').on('click', function () {
        $('#navbarNav').toggleClass('show');
    });

    const defaultRole = $('#role').val();
    if (defaultRole === 'Client') {
        $('#role').css('background-color', '#ccccff');
    }

    $('#role').on('change', function () {
        const selectedRole = $(this).val();

        if (selectedRole === 'Admin') {
            $(this).css('background-color', '#ffcccc');
        } else if (selectedRole === 'Employee') {
            $(this).css('background-color', '#ccffcc');
        } else {
            $(this).css('background-color', '#ccccff');
        }
    });
		
    console.log("jQuery and Bootstrap are working!");
});
