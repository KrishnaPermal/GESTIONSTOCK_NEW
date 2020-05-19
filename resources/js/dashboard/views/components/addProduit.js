import Axios from "axios"

export default {

    props: {
        isModification: {
            default: false
        },
        product: {
            default: function () {
                return {}
            }
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
            photo: [],

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

        modifierProduit(product) {
            this.id_producteur = product.id_producteur
            this.produit = product.name
            this.quantity = product.quantity
            this.fruits = product.fruits
            this.price = product.price
            this.id = product.id
            _.merge(this.fruitList, this.fruits) // sert à fusionner
            //console.log(product)
           

        },
        addDatas() {
           console.log(this.produit)
            Axios.post('/api/produit/updateProduct', {
                name: this.produit,
                id_producteur: this.id_producteur,
                price: this.price,
                quantity: this.quantity,
                fruits: this.fruits,
                id: this.id,

            }).then(response => {
                if (response.status === 201) {
                    console.log("Données enregistrée")
                    console.log(this.product.id)
                    this.$emit('addProduit', response.data)
                }

                this.dialog = false
                this.snackbar = true
                this.text = 'le produit à bien été ajoutée'
                //console.log('toto'); 
            })

                .catch(
                    console.log(this.produit + this.producteur)
                )  
        },

        
        onFileSelected(e) {
            let files = e.target.files || e.dataTransfer.files;
            this.createImg(files[0]);
        },
        
        createImg(file) {
            let reader = new FileReader;

            reader.onload = (e) => {
                this.photo = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        greet: function uploadImg() {

           
            console.log(this.photo);
            axios.post('/api/produit/image/{id}/' + this.produit.id, {
                photo: this.photo
                
            })
                .then(function ({data}) {
                   // console.log(data);
                })
                .catch(function (error) {
                    //console.log(error);
                });
        },

        removeImg() {
            this.photo = "";
        },

        

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


    },
    created() {
        this.getProducteur();

    },
}
