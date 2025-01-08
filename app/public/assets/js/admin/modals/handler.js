
export const launch = () => {
    const buttons = document.querySelectorAll('.modal-open-btn')
    const template = document.querySelector('html')
    console.log(buttons)
    buttons.forEach(openButton => {
        console.log('Modals loaded...')
        const modal = document.getElementById(openButton.getAttribute('data-modal'))
        const closeButtons = modal.getElementsByClassName('modal-close-btn')
        openButton.addEventListener('click', () => {
            console.log('Pressed')
            template.style.overflow = 'hidden'
            modal.style.display = 'grid'
        })
        for (const button of closeButtons) {
            button.addEventListener('click', () => {
                modal.style.display = 'none'
                template.style.overflow = 'auto'
            })
        }
    })
}