$(document).ready(function () {
    // Check admin password if correct or not
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
        //alert(current_pwd);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-current-password',
            data: { current_pwd: current_pwd },
            success: function (resp) {
                if (resp == "false") {
                    $("#verifyCurrentPwd").html("<small style='color:red'><i class='fas fa-exclamation-circle'></i> Current Password is Incorrect</small>");
                } else if (resp == "true") {
                    $("#verifyCurrentPwd").html("<small><i class='fas fa-check-circle'></i> Current Password is correct</small>");
                }
            }, error: function () {
                alert("Error");
            }
        })


    });

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


    $("button.delete").click(function () {
        var id = this.id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/destroy-user',
            data: { id: id },
            success: function (resp) {
                //alert(resp);
                //$("#info").html(data.responseJSON.message);
                //console.log(resp.success_message);
                //$("#info").html(resp.success_message);
                toastr.success(resp.success_message);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }, error: function (data) {
                //alert(request.message);
                //$("#info").html(request);
                //console.log(data.responseJSON.message);
                //$("#info").html(data.responseJSON.message);
                toastr.warning(data.responseJSON.message);
            }
        });
    });


    $(".edit").click(function () {
        //alert(this.id);
        var id = this.id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/admin/viewDetails',
            data: { id: id },
            success: function (resp) {
                if (resp.status == '1') {
                    var currentStat = 'ACTIVE';
                } else {
                    var currentStat = 'INACTIVE';
                }
                console.log(resp);
                $("#adp_name").html(resp.name);
                $("#account_data").html('Account ID: ' + resp.id + ' / Company: ' + resp.company + '<br />Account Name: ' + resp.name + '<br />Email Address: ' + resp.email + '<br />Status: <span class="badge badge-success">' + currentStat + '</span>');


            }, error: function (data) {
                //alert(request.message);
                //$("#info").html(request);
                console.log(data);
                //$("#info").html(data.responseJSON.message);
                //toastr.warning(data.responseJSON.message);
            }
        });
    });

    $("#updater").click(function () {
        var id = $("#updateStat").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/updateStat',
            data: { id: id },
            success: function (resp) {
                console.log(resp);
                toastr.success(resp.success_message);
                setTimeout(function () {
                    location.reload();
                }, 2000);

            }, error: function (data) {
                console.log(data.responseJSON.message);
            }
        });
    });


    $(".deleteBtn").click(function () {

        var vid = this.id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/deleteOrder',
            data: { id: vid },
            success: function (resp) {
                //console.log(resp);
                toastr.success(resp.success_message);
                setTimeout(function () {
                    location.reload();
                }, 2000);

            }, error: function (data) {
                console.log(data.responseJSON.message);
            }
        });

    });

    $(".viewData").click(function () {

        var id = this.id;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/admin/viewOrder',
            data: {
                id: id,
            },
            success: function (resp) {
                //console.log(resp);
                $("#order_title").html(resp.order_number + ' - ' + resp.adopter_name);

                $("#account_id").html(resp.account_id);
                $("#account_name").html(resp.account_name);
                $("#adopter_name").html(resp.adopter_name);
                $("#phone").html(resp.adopter_phone);
                $("#address_a").html(resp.adopter_city_state);
                $("#email").html(resp.mailing_email);

                $("#mailing_name").html(resp.mailing_name);
                $("#mailing_street_address").html(resp.mailing_street_address);
                $("#mailing_city_state_zip").html(resp.mailing_city_state_zip);
                $("#phone1").html(resp.adopter_phone);
                $("#mailing_note").html(resp.mailing_note);
                $("#order_status").html(resp.order_status);


                if (resp.order_status == 'PROCESSING') {
                    $("#processBtn").attr("disabled", true);
                } else {
                    $("#processBtn").removeAttr("disabled");
                }

            }, error: function (error) {
                console.log(error);
            }
        });
    });

});