/* ---------------------------------------------
 Contact form
 --------------------------------------------- */
$(document).ready(function(){
    $("#submit_btn").click(function(){
        const response = window.grecaptcha.getResponse();
        if (response.length) {
            sendForm();
        } else {
            $("#result").hide().html('<div class="error">Check Google reCaptcha</div>').slideDown();
        }

        return false;
    });
    
    function sendForm() {
        //get input field values
        const userName = $('input[name=name]').val();
        const userEmail = $('input[name=email]').val();
        const userMessage = $('textarea[name=message]').val();
    
        //simple validation at client's end
        //we simply change border color to red if empty field using .css()
        let proceed = true;
        if (userName == "") {
            $('input[name=name]').css('border-color', '#e41919');
            proceed = false;
        }
        if (userEmail == "") {
            $('input[name=email]').css('border-color', '#e41919');
            proceed = false;
        }
    
        if (userMessage == "") {
            $('textarea[name=message]').css('border-color', '#e41919');
            proceed = false;
        }
    
        //everything looks good! proceed...
        if (proceed) {
            //data to be sent to server
            const post_data = {
                'name': userName,
                'email': userEmail,
                'text': userMessage,
                _token: $('meta[name="csrf-token"]').attr('content')
            };
        
            //Ajax post data to server
            $.post('/contact', post_data, function(response){
            
                //load json data from server and output message
                if (response.type == 'error') {
                    output = '<div class="error">' + response.text + '</div>';
                }
                else {
                
                    output = '<div class="success">' + response.text + '</div>';
                
                    //reset values in all input fields
                    $('#contact_form input').val('');
                    $('#contact_form textarea').val('');
                }
            
                $("#result").hide().html(output).slideDown();
            }, 'json');
        
        }
    }
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form input, #contact_form textarea").keyup(function(){
        $("#contact_form input, #contact_form textarea").css('border-color', '');
        $("#result").slideUp();
    });
    
});
