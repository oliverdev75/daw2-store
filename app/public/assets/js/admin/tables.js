import Modal from "./modals/Modal"

const API_PREFIX = '/api'
const table = document.getElementsByClassName('data-table')

function updateTable(entity, columns) {
    fetch(`${API_PREFIX}/${entity}`)
    .then(res => res.json())
    .then(res => {
        if (res.status == 'ok') {
            const models = res.data
            let entityRow = null
            let column = null
            let image = null

            for (const entityData of models) {
                entityRow = document.createElement('tr')
                columns.forEach(columnName => {
                    column = document.createElement('td')
                    if (columnName == 'imagePath') {
                        image = document.createElement('img')
                        image.src = entityData[columnName]
                    } else {
                        column.textContent = entityData[columnName] ?? '-'
                    }

                    entityRow.append(column)
                })
                actionsColumn = document.createElement('td')
                actionsColumn.append(createEditModal(entity, entityData['id']))

                table.append(entityRow)
            }
        }
    })
}

function createEditModal(entity, id) {
    let title = 'Edit '
    switch (entity) {
        case 'users':
            title += 'user'
            break
        case 'products':
            title += 'product'
            break
        case 'ingredients':
            title += 'ingredient'
            break
    }

    const editBtn = document.createElement('button')
    editBtn.classList.add('btn', 'btn-secondary')
    editBtn.textContent = 'Edit'

    const modal = new Modal(document, id, title, '', editBtn, true, true)
    modal.setBody(createEditForm(entity, id))
}

function createEditForm(entity, id) {
    const form = document.createElement('form')
    form.id = id
    content = [
        '<div class="flex gap-x-5">',
        '    <input class="input-text" type="text" value="John">',
        '    <input class="input-text" type="text" value="Doe">',
        '</div>',
        '<div class="flex gap-x-5">',
        '   <input class="input-text" type="password" name="" id="" value="xxxxxxx">',
        '   <input class="input-text" type="password" name="" id="" value="xxxxxxx">',
        '</div>'
    ].join('')

    form.innerHTML = content  
}

switch (table.id) {
    case 'users':
        updateTable('users', [
            'id',
            'name',
            'surnames',
            'email',
            'role'
        ])
        break
    case 'products':
        updateTable('products', [
            'id',
            'name',
            'category',
            'imagePath'
        ])
        break
}