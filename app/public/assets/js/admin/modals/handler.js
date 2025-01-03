
for (const openButton of document.getElementsByClassName('modal-open-btn')) {
    const modal = document.getElementById(openButton.getAttribute('data-modal'))
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
