$(document).ready(function(){
    $('.razorpay_btn').click(function (e){
        e.preventDefault();
        var firstname= $('.firstname').val();
        var lastname= $('.lastname').val();
        var email= $('.email').val();
        var phone= $('.phone').val();
        var address= $('.address').val();
        var city= $('.city').val();
        var state= $('.state').val();
        var pincode= $('.pincode').val();

        if(!firstname)
        {
            fname_error="firstname is required";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        }
        else{
            fname_error="";
            $('#fname_error').html('');
        }

        if(!lastname)
        {
            fname_error="lastname is required";
            $('#lname_error').html('');
            $('#lname_error').html(fname_error); 
        }
        else{
            lname_error="";
            $('#lname_error').html(''); //
        }

        if(!email)
        {
            email_error="email is required";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        }
        else{
            email_error="";
            $('#email_error').html('');//
        }

        if(!phone)
        {
            phone_error="phone is required";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        }
        else{
            phone_error="";
            $('#phone_error').html(''); //
        }

        if(!address)
        {
            address_error="address is required";
            $('#address_error').html('');
            $('#address_error').html(address_error);
        }
        else{
            address_error="";
            $('#address_error').html('');//
        }

        if(!city)
        {
            city_error="city is required";
            $('#city_error').html('');
            $('#city_error').html(city_error);
        }
        else{
            city_error="";
            $('#city_error').html('');
        }
        if(!state)
        {
            state_error="state is required";
            $('#state_error').html('');
            $('#state_error').html(state_error);
        }
        else{
            state_error="";
            $('#state_error').html('');
        }

        if(!pincode)
        {
            pincode_error="pincode is required";
            $('#pincode_error').html('');
            $('#pincode_error').html(pincode_error);
        }
        else{
            pincode_error="";
            $('#pincode_error').html('');
        }

        if(fname_error != ''|| lname_error!=''||email_error!=''||phone_error!=''|| address_error!=''||city_error!=''||
        state_error!=''||pincode_error!='')
        {
            return false;
        }
        else{
            var data = {
                'firstname':firstname,
                'lastname':lastname,
                'email':email,
                'phone':phone,
                'address':address,
                'city':city,
                'state':state,
                'pincode':pincode
            }
            $.ajax({
                method: "POST",
                url: "/proceed-to-pay",
                data: data,
                success: function (response) {
                    //alert(response.total_price);
                    var options = {
                        "key": "rzp_test_T1ODHGLJPABKp7", // Enter the Key ID generated from the Dashboard
                        "amount": response.total_price*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "PHP", // Use the correct currency code for Philippine Peso
                        "name": response.firstname+' '+response.lastname, //your business name
                        "description": "Thank you for your patronage",
                        "image": "/assets/imgbg/wewlogo.png",
                        //"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (responsea){
    // On successful payment, collect the necessary data and send to the backend
    var firstname = $('.firstname').val();
    var lastname = $('.lastname').val();
    var email = $('.email').val();
    var phone = $('.phone').val();
    var address = $('.address').val();
    var city = $('.city').val();
    var state = $('.state').val();
    var pincode = $('.pincode').val();

    // Send the payment and user data to the backend to place the order
    $.ajax({
        method: "POST",
        url: "/place-order",
        data: {
            'fname': firstname,
            'lname': lastname,
            'email': email,
            'phone': phone,
            'address': address,
            'city': city,
            'state': state,
            'pincode': pincode,
            'payment_mode': "Paid using Razorpay",
            'payment_id': responsea.razorpay_payment_id,
        },
        success: function(responseb){
            // Alert success and redirect to the order page or clear the cart
            alert(responseb.status);
            window.location.href = "/my-orders";
        }
    });
},
                        "prefill": {
                            "name": response.name, //your customer's name
                            "email": response.email,
                            "contact": response.phone
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                       
                   

                },
                
            });
        }
    });
});