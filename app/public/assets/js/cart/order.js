
const host = 'http://127.0.0.1:3000'
const endpoint = `${host}/cart/order`
const ordersPage = `${host}/orders`

const quantityInputs = document.querySelectorAll('.input-text-quant')
const orderForm = document.querySelector('#order-form')
const orderErrorMessage = document.querySelector('#order-error')

orderForm.addEventListener('submit', event => {
    event.preventDefault()
    const quantities = new FormData(event.target)
    quantityInputs.forEach(input => {
        quantities.append(input.name, input.value)
    })

    fetch(endpoint, {
        method: 'POST',
        body: quantities.getAll()
    })
    .then(res => res.json())
    .then(res => {
        if (res.status == 'ok') {
            location.href = ordersPage
        } else {
            orderErrorMessage.textContent = res.message
            if (!orderErrorMessage.classList.contains('hidden')) {
                orderErrorMessage.classList.remove('hidden')
            }
        }
    })
    .catch(error => {
        console.log(error)
        orderErrorMessage.textContent = "There was an error with the order."
        if (!orderErrorMessage.classList.contains('hidden')) {
            orderErrorMessage.classList.remove('hidden')
        }
    })
})