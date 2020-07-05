/* import { EventBus } from "../_helpers/event.bus";
import {basketService} from  "../_services/basket.service";
import { authenticationService } from '../_services/authentication.service.js';

import {apiServices} from '../_services/api.services'
import addPanier from './components/addPanier.vue';

export default {
    components:{
        addPanier,
    },
   
    data:() => ({
        articles: [],
        price: [],
        articlesDisplay: [],
        quantity: 0,
    }),

    methods: {

        updateQuantity(article){
            console.log(article.quantity)
            if (article.quantity == 0) {
                if(confirm("Êtes vous sur de vouloir supprimer? " + article.mark + "?")){
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

        articleDisplay() {
            apiServices.get('/api/articles')
                .then(({ data }) => {
                    data.data.forEach(_data => {
                        this.articles.push(_data)
                    })
                })
            this.articlesDisplay = this.articles;
        },

        sendOrder() {
            if (!authenticationService.currentUser) {
                this.$router.push('/login')
            }
            else {
                this.$router.push('/confirmation')
            }
              
        }
        
    },
    

    created() {
        this.articleDisplay();

        this.quantity = basketService.quantityBasketSize()
        this.initTable(basketService.getBasket()) // pour le emit 
        EventBus.$on('basketSize', basketSize => {
            this.quantity = basketSize
            this.initTable(basketService.getBasket()) // quand ont actualise
            
        });
        console.log(this.itemPanier)
    }
}
 */