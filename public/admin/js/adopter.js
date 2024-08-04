$(document).ready(function () {

    $("#current_pwd_adopter").keyup(function () {
        var current_pwd_adopter = $("#current_pwd_adopter").val();
        //alert(current_pwd);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/adopter/check-current-password',
            data: { current_pwd_adopter: current_pwd_adopter },
            success: function (resp) {
                if (resp == "false") {
                    $("#verifyCurrentPwd").html("<small style='color:red'><i class='fas fa-exclamation-circle'></i> Current Password is Incorrect!</small>");
                } else if (resp == "true") {
                    $("#verifyCurrentPwd").html("<small><i class='fas fa-check-circle'></i> Yes, current Password is CORRECT!</small>");
                }
            }, error: function () {
                alert("Error");
            }
        });


    });

    $("#update_details").click(function () {
        var admin_name = $("#account").val();
        var admin_company = $("#company").val();
        var admin_mobile = $("#mobile").val();

        //alert(admin_name);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/adopter/update-details-account',
            data: {
                admin_name: admin_name,
                admin_company: admin_company,
                admin_mobile: admin_mobile
            },
            success: function (resp) {
                toastr.success(resp.success_message);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }, error: function (data) {
                toastr.warning(data.responseJSON.message);
                //console.log(data);
            }
        });

    });

    $("#change_pass").click(function () {
        var new_pwd = $("#new_pwd").val();
        var confirm_pwd = $("#confirm_pwd").val();
        var current_pwd = $("#current_pwd_adopter").val();

        //alert(admin_name);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/adopter/updatePassbok',
            data: {
                current_pwd: current_pwd,
                new_pwd: new_pwd,
                confirm_pwd: confirm_pwd
            },
            success: function (resp) {
                //toastr.success(resp.success_message);
                // setTimeout(function () {
                //     location.reload();
                // }, 2000);

                if (resp.success == 'true') {
                    toastr.success(resp.success_message);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.warning(resp.error_message);
                }

                console.log(resp.success_message);
            }, error: function (error) {
                toastr.warning('Error: ' + error);
                console.log(error.error_message);
            }
        });

    });

    $("#update_address").click(function () {
        var street = $("#street").val();
        var city = $("#city").val();
        var state = $("#state").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/adopter/update-address',
            data: {
                street_address: street,
                city: city,
                state: state
            },
            success: function (resp) {
                if (resp.success == true) {
                    toastr.success(resp.success_message);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.warning(resp.error_message);
                }

                //console.log(resp.success_message);
            }, error: function (error) {
                toastr.warning('Error: ' + error);
                console.log(error.error_message);
            }
        });
    });



    $("#mailing_adopter_name").keyup(function () {
        $(this).removeClass("is-invalid");
    });
    $("#mailing_email").keyup(function () {
        $(this).removeClass("is-invalid");
    });
    $("#mailing_street_address").keyup(function () {
        $(this).removeClass("is-invalid");
    });
    $("#mailing_city_state").keyup(function () {
        $(this).removeClass("is-invalid");
    });




    $("#adopter_name").keyup(function () {
        var line1 = $("#adopter_name").val();
        $("#line1").html(line1);
        $(this).removeClass("is-invalid");
    });

    $("#phone").keyup(function () {
        var line2 = $("#phone").val();
        $("#line2").html(line2);
        $(this).removeClass("is-invalid");
    });

    $("#street").keyup(function () {
        var line3 = $("#street").val();
        $("#line3").html(line3);
        $(this).removeClass("is-invalid");
    });

    $("#city").keyup(function () {
        var line4 = $("#city").val();
        $("#line4").html(line4);
        $(this).removeClass("is-invalid");
    });


    // $('#product_list').on('change', function () {
    //     var id = this.value;
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type: 'get',
    //         url: '/adopter/check-price',
    //         data: {
    //             id: id,
    //         },
    //         success: function (resp) {
    //             console.log(resp.price[0].product_price);
    //             $("#total_price").html(resp.price[0].product_price);

    //         }, error: function (error) {
    //             console.log(error);
    //         }
    //     });
    // });



    $("#order_btn").click(function () {

        var id = $("#order_id").text();
        var price = $("#total_price").text();

        var color = $("#color").val();
        var shape = $("#shape").val();

        var accountId = $("#accountId").text();
        var company = $("#company_name").text();
        var company_street = $("#company_street").text();
        var company_city = $("#company_city").text();

        var adopter_name = $("#adopter_name").val();
        var phone = $("#phone").val();
        var street = $("#street").val();
        var city = $("#city").val();

        var mailing_adopter_name = $("#mailing_adopter_name").val();
        var mailing_email = $("#mailing_email").val();
        var mailing_street_address = $("#mailing_street_address").val();
        var mailing_city_state = $("#mailing_city_state").val();
        var mailing_note = $("#mailing_note").val();


        if (mailing_adopter_name == '') {
            $("#mailing_adopter_name").addClass("is-invalid");
        } else if (mailing_email == "") {
            $("#mailing_email").addClass("is-invalid");
        } else if (mailing_street_address == "") {
            $("#mailing_street_address").addClass("is-invalid");
        } else if (mailing_city_state == "") {
            $("#mailing_city_state").addClass("is-invalid");
        } else if (adopter_name == "") {
            $("#adopter_name").addClass("is-invalid");
        } else if (phone == "") {
            $("#phone").addClass("is-invalid");
        } else if (street == "") {
            $("#street").addClass("is-invalid");
        } else if (city == "") {
            $("#city").addClass("is-invalid");

        } else if (shape == "" || shape == null) {
            $("#shape").addClass("is-invalid");
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/adopter/order-process',
                data: {
                    id: id,
                    price: price,
                    shape: shape,
                    accountId: accountId,
                    company: company,
                    company_street: company_street,
                    company_city: company_city,
                    adopter_name: adopter_name,
                    phone: phone,
                    street: street,
                    city: city,
                    mailing_adopter_name: mailing_adopter_name,
                    mailing_email: mailing_email,
                    mailing_street_address: mailing_street_address,
                    mailing_city_state: mailing_city_state,
                    mailing_note: mailing_note
                },
                success: function (resp) {

                    if (resp.success == true) {
                        toastr.success(resp.success_message);
                        setTimeout(function () {
                            location.href = '/adopter/manage-orders';
                        }, 2000);
                    } else {

                        toastr.warning(resp.error_message);

                    }
                    console.log(resp);

                }, error: function (error) {
                    toastr.warning('Error: ' + error);
                    console.log(error);
                }
            });
        }



    });


    $(".viewData").click(function () {
        var id = this.id;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/adopter/view-details',
            data: {
                id: id,
            },
            success: function (resp) {
                console.log(resp);
                $("#order_no").html(resp.order_number);
                $("#adp_name").html(resp.adopter_name);
                $("#adp_street").html(resp.adopter_address);
                $("#adp_city").html(resp.adopter_city_state);
                $("#adp_phone").html(resp.adopter_phone);
                $("#adp_email").html(resp.mailing_email);
                $("#adp_status").html(resp.order_status);
            }, error: function (error) {
                console.log(error);
            }
        });
    });


});