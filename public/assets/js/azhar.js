// All image id

$(document).ready(function (e) {
    $("#image").change(function () {
        let reader = new FileReader();

        reader.onload = (e) => {
            $("#image_preview").attr("src", e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
    });
});

/// category icon

$(document).ready(function (e) {
    $("#icon").change(function () {
        let reader = new FileReader();

        reader.onload = (e) => {
            $("#icon_preview").attr("src", e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
    });
});
