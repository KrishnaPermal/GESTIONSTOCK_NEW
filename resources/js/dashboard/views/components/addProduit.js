import Axios from "axios"

export default {
    data() {
        return {
            dialog: false,
            informations: '',
            fruits:'',
            producteur:'',
            produit:'',
            producteurs: [],
            price:'',
        }
    },

    methods: {
       
         addDatas() {
            Axios.post('../api/addProduit', {
                name: this.produit,
                id_producteur: this.producteur,
                prix: this.prix,
            })
            .then(response => {
                if (response.status === 201) {
                    console.log("Données enregistrée")
                    this.$emit('addProduit', response.data)
                    console.log(response.data)
                }
            })
            .catch(
                console.log(this.product + this.producteur)
            )
        }, 
        getProducteur(){
            Axios.get("/api/users").then(({ data }) =>
            data.data.forEach(data => {
                this.producteurs.push(data.id_producteur);
            })
        );       
     },
    

    },
    created() {
        this.getProducteur();
    },
}