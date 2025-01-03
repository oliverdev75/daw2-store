
export default class Modal {

    modal;
    document;
    id;
    title;
    body;
    footer;
    closeBtn;

    constructor(document, id, title = '', body = '', footer = '', cancelBtn = false, closeBtn = false) {
        this.document = document
        this.id = id
        this.title = title
        this.body = body
        this.footer = footer
        this.cancelBtn = cancelBtn
        this.closeBtn = closeBtn
        this.build()
    }

    build() {
        const title = this.createElement('h2', ['text-3xl'], this.title)
        const header = this.createElement('header', ['modal-header', 'flex', 'justify-between'], title)
        if (this.closeBtn) {
            const icon = this.createElement('i', ['bi', 'bi-x-lg'])
            const btn = this.createElement('button', ['btn', 'text-neutral-500', 'modal-close-btn'], icon)
            header.append(btn)
        }
        
        const body = this.createElement('div', ['modal-body', 'flex', 'flex-col', 'gap-y-5'], this.body)
        const footer = this.createElement('footer', ['modal-footer'])
        if (this.cancelBtn) {
            footer.append(
                this.createElement(
                    'button',
                    ['btn', 'btn-tertiary', 'modal-close-btn']
                )
            )
        }
        footer.append(this.footer)
        
        const modalContent = this.createElement('div', ['modal-content'], [header, body, footer])
        this.modal = this.createElement('div', ['modal-overlay'], modalContent, `modal-${id}`)
    }

    createElement(element, classList = [], content = [], id = '') {
        const node = this.document.createElement(element)

        if (Array.isArray(content)) {
            node.append(...content)
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
        this.modal.querySelector('.modal-body').innerHTML = typeof content == 'object' ? content.innerHTML : content
    }

    appendBody(content) {
        this.modal.querySelector('.modal-body').append(content)
    }

    setTitle(title) {
        this.modal.querySelector('.modal-header h2').textContent = title
    }

    setFooter(footer) {
        this.modal.querySelector('.modal-footer').append(footer)
    }
}