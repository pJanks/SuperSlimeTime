// begin utils
const handleNetworkRequest = async (url, options = {}) => {
  try {
    const response = await fetch(url, options);
    if (!response.ok) {
      throw new Error(`response status: ${response.status}`);
    }
    const parsedResponse = await response.json();
    return parsedResponse;
  } catch (error) {
    console.error(`handleNetworkRequest error: ${error}`);
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

const toggleResponsiveMenu = () => {
  const elementsToToggleHidden = [hamburgerMenuButton, closeMenuButton, responsiveNav];
  elementsToToggleHidden.forEach(element => element.classList.toggle('hidden'));
}

const handleClickOutsideOfResponsiveMenu = (e) => {
  const invalidTargets = [hamburgerMenuButton, hamburgerMenuIcon, closeMenuButton];
  if (!responsiveNav.classList.contains('hidden') && !invalidTargets.includes(e.target) && !responsiveNav.contains(e.target)) {
    toggleResponsiveMenu();
  }
}

const handleResponsiveMenuWhenScreenWidthOver460Px = () => {
  const screenWidth = window.innerWidth;
  if (!responsiveNav.classList.contains('hidden') && screenWidth > 460) {
    toggleResponsiveMenu();
  }
}

hamburgerMenuButton.addEventListener('click', toggleResponsiveMenu);
closeMenuButton.addEventListener('click', toggleResponsiveMenu);
body.addEventListener('click', handleClickOutsideOfResponsiveMenu);
window.addEventListener('resize', handleResponsiveMenuWhenScreenWidthOver460Px);
// end responsive menu logic