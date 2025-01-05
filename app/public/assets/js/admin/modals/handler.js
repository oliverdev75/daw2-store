
function launch() {
    const buttons = document.querySelectorAll('.modal-open-btn')
    buttons.forEach(openButton => {
        console.log('Modals loaded...')
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
    })
}

launch()