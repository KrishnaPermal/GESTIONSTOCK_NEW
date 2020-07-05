import { basketService } from "../../_services/basket.service"

export default{
    
    data(){
        return{
            
            quantity: null
        }
    },
    props:{

        article:{
            required:true,
        },
    },
    created(){

    },
    methods:{
        add(){

            basketService.addPanier(this.article ,this.quantity);
                this.quantity=0;
               
            
        }

    }
}