$(function(){
    $("form[name='registration']").validate({
        rules: {
			
            
            firstname: {
                required: true,
                minlength: 4
            },
            lastname: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5

            }
        },
        messages: {
            firstname: {
                required: "Please enter your firstname",
                minlength: "Minimum of 4 characters"

            },
            lastname: "Please enter your lastname",
            password: {
                required: "Please provide password",
                minlength: "Your Password must be atleast 5 character"
            },
            email: "Please enter a valid email address"
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    $("input").on("focus",function(e){
        $(e.target).css("background-color", "#cccccc");

    });
    
    $("input").on("blur",function(e){
        $(e.target).css("background-color", "#ffffff");
    });

});
