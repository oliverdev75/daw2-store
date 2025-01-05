
export const showMessage = (message, type) => {
    const placeholder = document.getElementById('message-placeholder')

    if (placeholder.classList.length > 1) {
        placeholder.classList.remove('message-info')
        placeholder.classList.remove('message-success')
        placeholder.classList.remove('message-success')
        placeholder.classList.remove('message-danger')
    }

    placeholder.classList.add(`message-${type}`)
    placeholder.textContent = message
}