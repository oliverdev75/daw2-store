import { updateTable } from "./tables.js"
import Api from "../Api.js"
import Form from "../form/Form.js"
import Input from "../form/Input.js"
import InputGroup from "../form/InputGroup.js"
import { showMessage } from "../utils.js"

console.log(await Api.getUsers())

updateTable({
    data: await Api.getUsers(),
    editModalTitle: 'Edit user',
    columns: ['Name', 'Surnames', 'Email', 'Role', 'Creation time'],
    dataCallback: values => {
        return [
            `<td class="px-4 py-3">${values.name}</td>`,
            `<td class="px-4 py-3">${values.surnames}</td>`,
            `<td class="px-4 py-3">${values.email}</td>`,
            `<td class="px-4 py-3">${values.role}</td>`,
            `<td class="px-4 py-3">${values.create_time}</td>`,
        ].join('')
    },
    actionButtons: true,
    editFormElementsCallback: user => {
        const form = new Form(`edit-${user.id}`)

        const name = new Input('text', 'name', 'name', 'Name:', [], user.name)
        const surnames = new Input('text', 'surnames', 'Surnames', 'Name:', [], user.surnames)
        const email = new Input('text', 'email', 'email', 'Email:', [], user.email)
        const role = new Input('text', 'role', 'role', 'Role:', [], user.role)

        const namesGroup = new InputGroup([name.build(), surnames.build()])
        const emailRoleGroup = new InputGroup([email.build(), role.build()])

        form.appendInputs(namesGroup.build(), emailRoleGroup.build())

        return form.build()
    },
    editSubmitCallback: (id, data) => {
        const res = Api.updateUser(id, data)
        console.log(res.message)
        if (res.status == 'ok') {
            showMessage(res.message, 'success')
        }
    },
    deleteSubmitCallback: id => {
        const res = Api.destroyUser(id)
        console.log(res.message)
        
        if (res.status == 'ok') {
            showMessage(res.message, 'success')
        }
    },
})