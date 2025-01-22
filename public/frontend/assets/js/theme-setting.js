/*=====================
      Color Picker
==========================*/
var color_picker1 = document.getElementById("colorPick").value;
document.getElementById("colorPick").onchange = function () {
    color_picker1 = this.value;
    document.body.style.setProperty("--theme-color", color_picker1);
    document.body.style.setProperty("--theme-color-rgb", color_picker1);
};

/*========================
 Dark setting js
 ==========================*/
// $("#darkButton").on("click", function () {
//     var href = $("#color-link").attr("href");
//     $("body").removeClass("light");
//     $("body").addClass("dark");
//     document
//         .getElementById("color-link")
//         .setAttribute("href", "frontend/assets/css/dark.css");
// });

// $("#lightButton").on("click", function () {
//     var href = $("#color-link").attr("href");
//     $("body").removeClass("dark");
//     $("body").addClass("light");
//     document
//         .getElementById("color-link")
//         .setAttribute("href", "frontend/assets/css/style.css");
// });

// Dark mode button
$("#darkButton").on("click", function () {
    $("body").removeClass("light").addClass("dark");
    document.getElementById("color-link").setAttribute("href", "/frontend/assets/css/dark.css");
});

// Light mode button
$("#lightButton").on("click", function () {
    console.log("light");
    $("body").removeClass("dark").addClass("light");
    document.getElementById("color-link").setAttribute("href", "/frontend/assets/css/style.css");
});

/*========================
   RTL setting js
   ==========================*/
// $(".rtl").on("click", function () {
//     if ($("body").hasClass("ltr")) {
//         $("html").attr("dir", "rtl");
//         $("body").removeClass("ltr");
//         $("body").addClass("rtl");
//         $("#rtl-link").attr("href", "frontend/assets/css/vendors/bootstrap.rtl.css");
//     } else {
//         $("html").attr("dir", "");
//         $("body").removeClass("rtl");
//         $("body").addClass("ltr");
//         $("#rtl-link").attr("href", "frontend/assets/css/vendors/bootstrap.css");
//     }
// });
$(".rtl").on("click", function () {
    if ($("body").hasClass("ltr")) {
        $("html").attr("dir", "rtl");
        $("body").removeClass("ltr").addClass("rtl");
        $("#rtl-link").attr("href", "/frontend/assets/css/vendors/bootstrap.rtl.css");
    } else {
        $("html").attr("dir", "");
        $("body").removeClass("rtl").addClass("ltr");
        $("#rtl-link").attr("href", "/frontend/assets/css/vendors/bootstrap.css");
    }
});
