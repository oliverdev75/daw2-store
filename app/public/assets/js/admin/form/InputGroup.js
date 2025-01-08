

class InputGroup {

    built;

    constructor(elements, column = false, space = 'gap-x-5') {
        this.built = document.createElement('div')
        this.built.classList.add('flex', column ? 'flex-col' : 'flex-row', space)
        this.built.append(...elements)
    }

    build() {
        return this.built
    }
}

export default InputGroup