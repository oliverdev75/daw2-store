
class Input {

    type;
    id;
    name;
    label;
    classList;
    value;
    placeholder;

    constructor(type, id, name, label, classList = [], value = '', placeholder = '') {
        this.type = type
        this.id = id
        this.name = name
        this.label = label
        this.classList = classList
        this.value = value
        this.placeholder = placeholder
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
        input.value = this.value

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
}

export default Input