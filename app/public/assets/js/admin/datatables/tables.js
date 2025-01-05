import Modal from "../modals/Modal.js"

export function updateTable({ 
    data,
    editModalTitle,
    columns,
    dataCallback,
    actionButtons,
    editFormElementsCallback,
    editSubmitCallback,
    deleteSubmitCallback
}) {
    const table = document.getElementById('data-table')
    let entityRow = null
    let actionsColumn = null
    const tableData = data.data
    table.append(setHeader(columns))

    const tableBody = document.createElement('tbody')
    for (let i = 0; i < tableData.length; i++) {
        entityRow = document.createElement('tr')
        entityRow.innerHTML = dataCallback(tableData[i])

        if (actionButtons) {
            actionsColumn = document.createElement('td')
            actionsColumn.classList.add('px-4', 'py-3', 'flex', 'items-center', 'gap-x-2')

            const editModal = createEditModal(editModalTitle, tableData[i], editFormElementsCallback, editSubmitCallback)
            editModal[1].innerHTML = '<i class="bi bi-pencil-square text-white"></i>'
            editModal[1].classList.add('px-2', 'py-1', 'bg-blue-500', 'hover:bg-blue-600', 'rounded')
            const destroyModal = createDestroyModal(tableData[i].id, deleteSubmitCallback)
            destroyModal[1].innerHTML = '<i class="bi bi-trash text-white"></i>'
            destroyModal[1].classList.add('px-2', 'py-1', 'bg-red-500', 'hover:bg-red-600', 'rounded')
  
            actionsColumn.append(...editModal)
            actionsColumn.append(...destroyModal)
            entityRow.append(actionsColumn)
        }
        
        tableBody.append(entityRow)
    }

    table.append(tableBody)
}

function setHeader(columns) {
    const header = document.createElement('thead')
    const row = document.createElement('tr')
    row.classList.add('border-b', 'border-solid', 'border-neutral-200')

    for (const column of columns) {
        row.innerHTML += `<th class="px-4 py-3 text-start">${column}</th>`
    }
    header.append(row)
    
    return header
}


function createEditModal(title, entityData, formCallback, submitCallback) {
    const modal = new Modal(`edit-${entityData.id}`, title, '', 'Edit', true, true)
    modal.setBodyElement(formCallback(entityData))
    modal.setSubmitCallback(() => {
        const form = document.getElementById(`edit-${entityData.id}`)
        const formData = new FormData(form)
        const data = {}

        for (const value of formData.entries()) {
            data[value[0]] = value[1]
        }

        submitCallback(entityData.id, data)
    })
    const modalObjects = modal.getBuilt()

    return [modalObjects.modal, modalObjects.button]
}

function createDestroyModal(modelId, callback) {
    const modal = new Modal(`destroy-${modelId}`)
    modal.setBody('<p class="font-semibold text-lg">Sure you want to delete this user?</p>')
    modal.setSubmitButton('<button class="btn btn-danger modal-submit-btn">Delete</button>')
    modal.setSubmitCallback(() => {
        callback(modelId)
    })
    modal.enableCancelButton()

    const modalObjects = modal.getBuilt()

    return [modalObjects.modal, modalObjects.button]
}

// if (columnName == 'imagePath') {
//     image = document.createElement('img')
//     image.src = entityData[columnName]
// } else {
//     column.textContent = entityData[columnName] ?? '-'
// }