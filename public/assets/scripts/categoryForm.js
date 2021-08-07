document.addEventListener('DOMContentLoaded', categoryFormLoad)

function categoryFormLoad()
{
    const context = document

    const templateAttributeItem = context.querySelector('#category-form__attribute-item')

    const form = context.querySelector('.category-form')
    const attributeContainer = form.querySelector('.category-form__attribute-item-list')
    const buttonAttributeAdd = form.querySelector('.category-form__attribute-button-add')
    const buttonSubmit = form.querySelector('.category-form__button-submit')
    const inputName = form.querySelector('.category-form__input-name')

    buttonAttributeAdd.addEventListener('click', addAttributeItem)
    buttonSubmit.addEventListener('click', save)
    form.addEventListener('submit', save)

    function addAttributeItem()
    {
        const item = document.importNode(templateAttributeItem.content, true)
        item.querySelector('.category-form__attribute-button-remove')
            .addEventListener('click', removeAttributeItem)

        attributeContainer.appendChild(item)
    }

    function removeAttributeItem()
    {
        this.parentNode.remove()
    }

    function save(e)
    {
        e.preventDefault()
        
        const body = {
            'name': inputName.value,
            'attributeList': getAttributeData()
        }

        const data = {
            'method': 'POST',
            'headers': {
                'Content-Type': 'application/json'
            },
            'body': JSON.stringify(body)
        }

        fetch('/categorias/', data)
            .then(clear)
            .catch((error) => alert(error))
    }

    function getAttributeData()
    {
        const inputNameList = Array.from(form.querySelectorAll('.category-form__attribute-input-name'))
        return inputNameList.map((inputName) => { return {"name": inputName.value} })
    }

    function clear()
    {
        inputName.value = ''
        attributeContainer.innerHTML = ''
    }
}
