import { EventBus } from "../../_helpers/event.bus";
import {basketService} from  "../../_services/basket.service";

export default {
    data(){
        return{
            quantity: 0,
            itemPanier:[],
        }
    },
    methods:{

        updateQuantity(article){
            if (article.quantity == 0) {
                if(confirm("Êtes vous sur de vouloir supprimer? " + article.name + "?")){
                    basketService.updateBasket(article);
                } else {
                    article.quantity = 1;
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
    },
 
    created(){
        this.quantity = basketService.quantityBasketSize()
        this.initTable(basketService.getBasket()) // pour le emit 
        EventBus.$on('basketSize', basketSize => {
            this.quantity = basketSize
            this.initTable(basketService.getBasket()) // quand ont actualise
            
        });
    },

}