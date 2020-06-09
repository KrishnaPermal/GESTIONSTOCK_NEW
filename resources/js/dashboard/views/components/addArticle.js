import {apiServices} from '../../_services/api.services'
import { authenticationService } from '../../_services/authentication.service';
export default {

    props: {
        product: {
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
           //console.log(this.produit)
           let datasToAdd ={
            mark: this.article,
            article_ref: this.article_ref,
            description: this.description,
            provider: this.id_fournisseur,
            price: this.price,
            quantity: this.quantity,
            categories: this.categories,
            photo: this.photo,
            id: this.id,
           }
           if(!this.isFournisseur){
               datasToAdd['id_fournisseur'] = this.article.id_fournisseur
           }
           let url = this.isFournisseur ? "/api/fournisseurs/articles" : "/api/articles"
            apiServices.post(url, datasToAdd).then(response => {
                 
                    console.log("Données enregistrée")
                    this.$emit('addArticle', response.data)
                    this.dialog = false;
                    this.dialog = false
                    this.snackbar = true
                    this.text = 'L\'Article à bien été ajoutée'
            
                })
            
             

            
                .catch(
                )  
        },

        modifierArticle(product) {
            if(!this.isFournisseur){
                this.id_fournisseur = this.product.id_fournisseur
            }
            this.article = product.name
            this.quantity = product.quantity
            this.categories = product.categories
            this.price = product.price
            this.id = product.id
            this.photo = this.product.photo


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
