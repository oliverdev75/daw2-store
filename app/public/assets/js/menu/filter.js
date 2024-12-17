const filterApplyBtns = document.getElementsByClassName('filter-apply-btn')
const checkboxFilterInputs = document.querySelectorAll('.menu-filter .checkbox input')
const filterForm = document.getElementById('menu-filter-form')
const sidePrinciplesCheckbox = document.querySelector('.side-menu-filter #side-principles')
const sideSnacksCheckbox = document.querySelector('.side-menu-filter #side-snacks')
const sideDrinksCheckbox = document.querySelector('.side-menu-filter #side-drinks')
const sideDessertsCheckbox = document.querySelector('.side-menu-filter #side-desserts')

const checkInputsStatus = () => {
    for (const input of checkboxFilterInputs) {
        console.log(input.checked)
        if (input.checked) {
            return true
        }
    }

    return false
}


checkboxFilterInputs.forEach(input => {
    input.addEventListener('change', () => {
        if (checkInputsStatus()) {
            for (const button of filterApplyBtns) {
                if (button.classList.contains('hidden')) {
                    button.classList.remove('hidden')
                }
            }
        } else {
            for (const button of filterApplyBtns) {
                if (!button.classList.contains('hidden')) {
                    button.classList.add('hidden')
                }
            }
        }
    })
})

// filterForm.addEventListener('submit', event => {
//     event.preventDefault()
//     console.log(event.target)
//     const data = new FormData(event.target)
//     if (sidePrinciplesCheckbox.classList.contains('hidden')) {
//         data.append('principles', document.querySelector('#principles').value)
//     }
//     if (sideSnacksCheckbox.classList.contains('hidden')) {
//         data.append('snacks', document.querySelector('#snacks').value)
//     }
//     if (sideDrinksCheckbox.classList.contains('hidden')) {
//         data.append('drinks', document.querySelector('#drinks').value)
//     }
//     if (sideDessertsCheckbox.classList.contains('hidden')) {
//         data.append('desserts', document.querySelector('#desserts').value)
//     }
//     console.log(data)
//     //location.href = (new URLSearchParams(data)).toString()
// })

console.log(filterForm)
