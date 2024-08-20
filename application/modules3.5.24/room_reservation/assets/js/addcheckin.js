function getbsource() {
    'use strict';
    var booking_type = $("#booking_type").find(":selected").text();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/bookingSource";
    if ($('#booking_source')[0].options.length > 1)
        $('#booking_source').find('option').not(':first').remove();
    $("#commissionrate").val('');
    $("#commissionamount").val('');
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            booking_type: booking_type
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $.each(obj, function(key, value) {
                for (var i = 0; i < value.length; i++) {
                    $('#booking_source').append('<option value="' + value[i].btypeinfoid +
                        '">' +
                        value[i].booking_sourse + '</option>');
                }
            });
            $('.selectpicker').selectpicker('refresh');
        }
    });
}

function getroomno() {
    'use strict';
    var allroom = "";
    var all = $("table.room-list > tbody").length;
    for (var s = 0; s < all - 1; s++) {
        allroom += ",".concat($("#roomno" + s).val());
    }
    $("#msg").text("");
    $("#msg1").text("");
    var datefilter1 = $("#datefilter1").val();
    if (datefilter1 == "") {
        $("#datefilter1").addClass("is-invalid");
        return false;
    }
    var datefilter2 = $("#datefilter2").val();
    if (datefilter2 == "") {
        $("#datefilter2").addClass("is-invalid");
        return false;
    }
    if (datefilter2 <= datefilter1) {
        $("#msg").text("Checkout field can not equal or smaller than Checkin field");
        $("#datefilter1").addClass("is-invalid");
        $("#datefilter2").addClass("is-invalid");
        return false;
    } else {
        $("#datefilter1").removeClass("is-invalid");
        $("#datefilter2").removeClass("is-invalid");
        $("#datefilter1").addClass("is-valid");
        $("#datefilter2").addClass("is-valid");
    }
    var room_type = $("#room_type").find(":selected").val();
    if (room_type == "") {
        $("#room_type").removeClass("is-valid");
        $("#room_type").closest('div').removeClass("is-valid");
        $("#room_type").addClass("is-invalid");
        $("#roomno").removeClass("is-valid");
        $("#roomno").closest('div').removeClass("is-valid");
        return false;
    } else {
        $("#room_type").removeClass("is-invalid");
        $("#room_type").closest('div').removeClass("is-invalid");
        $("#room_type").addClass("is-valid");
        $("#roomno").removeClass("is-valid");
        $("#roomno").closest('div').removeClass("is-valid");
    }
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/checknewroom";
    if ($('#roomno')[0].options.length > 1)
        $('#roomno').find('option').not(':first').remove();
    if ($('#complementary')[0].options.length > 1)
        $('#complementary').find('option').not(':first').remove();
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            room_type: room_type,
            datefilter1: datefilter1,
            datefilter2: datefilter2
        },
        success: function(data) {
            var obj = JSON.parse(data);
            var rlen = obj.roomno;
            var clen = obj.complementary;
            for (var i = 0; i < rlen.length; i++) {
                var split_room = allroom.split(",");
                if (split_room.indexOf("" + obj.roomno[i] + "") == -1) {
                    $('#roomno').append('<option value="' + obj.roomno[i] + '">' + obj.roomno[i] +
                        '</option>');
                }
            }
            for (var i = 0; i < clen.length; i++) {
                $('#complementary').append('<option value="' + obj.complementary[i].rate + '">' + obj
                    .complementary[i].complementaryname + '</option>');
            }
            $('.selectpicker').selectpicker('refresh');
            $("#bed").prop("disabled", true);
            $("#child1").prop("disabled", true);
            $("#person").prop("disabled", true);
        }
    });
}
'use strict';
$("#complementary").on("change", function() {
    var cm = $("#complementary").find(":selected").val();
    if (cm > 0) {
        $("#compamount").attr("hidden", false);
        $("#compamount").text("Amount: " + cm);
    } else {
        $("#compamount").attr("hidden", true);
    }
});

