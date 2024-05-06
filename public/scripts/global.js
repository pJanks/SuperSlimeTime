console.log('global.js');


// responsive menu logic
const hamburgerMenuButton = document.querySelector('.hamburger-menu-button');
const closeMenuButton = document.querySelector('.close-menu-button');
const responsiveNav = document.querySelector('.responsive-nav');

const toggleResponsiveMenuButtons = () => {
  hamburgerMenuButton.classList.toggle('hidden');
  closeMenuButton.classList.toggle('hidden');
  responsiveNav.classList.toggle('hidden');
  console.log('hello nurse');
}

hamburgerMenuButton.addEventListener('click', toggleResponsiveMenuButtons);
closeMenuButton.addEventListener('click', toggleResponsiveMenuButtons);