import Axios from "axios"

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
            getphotos: [],
            id_photo: {},
            loading: false,
        }
    },
    watch: {
        search: function (val) {
            if (val && val.length > 2) {
                Axios.get('/api/produit/fruits', { params: { query: val } })
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
           console.log(this.produit)
            Axios.post('/api/produit/updateProduct', {
                name: this.produit,
                id_producteur: this.id_producteur,
                price: this.price,
                quantity: this.quantity,
                fruits: this.fruits,
                id_photo: this.id_photo,
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
                    console.log(this.produit + this.producteur)
                )  
        },

        modifierProduit(product) {
            this.id_producteur = this.product.id_producteur
            this.produit = product.name
            this.quantity = product.quantity
            this.fruits = product.fruits
            this.price = product.price
            this.id = product.id
            this.id_photo = this.product.photo

            
            _.merge(this.fruitList, this.fruits) // sert à fusionner
            
           

        },

        
       /*  onFileChange(file) {
            this.photo = new Photo;
            let reader = new FileReader;

            reader.onload = (file) => {
               
                this.photo = file.target.result;
            };
            reader.readAsDataURL(file);
        },

        uploadPhoto() {
            
            axios.post('/api/produit/uploadPhoto/', {
                photo: this.photo,
                id:this.product.id
            })
                .then(function ({ data }) {
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
 */
        

        createFruit(val) {
            console.log(val)
        },


        //Todo à modifier getProducteur (la route c'est plus api/producteur)
        getProducteur() {
            Axios.get("/api/produit").then(({ data }) => {
                data.data.forEach(_produit => {
                    this.producteurs.push(_produit.producteur)
                    
                })
            }
            );
        },

        getPhoto() {
            Axios.get("/api/produit").then(({ data }) => {
                data.data.forEach(_produit => {
                    this.getphotos.push(_produit.photo) 
                   
                })
            }
            );
        },


    },
    created() {
        this.getProducteur();
        this.getPhoto();

    },
}
