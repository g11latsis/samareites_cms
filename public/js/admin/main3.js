console.log($("#toggleal"));
$("#toggleal").on("click", function(){
    console.log(true);
});

function toggleShowPdf(e){
    var src = e.getAttribute("name");
    var showPdf = document.getElementById("showPdfModalBody");
    showPdf.src = src;
    $('#showPdfModal').modal('show');
}

function toggleUploadPdf(e){
    var id = e.getAttribute("id");
    var name = e.getAttribute("name");
    console.log(name);
    var form = $("#updatePdfModalForm");
    var input = $("#updatePdfModalBody");
    var route = $(e).data("update");
    console.log(route);
    form.attr("action", route);
    input.attr("name", name);
    $('#updatePdfModal').modal('show');
    console.log(input.attr("name"));
}

function toggleShowPdf2(e){
    var src = e.getAttribute("name");
    var showPdf = document.getElementById("showPdfModalBody2");
    showPdf.src = src;
    $('#showPdfModal2').modal('show');
}

function toggleUploadPdf2(e){
    var id = e.getAttribute("id");
    var name = e.getAttribute("name");
    console.log(name);
    var form = $("#updatePdfModalForm2");
    var input = $("#updatePdfModalBody2");
    var route = $(e).data("update");
    console.log(route);
    form.attr("action", route);
    input.attr("name", name);
    $('#updatePdfModal2').modal('show');
    console.log(input.attr("name"));
}

$(".toggle-sidebar").on("click", function(){
    var togglebtn = $(".toggle-sidebar");
    var sidebar = $(".dash-sidebar");
    var display = sidebar.css("display");
    if(sidebar.css("display") != "none"){
        sidebar.attr( 'style', 'display: none !important;transition: width 2s linear 1s;' );
    }else{
        sidebar.addClass("col-12");
        sidebar.removeClass("col-lg-2");     
        sidebar.attr( 'style', 'display: flex !important; flex-shrink:0 !important; min-height: 100vh !important' );
    }
});

$(".toggle-sidebar2").on("click", function(){
    var sidebar = $(".dash-sidebar");
    sidebar.hide();
});
//console.log(screen.width);
document.querySelectorAll("input").forEach(inpFunc);
function inpFunc(elem){
    elem.style.height = "4.5vh";
    elem.style.borderRadius = "0px";
}

document.querySelectorAll(".form-check-input").forEach(inpFunc2);
function inpFunc2(elem){
    elem.style.height = "1.6vh";
    elem.style.borderRadius = "100px";
}