
class Modal {

    modal;
    id;
    title;
    body;
    submitButton;
    submitButtonHTML;
    closeBtn;

    constructor(id, title = '', body = '', submitButton = '', cancelBtn = false, closeBtn = false) {
        this.id = id
        this.title = title
        this.body = body
        this.submitButton = submitButton
        this.cancelBtn = cancelBtn
        this.closeBtn = closeBtn
        this.modal = this.createElement('div', ['modal-overlay'], '', `modal-${this.id}`)
        this.build()
    }

    getBuilt() {
        const openButton = this.createElement('button')
        openButton.classList.add('modal-open-btn')
        openButton.setAttribute('data-modal', `modal-${this.id}`)

        return {
            modal: this.modal,
            button: openButton
        }
    }

    build() {
        const modalElements = []
        let header = null
        if (this.title) {
            const title = this.createElement('h2', ['text-3xl'], this.title)
            header = this.createElement('header', ['modal-header', 'flex', 'justify-between'], title)
            if (this.closeBtn) {
                const icon = this.createElement('i', ['bi', 'bi-x-lg'])
                const btn = this.createElement('button', ['btn', 'text-neutral-500', 'modal-close-btn'], icon)
                header.append(btn)
            }
            modalElements.push(header)
        }
        
        const body = this.createElement('div', ['modal-body', 'flex', 'flex-col', 'gap-y-5'])
        body.innerHTML = this.body

        const footer = this.createElement('footer', ['modal-footer'])
        if (this.cancelBtn) {
            footer.append(
                this.createElement(
                    'button',
                    ['btn', 'btn-tertiary', 'modal-close-btn'],
                    'Cancel'
                )
            )
        }

        if (this.submitButton) {
            this.submitButtonHTML = `<button class="btn btn-secondary modal-submit-btn">${this.submitButton}</button>`
            footer.innerHTML += this.submitButtonHTML
        }
    
        modalElements.push(body, footer)
        const modalContent = this.createElement('div', ['modal-content'])
        modalContent.append(...modalElements)
        this.modal.append(modalContent)
    }

    createElement(element, classList = '', content = '', id = '') {
        const node = document.createElement(element)

        if (typeof content == 'string') {
            node.innerHTML = content
        } else {
            node.append(content)
        }

        if (classList.length > 0) {
            node.classList.add(...classList)
        }

        if (id) {
            node.id = id
        }

        return node
    }

    setBody(content) {
        this.modal.querySelector('.modal-body').innerHTML = content
    }

    setBodyElement(content) {
        this.modal.querySelector('.modal-body').append(content)
    }

    appendBody(content) {
        this.modal.querySelector('.modal-body').append(content)
    }

    setTitle(title) {
        this.modal.querySelector('.modal-header h2').textContent = title
    }

    setSubmitButton(button) {
        this.submitButtonHTML = button
        this.modal.querySelector('.modal-footer').innerHTML += button
    }

    setSubmitCallback(callback) {
        this.modal.querySelector('.modal-footer .modal-submit-btn').addEventListener('click', () => {
            callback()
            this.modal.style.display = 'none'
        })
    }

    enableCancelButton() {
        this.modal.querySelector('.modal-footer').innerHTML = '<button class="btn btn-tertiary modal-close-btn">Cancel</button>'
        this.modal.querySelector('.modal-footer').innerHTML += this.submitButtonHTML
    }

    enableCloseButton() {
        this.modal.querySelector('.modal-header')
            .append('<button class="btn text-neutral-500 modal-close-btn"><i class="bi bi-x-lg"></i></button>')
    }
}

export default Modal