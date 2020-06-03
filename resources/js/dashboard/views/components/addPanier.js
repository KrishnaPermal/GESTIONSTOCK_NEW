import { basketService } from "../../_services/basket.service"

export default{
    
    data(){
        return{
            
            quantity: null
        }
    },
    props:{

        produit:{
            required:true,
        }
    },
    methods:{
        save(){

            basketService.addPanier(this.produit ,this.quantity);
                this.quantity=0;
               
            
        }

    }
}