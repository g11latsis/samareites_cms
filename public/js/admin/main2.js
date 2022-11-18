function crud_drop1(e)
{
    e.style.backgroundColor = "#ebebeb";
}

function crud_drop2(e)
{
    e.style.backgroundColor = "revert";
}

$(".admin-show-hide-pass").on("click", function(e){
    e.preventDefault();
    var elem1 = $(".admin-show-hide-pass");
    var elem2 = $("#admin-pass-show-hide");
    if(elem1.hasClass('btn-success')){
        elem1.removeClass('btn-success');
        elem1.addClass('btn-danger');
        elem1.html('Κρύβω');
        elem2.attr('type', 'text');
    }else{
        elem1.removeClass('btn-danger');
        elem1.addClass('btn-success');
        elem1.html('προβολή');
        elem2.attr('type', 'password');
    }
});

$("#rg-user-choose").on("click", function(e){
    var elem1 = e.target;
    var elem2 = $("#login-iden");
    var heading = $("#iden-heading");
    if(elem1.value == 'ra'){
        elem2.val("ra");
        heading.html("Περιφερειακός Διαχειριστής");
    }else{
        elem2.val("user");
        heading.html("Εθελοντής");
    }
});

document.getElementById('raUserRegion').readOnly = true;