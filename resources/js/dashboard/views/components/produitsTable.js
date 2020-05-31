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
        headers: [],

        availableHeaders: {
            produit: { text: "Produit", align: "start", sortable: false,value: "produit"},
            fruits:  { text: "Fruits", value: "fruits" },
            id_producteur:  { text: "Producteurs", value: "id_producteur" },
            quantite: { text: "Quantité", value: "quantity"},
            price: { text: "Prix", value: "price" },
            photo: { text: "Photo", value:"photo"},
            actions: { text: "Actions", value:"actions" }, 
        },
        
        produits: [],
        
    }),
    
    created() {
        this.initialize();
        this.setHeaders();

    },

    

    methods: {
        initialize() {
            // Si isProducteur est vrai alors utilise api/producteurs/produits sinon la route api/produits (retourne tous les produits)         
            let url = authenticationService.isProducteur() ? "/api/producteurs/produits" : "/api/produits"
            //let....() forme ternaire = condition ? (si la condition est vrai ont execute) : (si elle est fausse ont execute l'autre)
            apiServices.get(url).then(({ data }) => //test avec url ok sinon avec la route api/producteurs/produits = forbidden
                data.data.forEach(data => {
                    this.produits.push(data);
                    
                }),
            );

        },
        //Function pour set le headers  si ont est producteur ou pas dans le tableau
        setHeaders(){ 
            if (authenticationService.isProducteur()) { //si nous sommes producteur pas besoin du id_producteur
                this.headers = [
                    this.availableHeaders.produit,
                    this.availableHeaders.fruits,
                    this.availableHeaders.quantite,
                    this.availableHeaders.price,
                    this.availableHeaders.photo,
                    this.availableHeaders.actions,
                ]
            }
            else { //sinon ont affiche tout !!!
                this.headers = [
                    this.availableHeaders.produit,
                    this.availableHeaders.fruits,
                    this.availableHeaders.id_producteur,
                    this.availableHeaders.quantite,
                    this.availableHeaders.price,
                    this.availableHeaders.photo,
                    this.availableHeaders.actions,
                ]
            }
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
