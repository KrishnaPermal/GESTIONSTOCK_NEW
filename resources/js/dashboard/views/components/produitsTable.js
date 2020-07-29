import { apiServices } from "../../_services/api.services";
import { authenticationService } from "../../_services/authentication.service";
import addArticle from "./addArticle.vue";
import Delete from "../components/deleteArticles.vue";

export default {
  components: {
    addArticle,
    Delete,
  },
  data: () => ({
    dialog: false,
    headers: [],

    availableHeaders: {
      photo: { text: "Photo", value: "photo" },
      article: {
        text: "Article",
        align: "start",
        sortable: false,
        value: "article",
      },
      categories: { text: "Categories", value: "categorie" },
      id_fournisseur: { text: "Fournisseurs", value: "id_fournisseur" },
      quantity: { text: "Quantité", value: "quantity" },
      price: { text: "Prix", value: "price" },
      actions: { text: "Actions", value: "actions" },
    },

    articles: [],
  }),

  created() {
    this.initialize();
    this.setHeaders();
  },

  methods: {
    initialize() {
      // Si isFournisseur est vrai alors utilise api/fournisseurs/articles sinon la route api/articles (retourne tous les articles)
      let url = authenticationService.isFournisseur()
        ? "/api/fournisseurs/articles"
        : "/api/articles";
      //let....() forme ternaire = condition ? (si la condition est vrai ont execute) : (si elle est fausse ont execute l'autre)
      apiServices.get(url).then((
        { data } //test avec url ok sinon avec la route api/fournisseurs/articles = forbidden
      ) =>
        data.data.forEach((_data) => {
          this.articles.push(_data);
        })
      );
    },
    //Function pour set le headers  si ont est fournisseur ou pas dans le tableau
    setHeaders() {
      if (authenticationService.isFournisseur()) {
        //si nous sommes fournisseur pas besoin du id_fournisseur
        this.headers = [
          this.availableHeaders.photo,
          this.availableHeaders.article,
          this.availableHeaders.categories,
          this.availableHeaders.quantity,
          this.availableHeaders.price,
          this.availableHeaders.actions,
        ];
      } else {
        //sinon ont affiche tout !!!
        this.headers = [
          this.availableHeaders.photo,
          this.availableHeaders.article,
          this.availableHeaders.categories,
          this.availableHeaders.id_fournisseur,
          this.availableHeaders.quantity,
          this.availableHeaders.price,
          this.availableHeaders.actions,
        ];
      }
    },
    /*   displayCategories(items){
            var categories=[];
            items.forEach(item=>{
                categories.push((item.name))
            })
            return categories.join(', ');
        },
 */
  },
};
