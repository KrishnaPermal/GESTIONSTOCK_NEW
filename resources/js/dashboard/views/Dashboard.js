import Axios from "axios";
import addProduit from '../views/components/addProduit.vue'
export default {
    components: {
        addProduit,
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
            { text: "Recompenses", value: "recompenses"},
            { text: "Quantite", value: "quantity" },
            { text: "Prix", value: "price" },
            { text: "Producteurs", value:"id_producteur"}



        ],
        produits: [],

    }),
    created() {
        this.initialize();
        this.getDatas();
    },

    methods: {
        initialize() {
            Axios.get("/api/users").then(({ data }) =>
                data.data.forEach(data => {
                    this.produits.push(data);
                })
            );
        },
            getDatas() {
              axios
                .get("/api/produit")
                .then(({ data }) => {
                  this.produits=data.data;
                 console.log(this.produits);
                     //console.log(data);
                       //console.log(data.data[0].fruits[0].name);
                })
                .catch(error => console.log(error));
            },

        displayFruits(items){
            var fruits=[];
            items.forEach(item=>{
                fruits.push((item.name))
            })
            return fruits.join(', ');
        },

        displayRecompenses(items){
            var recompenses=[];
            items.forEach(item=>{
                recompenses.push((item.name))
            })
            return recompenses.join(', ');
        }
    }
};