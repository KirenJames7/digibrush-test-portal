$(document).ready(() => {
    $('.alert').on("click", (element) => {
        $(element.currentTarget).hide();
    });
    $('.alert:visible').fadeOut(4000);
});