function getcapcity() {
    'use strict';
    var roomno = $("#roomno").find(":selected").val();
    var room_type = $("#room_type").find(":selected").val();
    var complementary_checkboxt = $('#complementary_checkboxt:checked').val()?$('#complementary_checkboxt:checked').val():0;
    if (roomno == "") {
        if (room_type != "") {
            $("#roomno").removeClass("is-valid");
            $("#roomno").closest('div').removeClass("is-valid");
            $("#roomno").addClass("is-invalid");
            return false;
        }
        return false;
    } else {
        $("#roomno").removeClass("is-invalid");
        $("#roomno").closest('div').removeClass("is-invalid");
        $("#roomno").addClass("is-valid");
    }
    var csrf = $('#csrf_token').val();
    var start = $("#datefilter1").val();
    var end = $("#datefilter2").val();
    var myurl = baseurl + "room_reservation/room_reservation/getcapacity";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            start: start,
            end: end,
            roomno: roomno
        },
        success: function(data) {
            var obj = JSON.parse(data);
            if (obj.excapacity == 0) {
                $("#bed").prop("disabled", true);
                $("#child1").prop("disabled", true);
                $("#person").prop("disabled", true);
            } else {
                $("#bed").prop("disabled", false);
                $("#child1").prop("disabled", false);
                $("#person").prop("disabled", false);
            }
            if(complementary_checkboxt==1){
                $("#adults").val(obj.capacity);
                $("#rent").val(0);
                //$("#gst").val(obj.gst);
                //$("#gstamt").val(obj.gstamt);
                $("#days").val(obj.days); //kiran
                if (obj.offer_amount > 0) {
                    $("#offer_price").text(obj.offer_amount);
                }
                $('#commissionrate').trigger('change');
                $("#rent").trigger('change');
            }else{
                $("#adults").val(obj.capacity);
                $("#rent").val(obj.price);
                //$("#gst").val(obj.gst);
                //$("#gstamt").val(obj.gstamt);
                $("#days").val(obj.days); //kiran
                if (obj.offer_amount > 0) {
                    $("#offer_price").text(obj.offer_amount);
                }
                $('#commissionrate').trigger('change');
                $("#rent").trigger('change');
            }
        }
    });
}

function bedprice() {
    'use strict';
    var room_type = $("#room_type").find(":selected").val();
    if (room_type == "") {
        $("#room_type").addClass("is-invalid");
        return false;
    }
    var bed = $("#bed").val();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/bedprice";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            room_type: room_type,
            bed: bed
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#amount1").val(obj.bedrate);
        }
    });
}

function personprice() {
    'use strict';
    var room_type = $("#room_type").find(":selected").val();
    if (room_type == "") {
        $("#room_type").addClass("is-invalid");
        return false;
    }
    var person = $("#person").val();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/personprice";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            room_type: room_type,
            person: person
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#amount2").val(obj.personrate);
        }
    });
}

function childprice() {
    'use strict';
    var room_type = $("#room_type").find(":selected").val();
    if (room_type == "") {
        $("#room_type").addClass("is-invalid");
        return false;
    }
    var child = $("#child1").val();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/childprice";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            room_type: room_type,
            child: child
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#amount3").val(obj.childrate);
        }
    });
}

"use strict";
function toastrErrorMsg(r) {
    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 1500,
        };
        toastr.error(r);
    }, 1000);
}
// //            ========= its for toastr error message =============
"use strict";
function toastrSuccessMsg(r) {
    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 1500,
        };
        toastr.success(r);
    }, 1000);
}
'use strict';
$("#existmobile").on("keyup", function() {
    var search = $(this).val();
    $("#addoldcustomer").attr("disabled", true);
    $("#existcustid").val("");
    $("#existname").val("");
    $("#existmobile").removeClass("is-valid");
    if (search != "") {
        var csrf = $('#csrf_token').val();
        var myurl = baseurl + "room_reservation/room_reservation/existcustomer";
        $.ajax({
            url: myurl,
            type: 'post',
            data: {
                csrf_test_name: csrf,
                search: search,
                type: 1
            },
            dataType: 'json',
            success: function(response) {
                var len = response.user.length;
                if (response.user != "Not found") {
                    $("#searchResult").empty();
                    for (var i = 0; i < len; i++) {
                        var mobile = response.user[i].cust_phone;;
                        var name = response.user[i].firstname;
                        $("#searchResult").append("<li value=" + mobile + ">" + mobile + '-' +
                            name + "</li>");
                    }
                    // binding click event to li
                    $("#searchResult li").bind("click", function() {
                        existuser(this);
                    });
                }
            }
        });
    } else {
        $("#searchResult").empty();
        $("#existcustid").val("");
        $("#existmobile").val("");
        $("#existname").val("");
        $("#existmobile").removeClass("is-valid");
    }
});

