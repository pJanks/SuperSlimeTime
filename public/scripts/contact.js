const contactForm = document.querySelector('.contact-form');
const messageInput = document.querySelector('.message-input');
const messageCharacterCount = document.querySelector('.message-character-count');

const handleContactFormSubmission = async (e) => {
  e.preventDefault();

  const name = document.querySelector('.name-input').value;
  const phone = document.querySelector('.phone-input').value;
  const email = document.querySelector('.email-input').value;
  const message = messageInput.value;



  try {
    const headers = { 'Content-Type': 'application/json' };
    const body = JSON.stringify({ name, phone, email, message });
    const options = {
      method: 'POST',
      headers,
      body,
    }
    const responseData = await handleNetworkRequest('/api/submit_contact_form', options);
    
    // -- handle successfully sent email here

  } catch (error) {
    console.error('there was an error sending the message request in contact.js');
  }
}



const updateCharacterCountForMessage = () => {
  const maxLength = Number(messageInput.getAttribute('maxlength'));
  const currentCharacterLength = messageInput.value.length;
  const messageCharactersRemaining = maxLength - currentCharacterLength;
  messageCharacterCount.textContent = String(messageCharactersRemaining);
}

contactForm.addEventListener('submit', handleContactFormSubmission);
messageInput.addEventListener('input', updateCharacterCountForMessage);