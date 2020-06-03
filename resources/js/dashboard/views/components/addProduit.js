import Axios from "axios"
import {apiServices} from '../../_services/api.services'
import { authenticationService } from '../../_services/authentication.service';
export default {

    props: {
        product: {
            default: function () {
                return {

                }
            }
        },
        isModification: {
            default: false
        },
    },
    data() {
        return {
            id: '',
            dialog: false,
            informations: '',
            fruits: [],
            id_producteur: {},
            produit: '',
            produits: [],
            producteurs: [],
            fruitList: [],
            search: null,
            price: '',
            quantity: '',
            snackbar: false,
            text: '',
            photo: '',
            loading: false,
            isProducteur: authenticationService.isProducteur(),
        }
    },
    watch: {
        search: function (val) {
            if (val && val.length > 2) {
                apiServices.get('/api/fruits',  { query: val } )
                    .then(({ data }) => {
                        this.loading = false

                        data.forEach(fruit => {
                            this.fruitList.push(fruit)
                        })
                    })
            }
        },
    },

    
    methods: {

        addDatas() {
           //console.log(this.produit)
           let datasToAdd ={
            name: this.produit,
            price: this.price,
            quantity: this.quantity,
            fruits: this.fruits,
            photo: this.photo,
            id: this.id,
           }
           if(!this.isProducteur){
               datasToAdd['id_producteur'] = this.produit.id_producteur
           }
           let url = this.isProducteur ? "/api/producteurs/produits" : "/api/produits"
            apiServices.post(url, datasToAdd).then(response => {
                 
                    console.log("Données enregistrée")
                    this.$emit('addProduit', response.data)
                    this.dialog = false;
                    this.dialog = false
                    this.snackbar = true
                    this.text = 'le produit à bien été ajoutée'
            
                })
            
             

            
                .catch(
                )  
        },

        modifierProduit(product) {
            if(!this.isProducteur){
                this.id_producteur = this.product.id_producteur
            }
            this.produit = product.name
            this.quantity = product.quantity
            this.fruits = product.fruits
            this.price = product.price
            this.id = product.id
            this.photo = this.product.photo


            _.merge(this.fruits, this.fruitList) // sert à fusionner

        },
        
        onFileChange(file) {
            let reader = new FileReader;

            reader.onload = (file) => {
                this.photo = file.target.result;
            };
            reader.readAsDataURL(file);
        },

        createFruit(val) {
            console.log(val)
        },


        //Todo à modifier getProducteur (la route c'est plus api/producteur)
        //function qui gère les données du selectProducteur
        getProducteur() {
            // si le role n'est pas producteur, ne vas pas faire la requête
            if(!this.isProducteur){ 
                apiServices.get("/api/produits").then(({ data }) => {
                    data.data.forEach(_produit => {
                        this.producteurs.push(_produit.producteur)  
                        })
                    }
                );
            }
            
        },

    },
    created() {
        this.getProducteur();
        console.log(this.produit)
    },
}
