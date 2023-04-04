$(window).on('load', () => {
    $('.sidenav-drop-btn').click((e) => {
        e.preventDefault();

        const drop = $(e.target).closest('.sidenav-drop');
        console.log(drop);
        drop.hasClass('active') ? drop.removeClass('active') : drop.addClass('active');
    })

    $('#toggle-side-bar').on('click', () => {
        const side = document.getElementById('side-nav');
        const main = document.getElementById('main-content');

        if (side.classList.contains('active')) {
            side.classList.remove('active');
        } else {
            side.classList.add('active');
        }

        if (main.classList.contains('active')) {
            main.classList.remove('active');
        } else {
            main.classList.add('active');
        }
    }).click();
});
