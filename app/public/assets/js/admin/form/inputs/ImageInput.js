import Input from "./Input.js"

class ImageInput extends Input {

    constructor(id, name, label, value) {
        super(id, name, label, [], value, '')
    }

    build() {
        return (`
            <div class="flex flex-col">
                 <label class="mb-px font-semibold text-sm text-neutral-500" for="name">Image:</label>
                 <div class="image-input">
                    <input id="${this.id}" type="file" name="${this.name}">
                    <label class="btn btn-secondary w-fit" for="${this.id}" role="button">
                        ${this.label}
                    </label>
                    <label for="${this.id}" role="button">
                        <div class="image-placeholder bg-neutral-300 w-52 h-36 grid place-content-center">
                            <i class="bi bi-image text-4xl z-10"></i>
                            <img class="w-full h-full object-contain" src="${this.value}" alt="">
                        </div>
                    </label>
                 </div>
             </div>
         `)
    }

    static handle() {
        const imageContainers = document.getElementsByClassName('image-input')
        for (const container of imageContainers) {
            const placeholder = container.querySelector('.image-placeholder')
            container.querySelector('input').addEventListener('change', event => {
                const reader = new FileReader
                reader.onload = readerEvent => {
                    placeholder.style.backgroundColor = '#fff'
                    placeholder.querySelector('i').remove()
                    placeholder.querySelector('img').src = readerEvent.target.result
                }
                console.log(event.target.files[0])
                reader.readAsDataURL(event.target.files[0])
            })
        }
    }
}

export default ImageInput