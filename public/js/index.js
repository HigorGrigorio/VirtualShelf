
$(window).on('load', () => {
    $('#toggle-side-bar').on('click', () => {
        const side = document.getElementById('side-nav');
        const main = document.getElementById('main-content');

        if (side.classList.contains('active')) {
            side.classList.remove('active');
            side.classList.add('inactive');
        } else {
            side.classList.remove('inactive');
            side.classList.add('active');
        }

        if (main.classList.contains('active')) {
            main.classList.remove('active');
            main.classList.add('inactive');
        } else {
            main.classList.remove('inactive');
            main.classList.add('active');
        }
    }).click();
});
