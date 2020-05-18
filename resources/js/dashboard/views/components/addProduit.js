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
            //valeurProducteur:{},
            price: '',
            quantity: '',
            //snackbar: false,
            text: '',
            //files: [],
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
            //this.files = product.files
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
                //files: this.files,
                id: this.id,

            }).then(response => {
                if (response.status === 201) {
                    console.log("Données enregistrée")
                    console.log(this.product.id)
                    this.$emit('addProduit', response.data)
                }

                /* this.dialog = false
                this.snackbar = true
                this.text = 'le produit à bien été ajoutée'
                console.log('toto');  */
            })

                .catch(
                    console.log(this.produit + this.producteur)
                )

                
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
