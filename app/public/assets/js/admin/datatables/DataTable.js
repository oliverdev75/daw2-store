import { launch } from "../modals/handler.js"
import Modal from "../modals/Modal.js"
import { removeMessage } from "../utils.js"
import ImageInput from "../form/inputs/ImageInput.js"
import IngredientInput from "../form/inputs/IngredientInput.js"


class DataTable {
    
    columnsDataCallback;
    actionButtons;
    editModalTitle;
    deleteModalText;
    editFormCompositionCallback;
    editSubmitCallback;
    deleteSubmitCallback;

    constructor ({
        columnsDataCallback,
        actionButtons,
        editModalTitle = null,
        deleteModalText = null,
        editFormCompositionCallback = null,
        editSubmitCallback = null,
        deleteSubmitCallback = null
    }) {
        this.columnsDataCallback = columnsDataCallback
        this.actionButtons = actionButtons
        this.editModalTitle = editModalTitle
        this.deleteModalText = deleteModalText
        this.editFormCompositionCallback = editFormCompositionCallback
        this.editSubmitCallback = editSubmitCallback
        this.deleteSubmitCallback = deleteSubmitCallback
    }

    fill(data) {
        const table = document.getElementById('data-table')
        let entityRow = null
        let actionsColumn = null
        const tableData = data.data
        const tableBody = table.querySelector('tbody')
        tableBody.innerHTML = ''
        
        for (const model of tableData) {
            entityRow = document.createElement('tr')
            entityRow.innerHTML = this.columnsDataCallback(model)
    
            if (this.actionButtons) {
                actionsColumn = document.createElement('td')
                actionsColumn.classList.add('px-4', 'py-3', 'flex', 'items-center', 'gap-x-2')
    
                const editModal = this.createEditModal(entityRow, model)
                editModal[1].innerHTML = '<i class="bi bi-pencil-square text-white"></i>'
                editModal[1].classList.add('px-2', 'py-1', 'bg-blue-500', 'hover:bg-blue-600', 'rounded')
                const destroyModal = this.createDestroyModal(entityRow, model.id)
                destroyModal[1].innerHTML = '<i class="bi bi-trash text-white"></i>'
                destroyModal[1].classList.add('px-2', 'py-1', 'bg-red-500', 'hover:bg-red-600', 'rounded')
      
                actionsColumn.append(...editModal)
                actionsColumn.append(...destroyModal)
                entityRow.append(actionsColumn)
            }
            
            tableBody.append(entityRow)
        }
    
        table.append(tableBody)
        launch()
        ImageInput.handle()
        IngredientInput.handle()
    }

    createEditModal(row, model) {
        const modal = new Modal(`edit-${model.id}`, this.editModalTitle, '', 'Edit', true, true)
        modal.setBodyElement(this.editFormCompositionCallback(model))
        modal.setSubmitCallback(async () => {
            removeMessage()
            const form = document.getElementById(`edit-${model.id}`)
            const res = await this.editSubmitCallback(model.id, form.elements)
            console.log(res.data)
            if (res.status) {
                this.updateEntity(row, model.id, res.data)
            }
        })
        const modalObjects = modal.getBuilt()
    
        return [modalObjects.modal, modalObjects.button]
    }

    updateEntity(row, modelId, data) {
        const columns = row.querySelectorAll('td')
        for (let i = 0; i < data.length; i++) {
            columns[i].textContent = data[i].value
        }
    
        const editInputs = row.querySelectorAll(`edit-${modelId}`)
        for (let i = 0; i < data.length; i++) {
            editInputs.elements[i] = data[i].value
        }
    }

    createDestroyModal(row, modelId) {
        const modal = new Modal(`destroy-${modelId}`)
        modal.setBody(`<p class="font-semibold text-lg">${this.deleteModalText}</p>`)
        modal.setSubmitButton('<button class="btn btn-danger modal-submit-btn">Delete</button>')
        modal.setSubmitCallback(async () => {
            removeMessage()
            if ((await this.deleteSubmitCallback(modelId)).status) {
                row.remove()
            }
        })

        modal.enableCancelButton()
        const modalObjects = modal.getBuilt()
    
        return [modalObjects.modal, modalObjects.button]
    }
}

export default DataTable