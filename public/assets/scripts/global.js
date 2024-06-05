const handleNetworkRequest = async (url, options = {}) => {
  try {
    const response = await fetch(url, options);
    if (!response.ok) {
      throw new Error(`network request error, response status: ${response.status}`);
    }
    const parsedResponse = await response.json();
    return parsedResponse;
  } catch (error) {
    console.error(`handleNetworkRequest() error: ${error}`);
    throw error;
  }
}

// begin modal state logic
const successOrErrorModalMessage = document.querySelector('.success-or-error-message');
const successOrErrorModalHeading = document.querySelector('.success-or-error-message-heading');
const successOrErrorModalWrapper = document.querySelector('.success-or-error-message-modal-wrapper');
const successOrErrorModalCloseButton = document.querySelector('.success-or-error-message-modal-close-button');

const toggleLoadState = () => {
  const loaderModal = document.querySelector('.loader-modal-wrapper');
  loaderModal.classList.toggle('hidden');
}

const toggleSuccessOrErrorModal = (message, type = 'error-message') => {
  if (message === 'reset') return resetSuccessOrErrorModal();

  successOrErrorModalMessage.textContent = message;
  successOrErrorModalHeading.textContent = type === 'error-message' ? 'Error:' : 'Success:';
  successOrErrorModalHeading.classList.add(type);
  successOrErrorModalWrapper.classList.toggle('hidden');
}

const resetSuccessOrErrorModal = () => {
  const classToRemove = successOrErrorModalHeading.classList.contains('error-message') ? 'error-message' : 'success-message';
  successOrErrorModalMessage.textContent = '';
  successOrErrorModalHeading.textContent = '';
  successOrErrorModalHeading.classList.remove(classToRemove);
  successOrErrorModalWrapper.classList.toggle('hidden');
}

const handleSuccessOrErrorModalCloseButtonClick = () => {
  toggleSuccessOrErrorModal('reset');
  toggleFormStateForModal();
}

const toggleFormStateForModal = () => {
  if (contactForm) {
    const elementsToToggleState = [
      nameInput,
      phoneInput,
      emailInput,
      messageInput,
      mainHeadingLink,
      hamburgerMenuButton,
      submitContactFormButton,
      ...mainNavLinks,
    ];
  
    elementsToToggleState.forEach(el => {
      el.tabIndex === -1 ? el.tabIndex = 0 : el.tabIndex = -1;
    });
  }
}

successOrErrorModalCloseButton.addEventListener('click', handleSuccessOrErrorModalCloseButtonClick);
// end modal state logic

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

// begin other 'main-header' globals
const mainHeadingLink = document.querySelector('.main-heading-link');
const mainNavLinks = document.querySelectorAll('.main-nav-link');
// end other 'main-header' globals