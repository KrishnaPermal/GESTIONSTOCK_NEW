import Axios from "axios"

export default {
    
    //props: ["product"],

    data() {
        return {
            dialog: false,
            informations: '',
            fruits: [],
            producteur:'',
            produit:'',
            produits: [],
            producteurs: {},
            valeurProducteur:{},
            price:'',
            loading: false,
            
        }
    },

   
    methods: {
       
         addDatas() {
            /* Axios.post('/api/produit/add', {
                name: this.produit,
                id_producteur: this.id_producteur,
                prix: this.price,
                fruits:this.fruits
            }) */
            //console.log(this.producteurs)

            /* .then(response => {
                if (response.status === 201) {
                    console.log("Données enregistrée")
                    console.log(response.data)
                    this.$emit('addProduit', response.data)
                    console.log(response.data)
                }
            }) */

            /* .catch(
                console.log(this.produit + this.producteur)
            ) */
        },

        createFruit(val){
            console.log(val)
        },

        getProducteur(){
            Axios.get("/api/produit").then(({ data }) =>{
            data.data.forEach(_produit => {
                
                this.producteurs.push(_produit.producteur)
            
                }
            )
            console.log(this.producteurs)
        }

        );       
     },
    

    },
    created() {
        this.getProducteur();
        
    },
}