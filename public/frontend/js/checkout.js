$(document).ready(function () {
    $(".razorpay").click(function (e) {
        e.preventDefault();

        var firstname = $('.firstname').val();
        var lastname = $('.lastname').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var address1 = $('.address1').val();
        var address2 = $('.address2').val();
        var city = $('.city').val();
        var state = $('.state').val();
        var country = $('.country').val();
        var pincode = $('.pincode').val();

        if(!firstname)
        {
            fname_error = "First Name is Required";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        }else{
            fname_error = "";
            $('#fname_error').html('');
        }

        if(!lastname)
        {
            lname_error = "Last Name is Required";
            $('#lname_error').html('');
            $('#lname_error').html(lname_error);
        }else{
            lname_error = "";
            $('#lname_error').html('');
        }

        if(!email)
        {
            email_error = "Email is Required";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        }else{
            email_error = "";
            $('#email_error').html('');
        }

        if(!phone)
        {
            phone_error = "Phone is Required";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        }else{
            phone_error = "";
            $('#phone_error').html('');
        }

        if(!address1)
        {
            add1_error = "Addres1 is Required";
            $('#add1_error').html('');
            $('#add1_error').html(add1_error);
        }else{
            add1_error = "";
            $('#add1_error').html('');
        }

        if(!address2)
        {
            add2_error = "Address2 is Required";
            $('#add2_error').html('');
            $('#add2_error').html(add2_error);
        }else{
            add2_error = "";
            $('#add2_error').html('');
        }

        if(!state)
        {
            state_error = "State is Required";
            $('#state_error').html('');
            $('#state_error').html(state_error);
        }else{
            state_error = "";
            $('#state_error').html('');
        }

        if(!country)
        {
            country_error = "Country is Required";
            $('#country_error').html('');
            $('#country_error').html(country_error);
        }else{
            country_error = "";
            $('#country_error').html('');
        }

        if(!city)
        {
            city_error = "City is Required";
            $('#city_error').html('');
            $('#city_error').html(city_error);
        }else{
            city_error = "";
            $('#city_error').html('');
        }

        if(!pincode)
        {
            pincode_error = "Pin Code is Required";
            $('#pincode_error').html('');
            $('#pincode_error').html(pincode_error);
        }else{
            pincode_error = "";
            $('#pincode_error').html('');
        }

        if(fname_error !='' || lname_error != '' || email_error !='' || add1_error !='' || add2_error !='' || state_error !='' || city_error !='' || pincode_error !=''){
            return false
        }else{
            var data = {
            'firstname': firstname,
            'lastname': lastname,
            'email': email,
            'phone': phone,
            'address1': address1,
            'address2': address2,
            'city': city,
            'state': state,
            'country': country,
            'pincode': pincode
            }

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                method: "POST",
                url: "/proccess-to-pay",
                data: data,
                success: function (response) {
                    // alert(response.total_price);
                    var options = {
                        "key": "rzp_test_14kyhIMQOC49Vu", // Enter the Key ID generated from the Dashboard
                        "amount": 1*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": response.firstname+' '+response.lastname,
                        "description": "Thank You Choosing us",
                        "image": "https://example.com/your_logo",
                        "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (response){
                            alert(response.razorpay_payment_id);
                            alert(response.razorpay_order_id);
                            alert(response.razorpay_signature)
                        },
                        "prefill": {
                            "name": response.firstname+' '+response.lastname,
                            "email": response.email,
                            "contact": response.phone
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                        rzp1.open();
                }
            });
        }

    });
});
