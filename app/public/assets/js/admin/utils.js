
const placeholder = document.getElementById('message-placeholder')

export const showMessage = (message, type) => {
    if (placeholder.classList.length > 1) {
        placeholder.classList.remove('message-info')
        placeholder.classList.remove('message-success')
        placeholder.classList.remove('message-success')
        placeholder.classList.remove('message-danger')
    }

    placeholder.classList.add(`message-${type}`)
    placeholder.textContent = message
    placeholder.style.display = 'block'
}

export const removeMessage = () => {
    placeholder.style.display = 'none'
}