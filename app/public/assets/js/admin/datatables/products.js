import DataTable from "./DataTable.js"
import Api from "../Api.js"
import Form from "../form/Form.js"
import TextInput from "../form/inputs/TextInput.js"
import ImageInput from "../form/inputs/ImageInput.js"
import IngredientInput from "../form/inputs/IngredientInput.js"
import { showMessage } from "../utils.js"

const productModel = {
    columnsDataCallback: values => {
        return [
            `<td class="px-4 py-3"><img class="w-20" src="${values.imagePath}"></td>`,
            `<td class="px-4 py-3">${values.name}</td>`,
            `<td class="px-4 py-3">${values.ingredientsQuantity}</td>`,
            `<td class="px-4 py-3">${values.create_time}</td>`,
        ].join('')
    },
    actionButtons: true,
    editModalTitle: 'Edit product',
    deleteModalText: 'Sure you want to delete this product?',
    editFormCompositionCallback: product => {
        const form = new Form(`edit-${product.id}`)
        const name = new TextInput('text', 'name', 'Name:', [], product.name)
        const image = new ImageInput(`product-image-${product.id}`, 'image', 'Select', [], product.imagePath)
        const ingredientsList = product.ingredients.map(
            ingredient => {
                const input = new IngredientInput(ingredient.name, ingredient.imagePath, ingredient.quantity)
                return input.build()
            }
        ).join('')

        const formBody = `
            <div class="flex gap-x-5">
                <div class="flex flex-col gap-y-5">
                    ${name.build().outerHTML}
                    ${image.build()}
                </div>
                <div class="ingredients-container flex flex-col gap-y-5">
                    <h3>Ingredients</h3>
                    <div class="ingredients-list flex flex-col gap-y-4">
                        ${ingredientsList}
                    </div>
                    <button type="button" class="ingredient-add-btn btn btn-secondary text-center">
                        <i class="bi bi-plus-lg text-white"></i>
                    </button>
                </div>
            </div>
        `
        form.appendInputHTML(formBody)

        return form.build()
    },
    editSubmitCallback: async (id, data) => {
        const res = await Api.updateProduct(id, {})

        if (res.status == 'ok') {
            showMessage('Product updated successfuly!', 'success')
        }

        return {
            status: res.status == 'ok',
            data: data
        }
    },
    deleteSubmitCallback: async (id) => {
        const res = await Api.destroyProduct(id)
        
        if (res.status == 'ok') {
            showMessage(res.message, 'success')
        }

        return {
            status: res.status == 'ok'
        }
    },
}

const ingredients = await Api.getIngredients()
if (ingredients.statius = 'ok') {
    sessionStorage.setItem('ingredients', JSON.stringify(ingredients.data))
}

const table = new DataTable(productModel)
table.fill(await Api.getProducts())