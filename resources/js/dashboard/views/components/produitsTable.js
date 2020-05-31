import Axios from "axios";
import {apiServices} from '../../_services/api.services'
import { authenticationService } from "../../_services/authentication.service";

import addProduit from './addProduit.vue';


export default {
    components: {
        addProduit,
       
    },
    data: () => ({
        dialog: false,
        headers: [{
                text: "Produit",
                align: "start",
                sortable: false,
                value: "produit"
            },
            { text: "Fruits", value: "fruits" },
            { text: "Producteurs", value:"id_producteur" },
            { text: "Quantité", value: "quantity"},
            { text: "Prix", value: "price" },
            { text: "Photo", value:"photo"},
            { text: "Actions", value:"actions" },

        ],
        produits: [],
        
    }),
    
    created() {
        this.initialize();

    },

    

    methods: {
        initialize() {
            apiServices.get("/api/producteurs/produits").then(({ data }) =>
                data.data.forEach(data => {
                    this.produits.push(data);
                    
                }),
            );

        },
            

        displayFruits(items){
            var fruits=[];
            items.forEach(item=>{
                fruits.push((item.name))
            })
            return fruits.join(', ');
        },

        /* displayProducteurs(items){
            var producteur=[];
            items.forEach(item=>{
                producteur.push((item.name))
            })
            return producteur.join(', ');
        } */
    }
};
