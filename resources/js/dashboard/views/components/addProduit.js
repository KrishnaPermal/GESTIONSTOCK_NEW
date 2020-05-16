import Axios from "axios"

export default {
    
    props: {
        
        isModification: {default:false},
        product: {default:function(){
          return {}  
        }
        
        
       
    },

    data() {
        return {
            dialog: false,
            informations: '',
            fruits: [],
            id_producteur: {},
            produit:'',
            produits: [],
            producteurs: [],
            //valeurProducteur:{},
            price:'',
            quantity:'',
            //snackbar: false,
            text: '',
            loading: false,
            
        }
    },

   
    methods: {
        
        modifierProduit(product){
            /* this.produit = product
            this.id_producteur,
            this.price,
            this.quantity,
            this.fruits */
            console.log(product)
         },

        addDatas() {
             Axios.post('/api/produit/add', {
                name: this.produit,
                id_producteur: this.id_producteur,
                price: this.price,
                quantity: this.quantity,
                fruits:this.fruits
                
            }).then(response => {
                this.dialog = false
                //this.snackbar = true
                this.text = 'le produit à bien été ajoutée'
                console.log('toto');
            }) 

             .catch(
                console.log(this.produit + this.producteur)
            )  
        }, 

        createFruit(val){
            console.log(val)
        },

        getProducteur(){
            Axios.get("/api/produit").then(({ data }) =>{
                data.data.forEach(_produit => {
                    //console.log(_produit.producteur)
                        this.producteurs.push(_produit.producteur)
                }
            )
            
        }

        );       
     },

    
    },
    created() {
        this.getProducteur();
        
    },
}}