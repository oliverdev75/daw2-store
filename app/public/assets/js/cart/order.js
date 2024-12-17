
const host = 'http://127.0.0.1:3000'
const endpoint = `${host}/cart/order`
const ordersPage = `${host}/orders`
const loginPage = `${host}/login`

const quantityInputs = document.querySelectorAll('.input-text-quant')
const orderForm = document.querySelector('#order-form')
const orderErrorMessage = document.querySelector('#order-error')

orderForm.addEventListener('submit', event => {
    event.preventDefault()
    const quantitiesForm = new FormData(event.target)
    quantityInputs.forEach(input => {
        quantitiesForm.append(input.name, input.value)
    })

    const quantities = {};
    quantitiesForm.entries().forEach(inputValue => {
        quantities[inputValue[0]] = inputValue[1]
    })

    fetch(endpoint, {
        method: 'POST',
        body: JSON.stringify(quantities)
    })
    .then(res => res.json())
    .then(res => {
        if (res.status == 'ok') {
            location.href = ordersPage
        } else {
            if (res.message == 'No session') {
                location.href = loginPage
            }
            orderErrorMessage.textContent = res.message
            orderErrorMessage.style.display = 'block'
        }
    })
    .catch(error => {
        console.log(error)
        orderErrorMessage.textContent = "There was an error with the order."
        orderErrorMessage.style.display = 'block'
    })
})