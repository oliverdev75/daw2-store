import DataTable from "./DataTable.js"
import Api from "../Api.js"

const orderModel = {
    columnsDataCallback: values => {
        const date = new Date(values.create_time)
        const dateString = `${date.toDateString()} at ${date.getHours()}:${date.getMinutes()}`
        return [
            `<td class="px-4 py-3">${dateString}</td>`,
            `<td class="px-4 py-3">${values.user.name}${values.user.surnames ? ' '+values.user.surnames : ''}</td>`,
        ].join('')
    },
    actionButtons: false
}

const table = new DataTable(orderModel)
table.fill(await Api.getOrders())