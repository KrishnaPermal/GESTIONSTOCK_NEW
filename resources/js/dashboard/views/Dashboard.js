import Axios from "axios";
import addProduit from '../views/components/addProduit.vue';
import editProduit from '../views/components/editProduit.vue';

export default {
    components: {
        addProduit,
        editProduit,
    },
    data: () => ({
        dialog: false,
        headers: [{
                text: "Produit",
                align: "start",
                sortable: false,
                value: "produit"
            },
            { text: "Fruits", value: "fruits" },
            { text: "Prix", value: "price" },
            { text: "Quantité", value: "quantity"},
            { text: "Producteurs", value:"id_producteur" },
            { text: "Actions", value:"actions" },

        ],
        produits: [],

    }),
    created() {
        this.initialize();
      
    },

    methods: {
        initialize() {
            Axios.get("/api/produit").then(({ data }) =>
                data.data.forEach(data => {
                    this.produits.push(data);
                })
            );
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
