window.addEventListener("load", function () {
    const message = getCookie("message");
    if (message) {
        var toastMessage = document.getElementById("toast-message");
        toastMessage.innerHTML = message;
        const toast = new bootstrap.Toast(document.getElementById("liveToast"));
        toast.show();
        deleteCookie("message");
    }
});

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name) {
    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
}