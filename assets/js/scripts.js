document.addEventListener("DOMContentLoaded", function(event){

let indicator = document.createElement('span');
indicator.className = 'indicator';
document.querySelector('.bp-menu ul').appendChild(indicator);

let menus = document.querySelectorAll('.bp-menu li.menu-item');
let cmenu = document.querySelector('.bp-menu li.current-menu-item');

if (cmenu == null) {
	cmenu = document.querySelector('.bp-menu li.current-menu-parent');
}

if (cmenu == null) {
	cmenu = document.querySelector('.bp-menu li.menu-item-home');
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

//change position of children comments
let children = document.querySelectorAll('ul.comment-list ul.children');
children.forEach(function(child) {
	sibling = child.previousElementSibling;
	sibling.querySelector('.flex-grow-1').appendChild(child);
});

//change position of comment form
/*let form = document.querySelector('.comment-respond');
replys = document.querySelectorAll('.comment-action .comment-reply-link');
replys.forEach(function(reply) {
	reply.closest('.comment-content').appendChild(form);
});*/

//start highlight
document.querySelectorAll('pre code').forEach(function(el){
	hljs.highlightElement(el);
});

});
