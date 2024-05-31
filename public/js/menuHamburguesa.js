function toggleLeftMenu() {
    var menuItems = document.querySelector('.menu-items');
    var rightMenuItems = document.querySelector('.right ul.menu-items');
    var icon = document.querySelector('.fas .fa-bars .menu-open');

    if (rightMenuItems.classList.contains('active')) {
        rightMenuItems.classList.remove('active');
    }

    menuItems.classList.toggle('active');

}

function toggleRightMenu() {
    var menuItems = document.querySelector('.right ul.menu-items');
    var leftMenuItems = document.querySelector('.menu-items');

    if (leftMenuItems.classList.contains('active')) {
        leftMenuItems.classList.remove('active');
    }

    menuItems.classList.toggle('active');
}

