// begin utils
const handleNetworkRequest = async (url, options = {}) => {
  try {
    const response = await fetch(url, options);
    if (!response.ok) {
      throw new Error(`network request error response status: ${response.status}`);
    }
    const parsedResponse = await response.json();
    return parsedResponse;
  } catch (error) {
    console.error(`handleNetworkRequest() error: ${error}`);
    throw error;
  }
}
// end utils

// begin responsive menu logic
const hamburgerMenuButton = document.querySelector('.hamburger-menu-button');
const hamburgerMenuIcon = document.querySelector('.hamburger-menu-icon');
const closeMenuButton = document.querySelector('.close-menu-button');
const responsiveNav = document.querySelector('.responsive-nav');
const body = document.querySelector('body');

const responsiveMenuElementsToToggle = [hamburgerMenuButton, closeMenuButton, responsiveNav];

const toggleResponsiveMenu = () => {
  responsiveMenuElementsToToggle.forEach(el => el.classList.toggle('hidden'));
}

const handleClickOutsideOfResponsiveMenu = (e) => {
  if (!responsiveNav.classList.contains('hidden') && !responsiveMenuElementsToToggle.includes(e.target) && !responsiveNav.contains(e.target)) {
    toggleResponsiveMenu();
  }
}

const handleResponsiveMenuOnResize = () => {
  const screenWidth = window.innerWidth;
  if (!responsiveNav.classList.contains('hidden') && screenWidth > 600) {
    toggleResponsiveMenu();
  }
}

hamburgerMenuButton.addEventListener('click', toggleResponsiveMenu);
closeMenuButton.addEventListener('click', toggleResponsiveMenu);
body.addEventListener('click', handleClickOutsideOfResponsiveMenu);
window.addEventListener('resize', handleResponsiveMenuOnResize);
// end responsive menu logic