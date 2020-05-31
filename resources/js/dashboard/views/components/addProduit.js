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
            apiServices.post('/api/produits/', {
                name: this.produit,
                id_producteur: this.id_producteur,
                price: this.price,
                quantity: this.quantity,
                fruits: this.fruits,
                photo: this.photo,
                id: this.id,
            

            }).then(response => {
                 
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
            this.id_producteur = this.product.id_producteur
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
        getProducteur() {
            apiServices.get("/api/produits").then(({ data }) => {
                data.data.forEach(_produit => {
                    this.producteurs.push(_produit.producteur)
                    
                })
            }
            );
        },

    },
    created() {
        this.getProducteur();

        if(this.isProducteur){
            console.log(this.isProducteur)
            console.log('PRODUCTok')
        }else{
            console.log('ADMINOK')
        }
    },
}
