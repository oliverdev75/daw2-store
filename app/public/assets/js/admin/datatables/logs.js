import DataTable from "./DataTable.js"
import Api from "../Api.js"

const logModel = {
    columnsDataCallback: values => {
        const date = new Date(values.create_time)
        const dateString = `${date.toDateString()} at ${date.getHours()}:${date.getMinutes()}`
        return [
            `<td class="px-4 py-3">${values.user.name}${values.user.surnames ? ' '+values.user.surnames : ''}</td>`,
            `<td class="px-4 py-3">${values.action}</td>`,
            `<td class="px-4 py-3">${values.order_id ?? '-'}</td>`,
            `<td class="px-4 py-3">${values.product_id ?? '-'}</td>`,
            `<td class="px-4 py-3">${values.ingredient_id ?? '-'}</td>`,
            `<td class="px-4 py-3">${dateString}</td>`,
        ].join('')
    },
    actionButtons: false
}

const table = new DataTable(logModel)
table.fill(await Api.getLogs())