import { EventBus } from "../../_helpers/event.bus";
import {basketService} from  "../../_services/basket.service";

export default {
    data(){
        return{
            quantity: 0,
        }
    },
    created(){
        this.quantity = basketService.quantityBasketSize()
        EventBus.$on('basketSize', basketSize => {
            this.quantity = basketSize
            console.log(basketSize)
        } )
    },
}