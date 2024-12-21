
const host = 'http://localhost:3000'
const endpoint = `${host}/api/cart/product/update`
const ordersPage = `${host}/orders`
const loginPage = `${host}/login`

const quantitiesForms = document.getElementsByClassName('quantities-form')
const orderMessage = document.getElementById('order-error')

for (const form of quantitiesForms) {
    form.addEventListener('submit', event => {
        event.preventDefault()

        orderMessage.style.display = 'none'
        const quantitiesFormData = new FormData(event.target)
        const productQuantity = document.getElementById(`product-${form.id}`)
        quantitiesFormData.append(productQuantity.name, productQuantity.value)
        const quantities = {}
        quantitiesFormData.entries().forEach(inputValue => {
            quantities[inputValue[0]] = inputValue[1]
        })
        console.log(quantities)
        sendQuantities(quantities, event.target)
    })
}


function sendQuantities(quantities, form) {
    fetch(endpoint, {
        method: 'POST',
        body: JSON.stringify(quantities)
    })
    .then(res => res.json())
    .then(res => {
        if (res.status == 'ok') {
            console.log(res.data)
            orderMessage.textContent = res.message
            toggleMessageStyle('success')
            setQuantities(res.data, form)
        } else {
            if (res.message == 'No session') {
                location.href = loginPage
            }
            
            orderMessage.textContent = res.message
            toggleMessageStyle('danger')
        }
    })
    .catch(error => {
        console.log(error)
        orderMessage.textContent = "There was an error with the order."
        toggleMessageStyle('danger')
    })
}

function toggleMessageStyle(type) {
    if (type == 'success') {
        if (!orderMessage.classList.contains('message-success')) {
            orderMessage.classList.remove('message-danger')
            orderMessage.classList.add('message-success')
        }
    } else {
        if (!orderMessage.classList.contains('message-danger')) {
            orderMessage.classList.remove('message-success')
            orderMessage.classList.add('message-danger')
        }
    }
    orderMessage.style.display = 'block'
}

function setQuantities(data, form) {
    document.getElementById(`product-${form.id}`).value = data.product
    document.getElementById('subtotal').textContent = data.prices.subtotal + '€'
    document.getElementById('iva').textContent = data.prices.iva + '€'
    document.getElementById('total').textContent = data.prices.total + '€'
    const ingredientInputs = document.getElementsByClassName(`ingredient-${form.id}`)

    for (let i = 0; i < data.ingredients.length; i++) {
        ingredientInputs[i].value = data.ingredients[i];
    }
}