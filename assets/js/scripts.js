document.addEventListener("DOMContentLoaded", function(event){

let indicator = document.createElement('span');
indicator.className = 'indicator';
document.querySelector('.bp-menu ul').appendChild(indicator);

let menus = document.querySelectorAll('.bp-menu li.menu-item');
let cmenu = document.querySelector('.bp-menu li.current-menu-item');

if (cmenu == null) {
	cmenu = document.querySelector('.bp-menu li.current-menu-parent');
}

function move_menu_indicator(menu) {
	let left = menu.offsetLeft + 'px';
	let width = menu.offsetWidth + 'px';
	indicator.style.left = left;
	indicator.style.width = width;
}

move_menu_indicator(cmenu);

for (let i = 0; i < menus.length; i++) {
	menus[i].addEventListener('mouseenter', function (){
		move_menu_indicator(this);
	});
	menus[i].addEventListener('mouseleave', function(){
		move_menu_indicator(cmenu);
	});
}

});
