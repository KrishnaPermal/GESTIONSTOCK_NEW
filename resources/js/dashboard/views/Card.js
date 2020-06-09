import {apiServices} from '../_services/api.services'
import addPanier from './components/addPanier.vue';
export default {
    components:{
        addPanier,
    },
   
    data:() => ({
        articles: [],
        categories: [],
        price: [],
        photo: [],
        categoryList: [],
        articlesDisplay: [],
        search: null,
        loading: false,
    }),
    
    watch: {
        search: function (val) {
            if (val && val.length > 2) { //Si la valeur plus grand que 2 alors il fait ce qu'il a dedans;
                this.loading = true
                apiServices.get('/api/categories',  { query: val } )
                    .then(({ data }) => {
                        this.loading = false
                        

                        data.forEach(categorie => {
                            this.categoryList.push(categorie.name)
                            
                        })
                    })
            }
            //console.log(this.categoryList)
        },
    },

    methods: {
        articleDisplay() {
            apiServices.get('/api/articles')
                .then(({ data }) => {
                    data.data.forEach(_data => {
                        this.articles.push(_data)
                    })
                })
            this.articlesDisplay = this.articles;
        },
        
        displayCategories(_categories){
            var categories=[];
            _categories.forEach(_categorie=>{
                categories.push((_categorie.name))
            })
            return categories.join(', ');
        },


        filterCategorie() {
            this.articlesDisplay = []

            let _articlesDisplay = []

            if (_.isEmpty(this.categories)) {
                this.articlesDisplay = this.articles
            } else {
                this.articles.forEach(article => {
                    if (article) {

                        let _article = article
                        article.categories.forEach(_categorie => {

                            if (_categorie) {
                                this.categories.forEach(categories => {

                                    if (_.includes(categories, _categorie.name)) {

                                        _articlesDisplay[article.id] = _article
                                        this.articlesDisplay.push(_article)
                                       
                                    }
                                })
                            }

                        })

                    }

                })
            }
        },
    
    },
    

    created() {
        this.articleDisplay();
    }
}
