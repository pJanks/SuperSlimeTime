const fetchProducts = async () => {
  toggleLoadState();
  const productsData = await handleNetworkRequest('/api/fetch_products');
  populateProductsOnPage(productsData);
}

const populateProductsOnPage = (productsData) => {
  try {
    const ourTeamCardsWrapper = document.querySelector('.products-cards-wrapper');

    productsData.forEach(product => {
      const productCard = `
        <article class="product-card">
          <div class="product-image-wrapper">
            <img class="product-image" src="${product.image_link}" alt="A photo of our ${product.name} product">
          </div>
          <h3 class="product-name">${product.name}</h3>
          <p class="product-description">${product.description}</p>
        </article>
      `;
      ourTeamCardsWrapper.innerHTML += productCard;
    });

    let imagesCounter = productsData.length;
    const images = document.querySelectorAll('.product-image');

    const handleImageLoad = () => {
      imagesCounter--;
      if (!imagesCounter) toggleLoadState();
    };
      
    images.forEach(image => image.addEventListener('load', handleImageLoad));
  } catch (error) {
    console.error(`populateProductsOnPage() error: ${error}`);
    toggleSuccessOrErrorModal(`An error occurred`);
    toggleLoadState();
  }
}

document.addEventListener('DOMContentLoaded', fetchProducts);