import Input from "./Input.js"

class IngredientInput extends Input {

    image;
    quantity;

    constructor(value, image, quantity, ingredients = []) {
        super('', '', '', [], value)
        this.image = image
        this.quantity = quantity
    }

    buildOptions() {
        const nonSetted = JSON.parse(sessionStorage.getItem('ingredients')).filter(ingredient => {
            return ingredient.name != this.value
        })

        return nonSetted.map(ingredient => {
            return `<option value="${ingredient.name}">${ingredient.name}</option>`
        }, this.ingredients).join('')
    }

    build() {
        return (`
            <div class="input-ingredient px-5 py-4 flex items-center gap-x-4 border border-b border-solid border-[]">
                <img class="ingredient-image w-10 object-fit" src="${this.image}" alt="">
                <select class="px-3 py-2 rounded" name="ingredients[]" id="">
                    <option value="${this.value}" selected>${this.value}</option>
                    ${this.buildOptions()}
                </select>
                <input class="ingredient-quantity input-text-quant w-10 h-7 font-bold" type="text" value="${this.quantity}">
                <button type="button" class="ingredient-delete px-2 py-1 bg-red-500 hover:bg-red-600 rounded">
                    <i class="bi bi-trash text-white"></i>
                </button>
            </div>
        `)
    }

    static handle() {
        const ingredientsContainer = document.getElementsByClassName('ingredients-container')
        for (const container of ingredientsContainer) {
            const list = container.querySelector('.ingredients-list')

            const addButton = container.querySelector('.ingredient-add-btn')
            addButton.addEventListener('click', () => {
                list.innerHTML += (new IngredientInput('Select and ingredient...', '', 1)).build()
            })
            
            for (const ingredientInput of list.getElementsByClassName('input-ingredient')) {
                const input = ingredientInput.querySelector('select')
                const image = ingredientInput.querySelector('.ingredient-image')
                input.addEventListener('change', event => {
                    for (const ingredient of JSON.parse(sessionStorage.getItem('ingredients'))) {
                        if (ingredient.name == event.target.value) {
                            image.src = ingredient.imagePath
                            break
                        }
                    }
                })

                const deleteButton = ingredientInput.querySelector('.ingredient-delete')
                deleteButton.addEventListener('click', () => {
                    ingredientInput.remove()
                })
            }
        }        
    }
}

export default IngredientInput