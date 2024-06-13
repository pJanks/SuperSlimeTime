const nameInput = document.querySelector('.name-input');
const phoneInput = document.querySelector('.phone-input');
const emailInput = document.querySelector('.email-input');
const contactForm = document.querySelector('.contact-form');
const messageInput = document.querySelector('.message-input');
const messageCharCount = document.querySelector('.message-char-count');
const submitContactFormButton = document.querySelector('.submit-contact-form-button');

const handleContactFormSubmission = async (e) => {
  e.preventDefault();

  const name = nameInput.value;
  const phone = phoneInput.value;
  const email = emailInput.value;
  const message = messageInput.value;

  try {
    toggleFormStateForModal();
    toggleLoadState();

    const headers = { 'Content-Type': 'application/json' };
    const body = JSON.stringify({
      name,
      phone,
      email,
      message,
    });

    const options = {
      method: 'POST',
      headers,
      body,
    };

    await handleNetworkRequest('/api/submit_contact_form', options);
    toggleSuccessOrErrorModal('Email sent successfully', 'success-message');
    toggleLoadState();
    resetContactForm();
  } catch (error) {
    console.error(`handleContactFormSubmission() error: ${error}`);
    toggleSuccessOrErrorModal(`Email failed to send: ${error}`);
    toggleLoadState();
  }
}

const resetContactForm = () => {
  const inputsToReset = [
    nameInput,
    phoneInput,
    emailInput,
    messageInput,
  ];
  
  inputsToReset.forEach(input => input.value = '');
  updateCharCountForMessage();
};

const updateCharCountForMessage = () => {
  const maxCharLength = Number(messageInput.getAttribute('maxlength'));
  const currentCharLength = messageInput.value.length;
  const messageCharsRemaining = maxCharLength - currentCharLength;
  messageCharCount.textContent = String(messageCharsRemaining);
}

messageInput.addEventListener('input', updateCharCountForMessage);
contactForm.addEventListener('submit', handleContactFormSubmission);