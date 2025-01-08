import Input from "./Input.js"

class TextInput extends Input {

    constructor(id, name, label = '', classList = [], value = '', placeholder = '') {
        super(
            id,
            name,
            label,
            classList,
            value,
            placeholder
        )
    }

    build() {
        const built = document.createElement('div')
        built.classList.add('flex', 'flex-col')
        built.append(
            this.createLabel(), this.createInput()
        )

        return built
    }

    createInput() {
        const input = document.createElement('input')
        input.type = this.type
        input.classList.add('input-text')
        input.id = this.id
        input.setAttribute('value', this.value)
        console.log(this.value)

        if (this.placeholder) {
            input.placeholder = this.placeholder
        }

        return input
    }

    createLabel() {
        const label = document.createElement('label')
        label.classList.add('mb-px', 'font-semibold', 'text-sm', 'text-neutral-500')
        label.htmlFor = this.id
        label.textContent = this.label

        return label
    }

    static handleAll() {
        ImageInput.handle()
        IngredientInput.handle()
    }
}

export default TextInput