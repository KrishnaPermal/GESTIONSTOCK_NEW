import { basketService } from './../_services/basket.service.js';
import {EventBus} from './../_helpers/event.bus';
import { authenticationService } from '../_services/authentication.service';
import { isEmpty } from 'lodash';


export default {

   
    data: () => ({
        basket: [],
        ordersList: [],
        ordersId: [],
        ordersQuantity: [],
        undefinedPanier: "",
    }),
    created() {
        this.getBasket()
        EventBus.$on('basket', (basket) => {
            this.basket = basket
        })
    },
    methods: {
        getBasket() {
            this.basket = basketService.getBasket()
            if(isEmpty(this.basket)) {
                this.undefinedPanier = "Votre panier est vide ! Votre quête du produit parfait dans les univers de notre site n'est pas encore achevée.";
            } 
            
        },
        updateQuantity(article) {
            this.orders = article
            if (article.quantity == 0) {
                if (confirm('Voulez-vous vraiment supprimer ce produit de votre liste')) {
                    basketService.replaceQuantity(article)
                }
                else {
                    article.quantity = 1
                    basketService.replaceQuantity(article)
                }
            }

        },
        sendOrder() {
            if (!authenticationService.currentUser) {
                this.$router.push('/login')
            }
            else {
                this.$router.push('/confirmation')
            }
              
        }
    }
}