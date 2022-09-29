const searchRestaurant = document.querySelector('#searchRestaurant')
if (searchRestaurant) {
  searchRestaurant.addEventListener('input', async function() {
    const response = await fetch('../api/api_restaurant.php?search=' + this.value)
    const restaurants = await response.json()

    const section = document.querySelector('#pesquisalupa')
    section.innerHTML = ''

    for (const restaurant of restaurants) {
      const article = document.createElement('article')
      article.className = "searchResultCard"
      const img = document.createElement('img')
      img.src ='../img/restaurantImgs/' + restaurant.photo
      const link = document.createElement('a')
      link.href = '../pages/restaurant.php?restaurant_id=' + restaurant.restaurant_id
      link.textContent = restaurant.name
      article.appendChild(img)
      article.appendChild(link)
      section.appendChild(article)
    }
  })
} 