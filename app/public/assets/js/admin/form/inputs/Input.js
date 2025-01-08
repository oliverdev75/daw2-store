
class Input {

    id;
    name;
    label;
    classList;
    value;
    placeholder;

    constructor(id, name, label = '', classList = [], value = '', placeholder = '') {
        this.id = id
        this.name = name
        this.label = label
        this.classList = classList
        this.value = value
        this.placeholder = placeholder
    }
}

export default Input