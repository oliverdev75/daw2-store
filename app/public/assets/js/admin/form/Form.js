
class Form {

    form;
    id;
    classList;
    submit;

    constructor(id = '', classList = [], submit = {}) {
        this.id = id
        this.classList = classList
        this.submit = submit
        this.form = document.createElement('form')
    }

    setMeta() {
        if (this.id) {
            this.form.id = this.id
        }

        this.form.classList.add('flex', 'flex-col', 'gap-y-5')
        if (this.classList.length) {
            this.form.classList.add(...this.classList)
        }
    }

    build() {
        this.setMeta()

        if (this.submit.length) {
            this.form.innerHTML += `<button class="${this.submit.classList.join(' ')}" type="submit">${this.submit.title}</button>`
        }

        return this.form
    }

    appendInput(input) {
        this.form.append(input)
    }

    appendInputs(...inputs) {
        this.form.append(...inputs)
    }
}

export default Form