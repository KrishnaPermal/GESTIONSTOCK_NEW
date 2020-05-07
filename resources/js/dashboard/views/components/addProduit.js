import Axios from "axios"

export default {
    data() {
        return {
            dialog: false,
            informations: '',
            fruits:'',
            producteur:'',
            produit:'',
            produits: [],
            price:'',
        }
    },

    methods: {
       
         addDatas() {
            Axios.post('../api/Produit', {
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
                console.log(this.produit + this.producteur)
            )
        }, 
        getProduit(){
            Axios.get("/api/produit").then(({ data }) =>
            data.data.forEach(_data => {
                console.log(_data)
               /*  this.produits.push(data.id_producteur); */
            })
        );       
     },
    

    },
    created() {
        this.getProduit();
    },
}