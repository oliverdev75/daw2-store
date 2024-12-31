
for (const modal of document.getElementsByClassName('modal-overlay')) {
    const openButton = document.getElementById(modal.getAttribute('data-open-btn'))
    const closeButtons = modal.getElementsByClassName('modal-close-btn')
    openButton.addEventListener('click', () => {
        console.log('Pressed')
        modal.style.display = 'grid'
    })
    for (const button of closeButtons) {
        button.addEventListener('click', () => {
            modal.style.display = 'none'
        })
    }
}
