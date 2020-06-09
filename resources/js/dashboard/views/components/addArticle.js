import {apiServices} from '../../_services/api.services'
import { authenticationService } from '../../_services/authentication.service';
export default {

    props: {
        articles: {
            default: function () {
                return {

                }
            }
        },
        isModification: {
            default: false
        },
    },
    data() {
        return {
            id: '',
            dialog: false,
            informations: '',
            categories: [],
            id_fournisseur: {},
            article: '',
            article_ref: '',
            description: '',
            articles: [],
            fournisseurs: [],
            categoryList: [],
            search: null,
            price: '',
            quantity: '',
            snackbar: false,
            text: '',
            photo: '',
            loading: false,
            isFournisseur: authenticationService.isFournisseur(),
        }
    },
    watch: {
        search: function (val) {
            if (val && val.length > 2) {
                apiServices.get('/api/categories',  { query: val } )
                    .then(({ data }) => {
                        this.loading = false

                        data.forEach(categorie => {
                            this.categoryList.push(categorie)
                        })
                    })
            }
        },
    },

    
    methods: {

        addDatas() {

           let datasToAdd = {
            mark: this.article,
            article_ref: this.article_ref,
            description: this.description,
            provider: this.id_fournisseur,
            price: this.price,
            quantity: this.quantity,
            categories: this.categories,
            photo: this.photo,
            id: this.id,
            id_fournisseur: this.id_fournisseur
           }
           let url = this.isFournisseur ? "/api/fournisseurs/articles" : "/api/articles"
            apiServices.post(url, datasToAdd).then(response => {
                 
                    this.$emit('addArticle', response.data.data)
                    this.dialog = false;
                    this.dialog = false
                    this.snackbar = true
                    this.text = 'L\'Article à bien été ajoutée'
            
                })
            
             

            
                .catch(
                )  
        },

        modifierArticle(articles) {
            if(!this.isFournisseur){
                this.id_fournisseur = this.articles.id_fournisseur
            }
            this.article = articles.mark
            this.quantity = articles.quantity
            this.categories = articles.categories
            this.price = articles.price
            this.id = articles.id
            this.photo = this.articles.photo


            _.merge(this.categories, this.categoryList) // sert à fusionner

        },
        
        onFileChange(file) {
            let reader = new FileReader;

            reader.onload = (file) => {
                this.photo = file.target.result;
            };
            reader.readAsDataURL(file);
        },

        createCategorie(val) {
            console.log(val)
        },


        //Todo à modifier getFournisseur (la route c'est plus api/fournisseur)
        //function qui gère les données du selectFournisseur
        getFournisseur() {
            // si le role n'est pas fournisseur, ne vas pas faire la requête
            if(!this.isFournisseur){ 
                apiServices.get("/api/articles").then(({ data }) => {
                    data.data.forEach(_article => {
                        this.fournisseurs.push(_article.fournisseur)  
                        })
                    }
                );
            }
            
        },

    },
    created() {
        this.getFournisseur();
        console.log(this.article)
    },
}
