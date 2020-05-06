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
            { text: "Produits", value: "produit" },
            { text: "Fruits", value: "fruits" },
            { text: "Quantité", value: "quantity" },
            { text: "Prix", value: "price" },
            { text: "Producteurs", value:"id_producteur"}



        ],
        product: [],

    }),
    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            Axios.get("/api/users").then(({ data }) =>
                data.data.forEach(data => {
                    this.product.push(data);
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