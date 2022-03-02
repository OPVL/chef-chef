## ChefChef

### What is it?

A simple tool to help you meal plan. You can add recipes, set their cuisine, pick ingredients, set units of ingredients.

This is then used to build you a shopping list from meals you've added to your plan.

### Model Definitions

#### Recipe
```php
Recipe
 - properties
  - name
  - description
  
 - relations: 
  - Ingredient (through IngredientRecipe)
  - Cuisine
  - ShoppingList (WIP)

Ingredient
 - properties
  - name
  - display (dynamic)
 
 - relations
  - Unit
  - Type
  - Recipe (through IngredientRecipe)


```
