# API

Foram criados quatro endpoints para alcançar o objetivo desse projeto, são eles:

## Criar Categoria

`POST /categorias/`

Contendo o seguinte corpo:

```
{
  "name": "Nome da Categoria",
  "attributeList": [
    {"name": "Nome do Atributo 1"},
    {"name": "Nome do Atributo 2"},
    {"name": "Nome do Atributo 3"}
  ]
}
```

## Obter Categorias

`GET /categorias/`

Com um retorno semelhante a esse:

```
{
  "list": [
    {
      "id": "categ610c4757b26c4",
      "name": "Nome da Categoria 1",
      "attributeList": [
        {
          "id": "ctg-attr-610c4771cf246",
          "name": "Nome do Atributo 1"
        },
        {
          "id": "ctg-attr-610c4771cf254",
          "name": "Nome do Atributo 2"
        },
        {
          "id": "ctg-attr-610c4771cf256",
          "name": "Nome do Atributo 3"
        }
      ]
    }
  ]
}
```

## Criar Itens

`POST categorias/:id/itens/`

Contendo o seguinte corpo:

```
{
  "name": "Nome do Item",
  "attributeList": [
    {
      "categoryAttributeId": "ctg-attr-610c4771cf246",
      "value": "Valor do Atributo"
    },
    {
      "categoryAttributeId": "ctg-attr-610c4771cf254",
      "value": "Valor do Atributo"
    },
    {
      "categoryAttributeId": "ctg-attr-610c4771cf256",
      "value": "Valor do Atributo"
    }
  ]
}
```

## Obter Itens

`GET categorias/:id/itens/`

Lembrar de modificar por um ID existente de categoria.
Com um retorno semelhante a esse:

```
{
  "list": [
    {
      "id": "ig-610c47692ebb0",
      "name": "Nome do Item 1",
      "categoryId": "categ610c4757b26c4",
      "attributeList": [
        {
          "categoryAttributeId": "ctg-attr-610c4771cf246",
          "value": "Valor do Atributo 1"
        },
        {
          "categoryAttributeId": "ctg-attr-610c4771cf254",
          "value": "Valor do Atributo 2"
        },
        {
          "categoryAttributeId": "ctg-attr-610c4771cf256",
          "value": "Valor do Atributo 3"
        }
      ]
    }
  ]
}
```