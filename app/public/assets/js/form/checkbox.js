
document.querySelectorAll('.checkbox').forEach(checkbox => {
    checkbox.childNodes[1].addEventListener('click', () => {
        checkbox.childNodes[1].childNodes[1].classList.toggle('checkbox-content-color')
        checkbox.childNodes[3].click()
    })
})