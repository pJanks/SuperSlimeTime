const contactForm = document.querySelector('.contact-form');
const nameInput = document.querySelector('.name-input');
const phoneInput = document.querySelector('.phone-input');
const emailInput = document.querySelector('.email-input');
const messageInput = document.querySelector('.message-input');
const messageCharCount = document.querySelector('.message-char-count');

const handleContactFormSubmission = async (e) => {
  e.preventDefault();

  const name = nameInput.value;
  const phone = phoneInput.value;
  const email = emailInput.value;
  const message = messageInput.value;

  // if (name && email && message) toggleLoadState();

  try {
    const headers = { 'Content-Type': 'application/json' };
    const body = JSON.stringify({ name, phone, email, message });
    const options = {
      method: 'POST',
      headers,
      body,
    }
    const contactFormSubmissionResponse = await handleNetworkRequest('/api/submit_contact_form', options);

    if (contactFormSubmissionResponse.status === 'success') {
      // toggleLoadState();
      // toggleSuccessOrErrorMessage();
    }

  } catch (error) {
    console.error('there was an error with the message request');
  }
}

const updateCharCountForMessage = () => {
  const maxCharLength = Number(messageInput.getAttribute('maxlength'));
  const currentCharLength = messageInput.value.length;
  const messageCharsRemaining = maxCharLength - currentCharLength;
  messageCharCount.textContent = String(messageCharsRemaining);
}

contactForm.addEventListener('submit', handleContactFormSubmission);
messageInput.addEventListener('input', updateCharCountForMessage);