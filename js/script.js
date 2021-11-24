document.addEventListener('DOMContentLoaded', () => {
	const burger = document.getElementById('burger-menu');
	const nav = document.getElementById('navbar');
	const navContainer = document.getElementById('nav-container');
	burger.addEventListener('click', () => {
		nav.classList.toggle('active');
		navContainer.classList.toggle('active');
		console.log('object');
	});
});
