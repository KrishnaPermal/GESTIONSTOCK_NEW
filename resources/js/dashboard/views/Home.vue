<template>
  <v-container>
    <div>
      <v-card-title class="text-center justify-center py-6">
        <h1 class="font-italic font-weight-bold display-1 cyan--text">GESTION DE STOCK</h1>
      </v-card-title>

      <v-container class="text-center justify-center py-6">
        <img src="storage/images/logo1.png" width="150px" height="150px" />
        <h1 class="text-center justify-center py-6">Presentation</h1>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit.
          Tempore officia officiis veritatis, tempora velit adipisci architecto consectetur enim modi quaerat doloremque placeat nulla!
          Voluptatibus ab itaque adipisci quibusdam nostrum perspiciatis.
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          Fuga, eos ad! Assumenda incidunt cum rem unde laboriosam fugiat consequuntur enim, a saepe libero omnis?
          Omnis asperiores quos inventore corrupti aperiam.
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
          Repellat, perspiciatis dicta! Qui earum corrupti saepe doloribus inventore harum neque in nemo laudantium voluptate, reiciendis asperiores, alias illo quisquam cumque mollitia.
        </p>
      </v-container>

      <v-divider></v-divider>

      <h2 class="text-center py-6">Meilleurs ventes</h2>
      <br />
      <BestSeller></BestSeller>

      <v-divider></v-divider>
      <h1 class="text-center py-6">Nouveautés</h1>
      <br />
      <!--Carte-->

      <v-container fluid>
        <v-row dense class="justify-center">
          <v-card
            v-for="(article,key) in articlesDisplay"
            :key="key"
            class="mx-2 my-4 d-flex py-2"
            max-width="200"
          >
            <v-col class>
              <v-responsive>
                <v-img
                  
                  :src="article.photo"
                  class="white--text align-end"
                  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                ></v-img>
              </v-responsive>
              <v-card-title>{{article.mark}}</v-card-title>
              <v-card-text>Categorie: {{displayCategories(article.categories)}}</v-card-text>
              <v-card-subtitle>Prix: {{article.price}} €</v-card-subtitle>
              <v-btn d-inline>toto</v-btn>
            </v-col>
          </v-card>
        </v-row>
      </v-container>

      <v-divider></v-divider>
      <h1 class="text-center justify-center py-6">Nos Marques</h1>
      <v-container class="text-center justify-center py-6">
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit.
          Tempore officia officiis veritatis, tempora velit adipisci architecto consectetur enim modi quaerat doloremque placeat nulla!
          Voluptatibus ab itaque adipisci quibusdam nostrum perspiciatis.
        </p>
        <Mark></Mark>
      </v-container>
      <v-divider></v-divider>

      <!--Carte-->
    </div>
  </v-container>
</template>


<script>
import { apiServices } from "../_services/api.services";
//import addPanier from './components/addPanier.vue';
import BestSeller from "./components/BestSeller.vue";
import Mark from "./components/Mark.vue";

export default {
  components: {
    BestSeller,
    Mark
  },

  data: () => ({
    articles: [],
    photo: [],
    articlesDisplay: [],
  }),

  methods: {
    articleDisplay() {
      apiServices.get("/api/articles").then(({ data }) => {
        data.data.forEach(_data => {
          this.articles.push(_data);
        });
      });
      this.articlesDisplay = this.articles;
    },

    displayCategories(_categories) {
      var categories = [];
      _categories.forEach(_categorie => {
        categories.push(_categorie.name);
      });
      return categories.join(", ");
    }
  },

  created() {
    this.articleDisplay();
  }
};
</script>    

