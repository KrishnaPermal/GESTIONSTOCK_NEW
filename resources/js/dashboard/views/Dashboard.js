import Axios from "axios";
import addProduit from '../views/components/addProduit.vue'
export default {
    components: {
        addProduit,
    },
    data: () => ({
        dialog: false,
        headers: [{
                text: "Liste",
                align: "start",
                sortable: false,
                value: "produit"
            },
            { text: "Fruits", value: "fruits" },
            { text: "Quantite", value: "quantity" },
            { text: "Prix", value: "price" },
            { text: "Producteurs", value:"id_producteur"}



        ],
        produits: [],

    }),
    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            Axios.get("/api/users").then(({ data }) =>
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
        }
    }
};