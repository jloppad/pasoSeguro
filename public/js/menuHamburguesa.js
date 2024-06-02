document.addEventListener('DOMContentLoaded', main);

function main() {
    let left_menu = document.getElementById('left-menu-icon');
    let right_menu = document.getElementById('right-menu-icon');

    let leftMenuItems = document.querySelector('.left .menu-items');
    let rightMenuItems = document.querySelector('.right ul.menu-items');

    left_menu.addEventListener('click', function () {
        toggleMenu(leftMenuItems, rightMenuItems);
        toggleIcon('left-menu-icon-i', leftMenuItems.classList.contains('active'));
        toggleIcon('right-menu-icon-i', false);
    });

    right_menu.addEventListener('click', function () {
        toggleMenu(rightMenuItems, leftMenuItems);
        toggleIcon('right-menu-icon-i', rightMenuItems.classList.contains('active'));
        toggleIcon('left-menu-icon-i', false);
    });
}

function toggleMenu(menu, menuOppo) {

    if (menuOppo.classList.contains('active')) {
        menuOppo.classList.remove('active');
    }

    menu.classList.toggle('active');
}

function toggleIcon(iconId, isActive) {

    let icon = document.getElementById(iconId);

    if (isActive) {
        icon.classList.remove('fa-bars', 'fa-user');
        icon.classList.add('fa-times');
    } else {
        icon.classList.remove('fa-times');
        if (iconId === 'left-menu-icon-i') {
            icon.classList.add('fa-bars');
        } else {
            icon.classList.add('fa-user');
        }
    }

}
