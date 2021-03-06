import { apiServices } from "../_services/api.services";
import addPanier from "./components/addPanier.vue";

export default {
  components: {
    addPanier,
  },

  data: () => ({
    articles: [],
    categories: [],
    price: [],
    photo: [],
    categoryList: [],
    articlesDisplay: [],
    search: null,
    loading: false,
    rating: 4.3,
    articleTab: [],
    _article: [],
  }),

  watch: {
    search: function(val) {
      if (val && val.length > 2) {
        //Si la valeur plus grand que 2 alors il fait ce qu'il a dedans;
        this.loading = true;
        apiServices.get("/api/categories", { query: val }).then(({ data }) => {
          this.loading = false;

          data.forEach((categorie) => {
            this.categoryList.push(categorie.name);
          });
        });
      }
      //console.log(this.categoryList)
    },
  },

  methods: {
    articleDisplay() {
      apiServices.get("/api/articles").then(({ data }) => {
        data.data.forEach((_data) => {
          this.articles.push(_data);
        });
      });
      this.articlesDisplay = this.articles;
    },

    displayCategories(_categories) {
      var categories = [];
      _categories.forEach((_categorie) => {
        categories.push(_categorie.name);
      });
      return categories.join(", ");
    },

    filterCategorie() {
      this.articlesDisplay = [];
      console.log(this.articlesDisplay);
      let _articlesDisplay = [];
      if (_.isEmpty(this.categories)) {
        this.articlesDisplay = this.articles;
      } else {
        this.articles.forEach((article) => {
          if (article) {
            let _article = article;
            this.articleTab.push(article.categorie);
            if (article.categorie) {
              this.categories.forEach((categories) => {
                if (_.includes(categories, article.categorie.name)) {
                  _articlesDisplay[article.id] = _article;

                  this.articlesDisplay.push(article);
                }
              });
            }
          }
        });
      }
    },
  },

  created() {
    this.articleDisplay();
  },
};
