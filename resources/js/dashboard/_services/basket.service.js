import {EventBus} from "../_helpers/event.bus";
export const basketService = {
    addPanier,
    getBasket,
    quantityBasketSize,
}


function addPanier(produit, quantity) {

    let basket = getBasket()

    if (!_.hasIn(basket, buildKey(produit))) {
        basket[buildKey(produit)] = {
            id: produit.id,
            name: produit.name,
            quantity: parseInt(quantity),
            price: produit.price
        }
    } else {
            
    basket[buildKey(produit)].quantity += parseInt(quantity)
}  

// on appelle ensuite la fonction store pour l'ajouté au local storage
storeBasket(basket)
console.log(basket)

}

function buildKey(produit){
    return 'produit_' + produit.id
}



function getBasket(){  //update
    let basket = localStorage.getItem("currentBasket");

    if (!basket) {
        basket = {}
    }
    else {
        basket = JSON.parse(basket)
    }

    return basket
}


function storeBasket(basket){
    localStorage.setItem("currentBasket", JSON.stringify(basket))
    emitBasketSize(basket)
}

function emitBasketSize(basket){ 
    let basketSize = _.toPairs(basket).length
    EventBus.$emit('basketSize', basketSize)
}

function  quantityBasketSize(){ // quand on actualise permet de garder la quantité à jour 
    let quantity = getBasket()
    quantity = _.toPairsIn(quantity).length
    return quantity
} 