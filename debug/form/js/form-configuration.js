// JavaScript Document

$(document).ready(function(){
 
    $('input[type="submit"]').click(function(){
        // Store form data in individual variables
        var name     = $('input#name').val();
        var email    = $('input#email').val();
        var title    = $('input#title').val();
        var subject  = $('input#subject').val();
        var comments = $('textarea#comments').val();
        var upload   = $('input#upload').val();
 
        // Create an object with the data,
        // to be passed via AJAX
        var form_data = {
            'name' : name,
            'email' : email,
            'title' : title,
            'subject' : subject,
            'comments' : comments
        };
 
        $.ajax({
            url: "contact_form.php",
            type: "POST",
            data: form_data,
            success: function(json) {
 
                // Empty the messages area
                $('#form-result').empty();
 
                // Parse the return string as JSON
                // Loop through the error messages and display them
                var result = $.parseJSON(json);
 
                $.each(result, function(i, element){
                    $('<h3></h3>').html(i).appendTo($('#form-result'));
 
                    $.each(element, function(j, sub){
                        $('<p></p>').addClass('error').html(sub).appendTo($('#form-result'));
                    });
                });
 
            }	
        });
 
        // Disable the default behaviour
        // Of the submit button
        return false;
    });
});