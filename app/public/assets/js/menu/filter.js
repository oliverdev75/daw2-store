const filterApplyBtn = document.getElementById('filter-apply-btn')
const checkboxFilterInputs = document.querySelectorAll('.menu-filter .input input')

const checkInputsStatus = () => {
    checkboxFilterInputs.forEach(input => {
        console.log(input.checked)
        if (input.checked) {
            console.log(input.checked)
            return true
        }
    })

    return false
}


checkboxFilterInputs.forEach(input => {
    input.addEventListener('change', () => {
        //console.log(`Checkeds: ${checkInputsStatus()}`)
        if (checkInputsStatus()) {
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