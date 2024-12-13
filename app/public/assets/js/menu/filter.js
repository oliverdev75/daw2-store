const filterApplyBtn = document.getElementById('filter-apply-btn')
const checkboxFilterInputs = document.querySelectorAll('.menu-filter .checkbox input')

const checkInputsStatus = () => {
    checkboxFilterInputs.forEach(input => {
        console.log(input.checked)
        if (input.checked) {
            return true
        }
    })

    return false
}


checkboxFilterInputs.forEach(input => {
    input.addEventListener('change', () => {
        if (checkInputsStatus()) {
            console.log
            if (filterApplyBtn.classList.contains('hidden')) {
                filterApplyBtn.classList.remove('hidden')
            }
        } else {
            if (!filterApplyBtn.classList.contains('hidden')) {
                filterApplyBtn.classList.add('hidden')
            }
        }
    })
})