import { EventBus } from "../_helpers/event.bus";
import {basketService} from  "../_services/basket.service";

import {apiServices} from '../_services/api.services'
import addPanier from './components/addPanier.vue';

export default {
    components:{
        addPanier,
    },
   
    data:() => ({
        produits: [],
        price: [],
        produitsDisplay: [],
        quantity: 0,
    }),

    methods: {

        updateQuantity(produit){
            console.log(produit.quantity)
            if (produit.quantity == 0) {
                if(confirm("Êtes vous sur de vouloir supprimer? " + produit.name + "?")){
                    basketService.updateBasket(produit);
                } else {
                    produit.quantity = 1;
                }
            }
        
        },
        initTable(itemPanier){ 
            this.itemPanier = []
            let counter = 0 
            let breakException = {} 
            try {
                for (let key in itemPanier){ // chaque confiture sera dans itemPanier
                    let item = itemPanier[key]
                    this.itemPanier.push(item)
                    counter++;
                    if (counter === 3) {
                        throw breakException
                    }
                }
                
            }
            catch(e){
                if(e !==breakException){
                    throw e
                }
            }
        },

        produitDisplay() {
            apiServices.get('/api/produits')
                .then(({ data }) => {
                    data.data.forEach(_data => {
                        this.produits.push(_data)
                    })
                })
            this.produitsDisplay = this.produits;
        },
        
    },
    

    created() {
        this.produitDisplay();

        this.quantity = basketService.quantityBasketSize()
        this.initTable(basketService.getBasket()) // pour le emit 
        EventBus.$on('basketSize', basketSize => {
            this.quantity = basketSize
            this.initTable(basketService.getBasket()) // quand ont actualise
            
        });
        console.log(this.itemPanier)
    }
}