function existuser(value) {
    'use strict';
    $("#existmobile").removeClass("is-valid").removeClass("is-invalid");
    var num = $(value).text();
    var existmobile = num.split("-")[0];
    $("#existmobile").val(existmobile);
    $("#searchResult").empty();
    if (existmobile == "") {
        $("#existmobile").addClass("is-invalid");
        return false;
    }
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/existcustomer";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            existmobile: existmobile,
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#existname").val(obj.user);
            if (obj.existuser == 1) {
                $("#existmobile").addClass("is-valid")
                $("#existmobile").val(existmobile);
                $("#existcustid").val(obj.userid);
                $("#addoldcustomer").attr("disabled", false);
            } else {
                $("#existmobile").addClass("is-invalid")
                $("#existcustid").val("");
                $("#existmobile").val("");
                $("#addoldcustomer").attr("disabled", true);
            }
        }
    });
}
$("#mobileNo").on('keyup', mobilenocheck);
$("#mobileNo").on('change', mobilenocheck);

function mobilenocheck() {
    'use strict';
    var mobileno = $("#mobileNo").val();
    if (mobileno) {
        var csrf = $('#csrf_token').val();
        var myurl = baseurl + "room_reservation/room_reservation/mobilenocheck";
        $.ajax({
            url: myurl,
            type: "POST",
            data: {
                csrf_test_name: csrf,
                mobileno: mobileno,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.existuser == 1) {
                    $("#mobileNo").addClass("is-invalid");
                    $("#addcustomer").attr("hidden", true);
                } else {
                    $("#mobileNo").removeClass("is-invalid");
                    $("#addcustomer").attr("hidden", false);
                }
            }
        });
    } else {
        $("#mobileNo").removeClass("is-invalid");
        $("#addcustomer").attr("hidden", false);
    }
}

