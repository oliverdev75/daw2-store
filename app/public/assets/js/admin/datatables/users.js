import DataTable from "./DataTable.js"
import Api from "../Api.js"
import Form from "../form/Form.js"
import TextInput from "../form/inputs/TextInput.js"
import InputGroup from "../form/InputGroup.js"
import { showMessage } from "../utils.js"

const userModel = {
    columns: ['Name', 'Surnames', 'Email', 'Role', 'Creation time'],
    columnsDataCallback: values => {
        return [
            `<td class="px-4 py-3">${values.name}</td>`,
            `<td class="px-4 py-3">${values.surnames}</td>`,
            `<td class="px-4 py-3">${values.email}</td>`,
            `<td class="px-4 py-3">${values.role}</td>`,
            `<td class="px-4 py-3">${values.create_time}</td>`,
        ].join('')
    },
    actionButtons: true,
    editModalTitle: 'Edit user',
    deleteModalText: 'Sure you want to delete this user?',
    editFormCompositionCallback: user => {
        const form = new Form(`edit-${user.id}`)

        const name = new TextInput('text', 'name', 'name', 'Name:', [], user.name)
        const surnames = new TextInput('text', 'surnames', 'surnames', 'Surnames:', [], user.surnames)
        const email = new TextInput('text', 'email', 'email', 'Email:', [], user.email)
        const role = new TextInput('text', 'role', 'role', 'Role:', [], user.role)

        const namesGroup = new InputGroup([name.build(), surnames.build()])
        const emailRoleGroup = new InputGroup([email.build(), role.build()])

        form.appendInputs(namesGroup.build(), emailRoleGroup.build())

        return form.build()
    },
    editSubmitCallback: async (id, data) => {
        const res = await Api.updateUser(id, {
            'name': data.name.value,
            'surnames': data.surnames.value,
            'email': data.email.value,
            'role': data.role.value
        })

        if (res.status == 'ok') {
            showMessage('User updated successfuly!', 'success')
        }

        return {
            status: res.status == 'ok',
            data: data
        }
    },
    deleteSubmitCallback: async (id) => {
        const res = await Api.destroyUser(id)
        
        if (res.status == 'ok') {
            showMessage(res.message, 'success')
        }

        return {
            status: res.status == 'ok'
        }
    },
}

const table = new DataTable(userModel)
table.fill(await Api.getUsers())