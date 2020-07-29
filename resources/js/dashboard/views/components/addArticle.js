import { apiServices } from "../../_services/api.services";
import { authenticationService } from "../../_services/authentication.service";

export default {
  props: {
    articles: {
      default: function() {
        return {};
      },
    },
    article: {
      default: function() {
        return {};
      },
    },
    isModification: {
      default: false,
    },
  },
  data() {
    return {
      id: "",
      dialog: false,
      informations: "",
      categories: {},
      id_fournisseur: {},
      var_article: "",
      article_ref: "",
      description: "",
      fournisseurs: [],
      categoryList: [],
      search: null,
      price: "",
      quantity: "",
      snackbar: false,
      timeout: 3000,
      text: "",
      photo: "",
      loading: false,
      isFournisseur: authenticationService.isFournisseur(),

      articleRules: [(v) => !!v || "Une marque est requise"],

      id_fournisseurRules: [(v) => !!v || "Un fournisseur est requis"],

      priceRules: [(v) => !!v || "Un prix est requis"],

      article_refRules: [(v) => !!v || "Une référence est requise"],

      descriptionRules: [
        (v) => !!v || "Une description est requise",
        (v) =>
          (v && v.length <= 50) ||
          "La description ne doit pas être supérieure à 50 Caractères",
      ],

      quantityRules: [(v) => !!v || "Une quantité est requise"],

      photoRules: [(v) => !!v || "Une photo est requise"],
    };
  },

  methods: {
    addDatas() {
      let datasToAdd = {
        mark: this.var_article,
        article_ref: this.article_ref,
        description: this.description,
        provider: this.id_fournisseur,
        price: this.price,
        quantity: this.quantity,
        categorie: this.categories,
        photo: this.photo,
        id: this.id,
        id_fournisseur: this.id_fournisseur,
      };

      let url = this.isFournisseur
        ? "/api/fournisseurs/articles"
        : "/api/articles";
      apiServices.post(url, datasToAdd).then(({ data }) => {
        if (this.isModification) {
          if (this.id) {
            const index = this.articles.indexOf(this.article);
            this.articles.splice(index, 1, data.data);
          }
        }
        this.dialog = false;
        this.$emit("addArticles", data.data);
        this.snackbar = true;
        this.text = "L'Article à bien été ajoutée";
      });
    },

    modifierArticle(article) {
      console.log(article.categorie)
      this.id_fournisseur = article.id_fournisseur;
      this.var_article = article.mark;
      this.categories = article.categorie;
      this.description = article.description;
      this.article_ref = article.article_ref;
      this.quantity = article.quantity;
      this.price = article.price;
      this.id = article.id;
      this.photo = article.photo;
    },

    onFileChange(file) {
      let reader = new FileReader();

      reader.onload = (file) => {
        this.photo = file.target.result;
      };
      reader.readAsDataURL(file);
    },

    //Todo à modifier getFournisseur (la route c'est plus api/fournisseur)
    //function qui gère les données du selectFournisseur
    getFournisseur() {
      // si le role n'est pas fournisseur, ne vas pas faire la requête
      if (!this.isFournisseur) {
        apiServices.get("/api/articles").then(({ data }) => {
          data.data.forEach((_article) => {
            this.fournisseurs.push(_article.fournisseur);
            
          });
        });
      }
    },

    getCategorie() {
      // si le role n'est pas fournisseur, ne vas pas faire la requête
      apiServices.get("/api/articles/categories").then(({ data }) => {
        data.data.forEach((_categories) => {
          this.categoryList.push(_categories);
          console.log(this.categoryList)
        });
      });
    },
  },

  created() {
    this.getFournisseur();
    this.getCategorie();
  },
};