function checkinBooking() { 
    'use strict';
    var finyear = $("#finyear").val();
    if (finyear <= 0) {
        swal({
            title: "Failed",
            text: "Please Create Financial Year First",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
    $("#msg").text("");
    $("#msg1").text("");
    var datefilter1 = $("#datefilter1").val();
    if (datefilter1 == "") {
        $("#datefilter1").addClass("is-invalid");
        return false;
    }
    var datefilter2 = $("#datefilter2").val();
    if (datefilter2 == "") {
        $("#datefilter2").addClass("is-invalid");
        return false;
    }
    if (datefilter2 <= datefilter1) {
        $("#msg").text("Checkout field can not equal or smaller than Checkin field");
        $("#datefilter1").addClass("is-invalid");
        $("#datefilter2").addClass("is-invalid");
        return false;
    }
    var currtime = $("#currtime").val();
    if (currtime < datefilter1) {
        swal({
            title: "Warning",
            text: "Checkin time is greater than current time",
            type: "warning",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
    //roomdetails
    var all = $("table.room-list > tbody").length;
    var room_type = $('#room_type').find(":selected").val();
    if (room_type == null) {
        room_type = $('#room_type-1').find(":selected").val();
    }
    for (var s = 0; s < all - 1; s++) {
        room_type += ",".concat($("#room_type" + s).val());
    }
    if (room_type == "") {
        $("#msg1").text("Room type field is required");
        return false;
    }
    var roomno = $('#roomno').find(":selected").val();
    if (roomno == null) {
        roomno = $('#roomno-1').find(":selected").val();
    }
    for (var s = 0; s < all - 1; s++) {
        roomno += ",".concat($("#roomno" + s).val());
    }
    if (roomno == "") {
        $("#msg1").text("Room type field is required");
        return false;
    }

    //kiran
    var gst = $("#gst").val();
    if (gst == null) {
        gst = $("#gst-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        gst += ",".concat($("#gst" + s).val());
    }

    var gstamt = $("#gstamt").val();
    if (gstamt == null) {
        gstamt = $("#gstamt-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        gstamt += ",".concat($("#gstamt" + s).val());
    }
    //kiran

    var adults = $("#adults").val();
    if (adults == null) {
        adults = $("#adults-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        adults += ",".concat($("#adults" + s).val());
    }
    if (adults == "") {
        $("#msg1").text("Adults field is required");
        return false;
    }
    var children = $("#children").val();
    if (children == null) {
        children = $("#children-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        children += ",".concat($("#children" + s).val());
    }
    var bed = $("#bed").val();
    if (bed == null) {
        bed = $("#bed-1").val();
    }
    if (bed == "") {
        bed = 0;
    }
    for (var s = 0; s < all - 1; s++) {
        var bedval = $("#bed" + s).val();
        if (bedval == "") {
            bedval = 0;
        }
        bed += ",".concat(bedval);
    }
    var amount1 = $("#amount1").val();
    if (amount1 == null) {
        amount1 = $("#amount1-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        amount1 += ",".concat($("#amount1" + s).val());
    }
    var person = $("#person").val();
    if (person == null) {
        person = $("#person-1").val();
    }
    if (person == "") {
        person = 0;
    }
    for (var s = 0; s < all - 1; s++) {
        var personval = $("#person" + s).val();
        if (personval == "") {
            personval = 0;
        }
        person += ",".concat(personval);
    }
    var amount2 = $("#amount2").val();
    if (amount2 == null) {
        amount2 = $("#amount2-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        amount2 += ",".concat($("#amount2" + s).val());
    }
    var child = $("#child1").val();
    if (child == null) {
        child = $("#child1-1").val();
    }
    if (child == "") {
        child = 0;
    }
    for (var s = 0; s < all - 1; s++) {
        var childval = $("#child1" + s).val();
        if (childval == "") {
            childval = 0;
        }
        child += ",".concat(childval);
    }
    var amount3 = $("#amount3").val();
    if (amount3 == null) {
        amount3 = $("#amount3-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        amount3 += ",".concat($("#amount3" + s).val());
    }
    if (amount3 == "") {
        amount3 = 0;
    }
    var extrastart = $('#from_date2').val();
    if (extrastart == null) {
        extrastart = $("#from_date2-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        extrastart += ",".concat($("#from_date2" + s).val());
    }
    var extraend = $('#to_date2').val();
    if (extraend == null) {
        extraend = $("#to_date2-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        extraend += ",".concat($("#to_date2" + s).val());
    }

    //kiran
    var days = $("#days").val();
    //var diff = Math.ceil((Date.parse(datefilter2) - Date.parse(datefilter1)) / 86400000);
    var diff = days;
    var rentval = parseFloat($("#rent").val());
    var rent = rentval / parseFloat(diff);
    if (rent == null | isNaN(rent)) {
        var rentval = parseFloat($("#rent-1").val());
        var rent = rentval / parseFloat(diff);
    }
    for (var s = 0; s < all - 1; s++) {
        var rentval = parseFloat($("#rent" + s).val());
        var rentdiv = rentval / parseFloat(diff);
        rent += ",".concat(rentdiv);
    } 
    /*var rent = $('#rent').val();
    for (var s = 0; s < all - 1; s++) {
        rent += ",".concat($("#rent" + s).val());
    }*/
    //kiran

    var complementary = $("#complementary").find(":selected").text();
    if (complementary == null) {
        var complementary = $("#complementary-1").find(":selected").text();
    }
    if (complementary == "Choose Complementary") {
        complementary = "no";
    }
    for (var s = 0; s < all - 1; s++) {
        var newcomplementary = $("#complementary" + s).find(":selected").text();
        if (newcomplementary == "Choose Complementary") {
            newcomplementary = "no";
        }
        complementary += ",".concat(newcomplementary);
    }
    complementary = $.trim(complementary.replace(/\s+/g, ""));

    var complementaryprice = $("#complementary").find(":selected").val();
    if (complementaryprice == null) {
        complementaryprice = $("#complementary-1").find(":selected").val();
    }
    for (var s = 0; s < all - 1; s++) {
        complementaryprice += ",".concat($("#complementary" + s).find(":selected").val());
    }
    var offer_price = $("#offer_price").text();
    if (offer_price == null) {
        offer_price = $("#offer_price-1").text();
    }
    if (offer_price == '') {
        offer_price = 0;
    }
    for (var s = 0; s < all - 1; s++) {
        offer_price += ",".concat(($("#offer_price" + s).text() ? $("#offer_price" + s).text() : 0));
    }
    //end
    var name = $("#alluser").val();
    var userid = $("#alluserid").val();
    if (name == "") {
        $("#msg1").text("Name field is required");
        return false;
    }
    var tc = $("table.customerdetail tbody tr").length;
    if (tc == null) {
        var tc = $("table.customerdetail-1 tbody tr").length;
    }
    var allname = name.split(",");
    if (tc > allname.length) {
        var newname = $("#username0").text();
        var newuserid = $("#userid0").text();
        for (var s = 1; s < tc; s++) {
            newname += ",".concat($("#username" + s).text());
            newuserid += ",".concat($("#userid" + s).text());
        }
        if (name.length < newname.length) {
            name = $.trim(newname.replace(/\s+/g, " "));
            userid = $.trim(newuserid.replace(/\s+/g, " "));
        }
    }
    if (name == "") {
        $("#msg1").text("Name field is required");
        return false;
    }
    //reservation details
    var booking_type = $("#booking_type").find(":selected").val();
    var booking_source = $("#booking_source").find(":selected").val();
    var bsorurce_no = $("#bsorurce_no").val();
    var arrival_from = $("#arrival_from").val();
    var pof_visit = $("#pof_visit").val();
    var booking_remarks = $("#booking_remarks").val();
    var total_gstamt    = $("#total_gstamt").val(); //kiran
    var days = $("#days").val(); //kiran
    //user details
    var email = $("#allemail").val();
    var mobile = $("#allmobile").val();
    var lastname = $("#alllastname").val();
    var gender = $("#allgender").val();
    var father = $("#allfather").val();
    var occupation = $("#alloccupation").val();
    var dob = $("#alldob").val();
    var anniversary = $("#allanniversary").val();
    var pitype = $("#allpitype").val();
    var imgfront = $("#allimgfront").val();
    var imgback = $("#allimgback").val();
    var imgguest = $("#allimgguest").val();
    var contacttype = $("#allcontacttype").val();
    var state = $("#allstate").val();
    var city = $("#allcity").val();
    var zipcode = $("#allzipcode").val();
    var address = $("#alladdress").val();
    var country = $("#allcountry").val();
    var gst_no = $("#gst_no").val();
    var companyname = $("#companyname").val();
    var employee_id = $("#employee_id").val();
    //payment details
    var discountreason = $("#discountreason").val();
    var discountamount = $("#discountamount").val();
    var commissionrate = $("#commissionrate").val();
    var commissionamount = $("#commissionamount").val();
    var paymentmode = $("#paymentmode").find(":selected").val();
    if (paymentmode == "Bank Payment") {
        if ($("#cardno").val() == "") {
            $("#cardno").addClass("is-invalid");
            return false;
        } else if ($("#bankname").find(":selected").val() == "") {
            $("#cardno").removeClass("is-invalid");
            $("#bankname").parent().addClass("is-invalid");
            return false;
        } else {
            $("#cardno").removeClass("is-invalid");
            $("#bankname").parent().removeClass("is-invalid");
        }
    }
    var bankname = $("#bankname").find(":selected").val();
    var cardno = $("#cardno").val();
    var advanceamount = $("#advanceamount").val();
    var advanceremarks = $("#advanceremarks").val();

    //kiran
    var pl_k = $("table.payment tbody tr").length;
    var paymentmode_k = "";
    var paymentamount_k = "";
    var cardno_k = "";
    var bankname_k = "";
    var recdate_k = "";
    for (var i = 0; i < pl_k; i++) {
        paymentmode_k += $("#paymentmode_" + i).find(":selected").val() + ",";
        paymentamount_k += $("#cash_" + i).val() + ",";
        recdate_k += $("#recdate_" + i).val() + ",";
        bankname_k += $("#bankname_" + i).find(":selected").val() + ",";
        cardno_k += $("#cardno_" + i).val() + ",";
        $('.selectpicker').selectpicker('refresh');
        $("#paymentmode_" + i).parent().removeClass("is-invalid");
        if ($("#paymentmode_" + i).find(":selected").val() == "" & parseFloat($("#balance").text()) > 0) {
            $("#paymentmode_" + i).parent().addClass("is-invalid");
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        $("#cash_" + i).removeClass("is-invalid");
        if ($("#cash_" + i).val() == "" & parseFloat($("#balance").text()) > 0) {
            $("#cash_" + i).addClass("is-invalid");
            return false;
        }
        $("#cardno_" + i).removeClass("is-invalid");
        $("#bankname_" + i).parent().removeClass("is-invalid");
        if ($("#paymentmode_" + i).find(":selected").val() != 'Cash Payment' & $("#cardno_" + i).val() == "" &
            parseFloat($("#balance").text()) > 0) {
            $("#cardno_" + i).addClass("is-invalid");
            return false;
        }
        $("#bankname_" + i).parent().removeClass("is-invalid");
        if ($("#paymentmode_" + i).find(":selected").val() == 'Bank Payment' & $("#bankname_" + i).find(":selected")
            .val() == "") {
            $("#bankname_" + i).parent().addClass("is-invalid");
            return false;
        }
    }
    paymentmode_k = paymentmode_k.replace(/,\s*$/, "");
    paymentamount_k = paymentamount_k.replace(/,\s*$/, "");
    recdate_k = recdate_k.replace(/,\s*$/, "");
    bankname_k = bankname_k.replace(/,\s*$/, "");
    cardno_k = cardno_k.replace(/,\s*$/, "");
    //end kiran

    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/checkinBooking";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            booking_type: booking_type,
            booking_source: booking_source,
            bsorurce_no: bsorurce_no,
            arrival_from: arrival_from,
            pof_visit: pof_visit,
            booking_remarks: booking_remarks,
            days: days, //kiran
            datefilter1: datefilter1,
            datefilter2: datefilter2,
            room_type: room_type,
            roomno: roomno,
            children: children,
            adults: adults,
            rent: rent,
            discount_price: offer_price,
            complementary: complementary,
            complementaryprice: complementaryprice,
            userid: userid,
            name: name,
            mobile: mobile,
            email: email,
            lastname: lastname,
            gender: gender,
            father: father,
            occupation: occupation,
            dob: dob,
            anniversary: anniversary,
            pitype: pitype,
            imgfront: imgfront,
            imgback: imgback,
            imgguest: imgguest,
            contacttype: contacttype,
            state: state,
            city: city,
            zipcode: zipcode,
            address: address,
            country: country,
            gst_no: gst_no,
            companyname: companyname,
            employee_id: employee_id,
            bed: bed,
            amount1: amount1,
            person: person,
            amount2: amount2,
            child: child,
            amount3: amount3,
            extrastart: extrastart,
            extraend: extraend,
            discountreason: discountreason,
            discountamount: discountamount,
            commissionrate: commissionrate,
            commissionamount: commissionamount,
            paymentmode: paymentmode,
            bankname: bankname,
            cardno: cardno,
            advanceamount: advanceamount,
            advanceremarks: advanceremarks,
            
            paymentmode_k : paymentmode_k,
            paymentamount_k : paymentamount_k,
            recdate_k : recdate_k,
            bankname_k : bankname_k,
            cardno_k : cardno_k,

            gst    : gst,
            gstamt : gstamt,
            total_gstamt : total_gstamt,
        },
        success: function(data) {
            if (data.substr(4, 1) === "S") {
                $("#checkin_list").show();
                $("#reservation").hide();
                toastrSuccessMsg(data);
                $("#checkindetails").DataTable().ajax.reload();
                $(".sidebar-mini").removeClass('sidebar-collapse');
            } else
                toastrErrorMsg(data);
            setTimeout(function() {}, 1000);
        }
    });
}
'use strict';
$("#view_checin,#previous").on("click", function() {
    $("#checkin_list").show();
    $("#reservation").hide();
    $("#openregister").modal('hide');
    $(".sidebar-mini").removeClass('sidebar-collapse');
});

/*----- kiran chavan payment grid -----*/
function paymode(l) { 
    "use strict";
    $("#paymentmode_" + l).on("change", function() {
        var pmode = $("#paymentmode_" + l).find(":selected").val();
        if (pmode && pmode != "Cash Payment" && pmode != "Bank Payment") {
            $('#bankname_' + l + '').selectpicker('hide');
            $('#recdate_' + l + '').prop("hidden", false);
            $('#modedetails_' + l + '').prop("hidden", false);
            $('#cash_' + l + '').prop("disabled", false);
            var balance = $("#balance").text();
            $('#cash_' + l + '').val(balance);
            $('#cash_' + l + '').trigger('change');
            $("table.payment tbody > tr > td [id=cardno_" + l + "]").attr({
                placeholder: "Card No"
            });
            $("table.payment tbody > tr > td [id=recdate_" + l + "]").attr({
                placeholder: "Date"
            });
            $("table.payment tbody > tr > td [id=recdate_" + l + "]").addClass("datefilter2");
            $('.datefilter2').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "timePicker": true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });
        } else if (pmode == "Bank Payment") {
            $('#bankname_' + l + '').selectpicker('show');
            $('#modedetails_' + l + '').prop("hidden", false);
            $('#recdate_' + l + '').prop("hidden", true);
            $('#cash_' + l + '').prop("disabled", false);
            var balance = $("#balance").text();
            $('#cash_' + l + '').val(balance);
            $('#cash_' + l + '').trigger('change');
            $("table.payment tbody > tr > td [id=cardno_" + l + "]").attr({
                placeholder: "Account No"
            });
            $("table.payment tbody > tr > td [id=recdate_" + l + "]").attr({
                placeholder: "Bank Name"
            });
            $("table.payment tbody > tr > td [id=recdate_" + l + "]").val('');
            $("table.payment tbody > tr > td [id=recdate_" + l + "]").removeClass("datefilter2");
        } else {
            $('#modedetails_' + l + '').prop('hidden', true);
            $('#cash_' + l + '').trigger('change');
            if (pmode == "Cash Payment") {
                var balance = $("#balance").text();
                $('#cash_' + l + '').val(balance);
                $('#cash_' + l + '').trigger('change');
                $('#cash_' + l + '').prop("disabled", false);
            } else {
                $('#cash_' + l + '').val('');
                $('#cash_' + l + '').prop("disabled", true);
            }
        }
    });
    "use strict";
    $("#cash_" + l + "").on("keyup change", function() {
        var balance = parseFloat($("#payableamt").text());
        var invcredit = $("#creditamount").val();
        var len = $("table.payment tbody tr").length;
        var cash = 0;
        for (var nl = 0; nl < len; nl++) {
            var s = nl + 1;
            var newTr = $("<tr id='paymentmethod_" + s + "' hidden>");
            var tr = "";
            tr += '<td class="res-padding" id="pmode_' + s +
                '"></td><td class="res-allign-padding" id="pamount_' + s + '">Amount</td>';
            newTr.append(tr);
            $("table.paymentdetails").append(newTr);
            var newcash = parseFloat($("#cash_" + nl + "").val());
            if (isNaN(newcash)) {
                newcash = 0;
            }
            if (newcash > 0) {
                $("#paymentmethod_" + s + "").prop("hidden", false);
                var method = $("#paymentmode_" + nl).find(":selected").val();
                $('#pmode_' + s + '').text(method);
                $('#pamount_' + s + '').text(newcash);
            } else {
                $("#paymentmethod_" + s + "").closest("tr").remove();
            }
            cash += newcash;
        }
        /*paidtotal = cash;
        if (cash >= 0) {
            var bal = balance - paidtotal;
            $("#balance").text(balance - paidtotal >= 0 ? bal.toFixed(2) : 0);
            $("#collectedamt").text(paidtotal.toFixed(2));
            var refam = paidtotal - balance;
            $("#refunddamt").text(paidtotal - balance > 0 ? refam.toFixed(2) : 0);
            if (paidtotal - balance >= 0) {
                $("#ipaid").text("Paid");
                $("#checkout").attr("disabled", false);
                $("#ipaid").removeClass("color-red");
            } else {
                $("#ipaid").text("Unpaid");
                $("#ipaid").addClass("color-red");
                $("#checkout").attr("disabled", true);
            }
            if (paidtotal > 0) {
                $("#paidamounttitle").attr("hidden", false);
                $("#paidamount").text((position==1?currency:'')+paidtotal.toFixed(2)+(position==2?currency:''));
            } else {
                $("#paidamounttitle").attr("hidden", true);
            }
            if (paidtotal - balance > 0) {
                var amt = paidtotal - balance;
                $("#changeamounttitle").attr("hidden", false);
                $("#changeamount").text((position==1?currency:'')+ amt.toFixed(2)+(position==2?currency:''));
            } else {
                $("#changeamounttitle").attr("hidden", true);
            }
            if (invcredit > 0) {
                $("#ipaid").removeClass("color-red");
                $("#ipaid").text("Credit");
            }
        }*/
    });
}

var payinfo = $("#paymentinfo").html();
var bankinfo = $("#bankinfo").html();
var i = 1;
"use strict";
$("#multipayment").on("click", function() { 
    var newRow = $("<tr>");
    var td = "";
    td +=
        '<td class="border-0 pl-0"><div class="form-floating with-icon"><select class="selectpicker form-select" data-live-search="true" data-width="100%" onchange="paymode(' +
        i + ')" id="paymentmode_' +
        i + '">' +
        +'' + payinfo +
        '</select><label for="paymentmode">Payment Mode</label><i class="fas fa-credit-card"></i></div><div class="row mt-2" id="modedetails_' +
        i + '" hidden>' +
        '<div class="col"><input type="text" id="cardno_' + i +
        '" class="form-control form-control-sm"></div><div class="col"><input type="text" id="recdate_' + i +
        '" class="form-control form-control-sm">' +
        '<select class="selectpicker form-select" data-live-search="true" data-width="100%" id="bankname_' + i +
        '">' + bankinfo +
        '</select></div></div></td>';
    td +=
        '<th class="border-0"><input type="text" disabled class="form-control cash_amt" id="cash_' + i +
        '" placeholder="Amount" onchange="getTotal();" value=""></th>';
    td += '<td class="border-0 pr-0 text-right"><button type="button" onclick="delrow(' + i + '); call(' + i + ');" id="del' + i +
        '" class="btn btn-danger-soft del' + i + '"><i class="far fa-times-circle"></i></button></td>';
    newRow.append(td);
    $("table.payment").append(newRow);
    $('.selectpicker').selectpicker('refresh');
    i++;
});

function getTotal(){
    var sum = 0;
    $('.cash_amt').each(function(){
        sum += parseFloat(this.value);
    });
    $('#advanceamount').val(sum);
}

function call(r) { 
    "use strict";
    var tc = $("table.payment tbody tr").length;
    if (1 == tc) {
        swal({
            title: "Failed",
            text: "There only one row you can't delete.",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    } else if (tc == (r + 1)) {
        $('.del' + r).closest("tr").remove();
        $("#cash_0").trigger('change');
        $("#paymentmethod_" + tc + "").closest("tr").remove();
        i--;
    } else {
        var k = r;
        $('.del' + k).closest("tr").remove();
        for (k = r + 1; k < tc; k++) {
            $("table.payment tbody > tr > td select[id=paymentmode_" + k + "]").attr({
                onchange: "paymode(" + r + ")",
                id: "paymentmode_" + r + ""
            });
            $("table.payment tbody > tr > td [id=modedetails_" + k + "]").attr({
                id: "modedetails_" + r + ""
            });
            $("table.payment tbody > tr > td [id=cardno_" + k + "]").attr({
                id: "cardno_" + r + ""
            });
            $("table.payment tbody > tr > td [id=recdate_" + k + "]").attr({
                id: "recdate_" + r + ""
            });
            $("table.payment tbody > tr > td [id=bankname_" + k + "]").attr({
                id: "bankname_" + r + ""
            });
            $("table.payment tbody > tr > th [id=cash_" + k + "]").attr({
                id: "cash_" + r + ""
            });
            $("table.payment tbody > tr > td button[id=del" + k + "]").attr({
                onclick: "delrow(" + r + "); call(" + r + ")",
                id: "del" + r + "",
                class: "btn btn-danger-soft del" + r + ""
            });
            r++;
        }
        // $("#paymentmode_0").trigger('change');
        // $("#cash_0").trigger('change');
        $("#paymentmethod_" + r + "").closest("tr").remove();
        i--;
    }
    getTotal();
}

