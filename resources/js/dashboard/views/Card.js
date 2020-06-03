import {apiServices} from '../_services/api.services'
import addPanier from './components/addPanier.vue';
export default {
    components:{
        addPanier,
    },
   
    data:() => ({
        produits: [],
        fruits: [],
        price: [],
        photo: [],
        fruitList: [],
        produitsDisplay: [],
        search: null,
        loading: false,
    }),
    
    watch: {
        search: function (val) {
            if (val && val.length > 2) { //Si la valeur plus grand que 2 alors il fait ce qu'il a dedans;
                this.loading = true
                apiServices.get('/api/fruits',  { query: val } )
                    .then(({ data }) => {
                        this.loading = false

                        data.forEach(fruit => {
                            this.fruitList.push(fruit)
                        })
                    })
            }
            //console.log(this.fruitList)
        },
    },

    methods: {
        produitDisplay() {
            apiServices.get('/api/produits')
                .then(({ data }) => {
                    data.data.forEach(_data => {
                        this.produits.push(_data)
                    })
                })
            this.produitsDisplay = this.produits;
        },
        
        displayFruits(_fruits){
            var fruits=[];
            _fruits.forEach(_fruit=>{
                fruits.push((_fruit.name))
            })
            return fruits.join(', ');
        },


        filterFruit() {
            this.produitsDisplay = []

            let _produitsDisplay = []

            if (_.isEmpty(this.fruits)) {
                this.produitsDisplay = this.produits
            } else {
                this.produits.forEach(produit => {
                    if (produit) {

                        let _produit = produit
                        produit.fruits.forEach(_fruit => {

                            if (_fruit) {
                                this.fruits.forEach(fruits => {

                                    if (_.includes(fruits, _fruit.name)) {

                                        _produitsDisplay[produit.id] = _produit
                                        this.produitsDisplay.push(_produit)
                                        //console.log(this.produitsDisplay)
                                    }
                                })
                            }

                        })

                    }

                })
            }
        },

        /**A revoir pourquoi cette méthode ne fonctionne pas*/
        /* filterFruit() {
            this.produitsDisplay = []
        
            let _produitsDisplay = []
            if (_.isEmpty(this.fruits)) {
                this.produitsDisplay = this.produits
            }
            else {
                this.produits.forEach(produit => {
                    if (produit) {
                        let _produit = produit
                        produit.fruits.forEach(_fruit => {
                          
                            if (_.includes(this.fruits, _fruit.name)) {
                                _produitsDisplay[_produit.id] = _produit
                            }
                        })
                    
                    }
                })
                _produitsDisplay.forEach(_produit => {
                    this.produitsDisplay.push(_produit)
        
                })
            }
        }, */
        
    },
    

    created() {
        this.produitDisplay();
    }
}
