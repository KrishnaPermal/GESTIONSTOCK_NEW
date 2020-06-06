import {EventBus} from "../_helpers/event.bus";
export const basketService = {
    addPanier,
    getBasket,
    quantityBasketSize,
    updateBasket,
}


function addPanier(article, quantity) {

    let basket = getBasket()

    if (!_.hasIn(basket, buildKey(article))) {
        basket[buildKey(article)] = {
            id: article.id,
            article_ref: article.article_ref,
            description: article.description,
            provider: article.provider,
            quantity: parseInt(quantity),
            price: article.price
        }
    } else {
            
    basket[buildKey(article)].quantity += parseInt(quantity)
}  

// on appelle ensuite la fonction store pour l'ajouté au local storage
storeBasket(basket)
console.log(basket)

}

function buildKey(article){
    return 'article_' + article.id
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
    EventBus.$emit('updateBasket', basket)
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

function updateBasket(article){
    let basket = getBasket();
    if (_.hasIn(basket, buildKey(article))){
        basket[buildKey(article)] = article;
        if((basket[buildKey(article)].quantity)==0){
            _.unset(basket, buildKey(article))
        }

    } else {
        throw 'error'
    }
    storeBasket(basket);
}