function attachBuyEvents() {
  for (const button of document.querySelectorAll('#dishes button')){
    button.addEventListener('click', function(e) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log("Added to session");
                console.log(this.responseText);
            }
        }
      const article = this.parentElement
      
      const restaurant_id = document.getElementById("nameRestaurant").getAttribute('restaurant-id')
      const id = article.getAttribute('data-id')
      const quantity = article.querySelector('.quantity').value
      const name = article.querySelector('h3').textContent
      const price = article.querySelector('.price').textContent

        xmlhttp.open("get", "../api/add_to_cart.php?restaurant_id=" + restaurant_id + "&dish_id=" + id + "&quantity=" + quantity, true);
        xmlhttp.send();
      

      const row = document.querySelector(`.shoppingCart table tr[data-id="${id}"]`)



      
      if (row) updateRow(row, price, quantity)
      else addRow(id, name, price, quantity)

      updateTotal()
    })    
  }

}

function addRow(id, name, price, quantity) {
  const table = document.querySelector('.shoppingCart table')
  const row = document.createElement('tr')
  row.setAttribute('data-id', id)

  const nameCell = document.createElement('td')
  nameCell.textContent = name

  const quantityCell = document.createElement('td')
  quantityCell.textContent = quantity

  const priceCell = document.createElement('td')
  priceCell.textContent = price

  const totalCell = document.createElement('td')
  totalCell.textContent = price * quantity

  const deleteCell = document.createElement('td')
  deleteCell.classList.add('delete')
  deleteCell.innerHTML = '<i style="font-size:1em; color:gray;" class="fas">&#xf2ed;</i>'
  deleteCell.querySelector('i').addEventListener('click', function(e) {
    e.preventDefault()
    e.currentTarget.parentElement.parentElement.remove()
    updateTotal()
  })

  row.appendChild(nameCell)
  row.appendChild(quantityCell)
  row.appendChild(priceCell)
  row.appendChild(totalCell)
  row.appendChild(deleteCell)

  table.appendChild(row)
}

function updateRow(row, price, quantity) {
  const quantityCell = row.querySelector('td:nth-child(2)')
  const totalCell = row.querySelector('td:nth-child(4)')
  
  quantityCell.textContent = parseInt(quantityCell.textContent, 10) + parseInt(quantity, 10)
  totalCell.textContent = parseInt(quantityCell.textContent, 10) * parseInt(price, 10)
}

function updateTotal() {
  const rows = document.querySelectorAll('.shoppingCart table > tr')
  const values = [...rows].map(r => parseInt(r.querySelector('td:nth-child(4)').textContent, 10)) 
  const total = values.reduce((t, v) => t + v, 0)
  document.querySelector('.shoppingCart table tfoot td:nth-child(2)').textContent = total
}

attachBuyEvents()