var KTBootstrapSwitch = (function () {
    // Private functions
    var demos = function (e) {
        $("#themeSwitch").on(
            "switchChange.bootstrapSwitch",
            function (event, state) {
                xhrThemeChange();
            }
        );

        $("[data-switch=true]").bootstrapSwitch();
    };

    return {
        // public functions
        init: function () {
            demos();
        },
    };
})();

jQuery(document).ready(function () {
    KTBootstrapSwitch.init();
});

function xhrThemeChange() {
    const csrf = document.getElementById("csrfToken").content;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", Theme.routes.themeColorChange, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("X-CSRF-TOKEN", csrf);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                if (xhr.response) {
                    window.location.reload();
                }
            } else {
                toastr.error(
                    JSON.parse(xhr.response).error,
                    "Tema değişirken hata oluştu"
                );
            }
        }
    };
    xhr.send();
}
