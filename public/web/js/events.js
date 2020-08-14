("form[name=signin_with_account_form]").on("submit", function(a) {
    var b = $(this);
    b.parsley().validate();
    if (b.parsley().isValid()) {
        $("#errmessage").html("");
        $.ajax({
            url: APP_URL + "/login",
            data: b.serialize(),
            type: "POST",
            dataType: "json",
            success: function(a) {
                $("#overlay").remove();
                location.reload();
            },
            error: function(a) {
                $("#overlay").remove();
                var b = a.responseJSON;
                console.log(b);
                $("#errmessage").html('<div class="alert alert-danger p-10">' + b.message + "</div>");
            }
        });
    } else ;
    a.preventDefault();
});

$("form[name=signup_with_account_form]").on("submit", function(a) {

    var b = $(this);
    b.parsley().validate();
    if (b.parsley().isValid()) {
        $("#errmessage").html("");
        $.ajax({
            url: APP_URL + "/register",
            data: b.serialize(),
            type: "post",
            dataType: "json",
            success: function(a) {
                console.log("resp", a);
                $("#overlay").remove();
                $("#account_registration_success_message").removeClass("hidden");
                $("#account_registration_form").addClass("hidden");
                location.reload();
            },
            error: function(a) {
                console.log("errors", a);
                var b = JSON.parse(a.responseText);
                var c = b.errors;
                for (key in c) {
                    $("#R_" + key).html("");
                    $("#R_" + key).html('<span class="text-danger">' + c[key] + "</span>");
                }
            }
        });
    } else ;
    a.preventDefault();
});