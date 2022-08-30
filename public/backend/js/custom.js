$("#show_image").attr(
    "src",
    "https://ui-avatars.com/api/?length=5&font-size=0.2&background=77f&color=fff&name=Photo"
);
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#show_image").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$("#image").change(function () {
    readURL(this);
});

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#edit_image").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$("#image").change(function () {
    readURL2(this);
});
