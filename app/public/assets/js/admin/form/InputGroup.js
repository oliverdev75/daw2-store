

class InputGroup {

    built;

    constructor(elements, space = 'gap-x-5') {
        this.built = document.createElement('div')
        this.built.classList.add('flex', space)
        this.built.append(...elements)
    }

    build() {
        return this.built
    }
}

export default InputGroup