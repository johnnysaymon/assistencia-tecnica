document.addEventListener('DOMContentLoaded', categoryListingLoad)

function categoryListingLoad()
{
    const context = document
    const templateItem = context.querySelector('#category-listing-item-template')
    const container = context.querySelector('.category-listing tbody')

    getData()

    function getData()
    {
        const data = {
            'method': 'GET',
            'headers': {
                'Content-Type': 'application/json'
            }
        }

        fetch('/categorias/', data)
            .then(response => response.json())
            .then(update)
            .catch((error) => alert(error))
    }

    function update(data)
    {
        clear()
        data.list.forEach(addItem);
    }

    function clear()
    {
        container.innerHTML = ''
    }

    function addItem(item)
    {
        const lines = templateItem.content.querySelectorAll('td')
        lines[0].textContent = item.id
        lines[1].textContent = item.name
        lines[2].textContent = item.attributeList.map(attribute => attribute.name).join(', ')

        const lineClone = document.importNode(templateItem.content, true)

        container.appendChild(lineClone)
    }
}
