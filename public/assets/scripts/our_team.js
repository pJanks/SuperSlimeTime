const fetchTeamMembers = async () => {
  toggleLoadState();
  const teamMembersData = await handleNetworkRequest('/api/fetch_our_team');
  populateTeamMembersOnPage(teamMembersData);
}

const populateTeamMembersOnPage = (teamMembersData) => {
  try {
    const ourTeamCardsWrapper = document.querySelector('.our-team-cards-wrapper');
    
    teamMembersData.forEach(teamMember => {
      const teamMemberCard = `
        <article class="team-member-card">
          <div class="team-member-image-wrapper">
            <img class="team-member-image" src="${teamMember.image_link}" alt="A photo of our ${teamMember.title}, ${teamMember.name}">
          </div>
          <h3 class="team-member-name">${teamMember.name}</h3>
          <h4 class="team-member-title">${teamMember.title}</h4>
          <p class="team-member-description">${teamMember.description}</p>
        </article>
      `;
      ourTeamCardsWrapper.innerHTML += teamMemberCard;
    });

    let imagesCounter = teamMembersData.length;
    const images = document.querySelectorAll('.team-member-image');

    const handleImageLoad = () => {
      imagesCounter--;
      if (!imagesCounter) toggleLoadState();
    };
      
    images.forEach(image => image.addEventListener('load', handleImageLoad));
  } catch (error) {
    console.error(`populateTeamMembersOnPage() error: ${error}`);
    toggleSuccessOrErrorModal(`An error occurred.`);
    toggleLoadState();
  }
}

document.addEventListener('DOMContentLoaded', fetchTeamMembers);