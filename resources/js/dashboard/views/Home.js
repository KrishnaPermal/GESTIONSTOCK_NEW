
import Axios from 'axios';

export default {
    components:{
        //ShowCircuit,
        //UploadFile
    },
    data:() => ({
        produits: [],
        fruits: [],
        price: [],
        photo: [],
        fruitList: [],
        search: null,
        loading: false,
        dialog: false,

    }),
    
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
            console.log(this.fruitList)
        },
    },



    methods: {
        getDatas() {
            axios.get('/api/produit')
                .then(({ data }) => {
                    data.data.forEach(produit => {
                        this.produits.push(produit)
                    })
                })
                .catch();
        },

        displayFruits(produits){
            var fruits=[];
            produits.forEach(produit=>{
                fruits.push((produit.name))
            })
            return fruits.join(', ');
        },
        
    },

    

    created() {
        this.getDatas();
    }
}
