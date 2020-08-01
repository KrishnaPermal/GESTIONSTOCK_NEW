<template>
  <v-container>
    <div>
      <v-card-title class="text-center justify-center py-6">
        <h1
          class="font-italic font-weight-bold text-caption text-sm-body-2 text-md-body-1 text-lg-h3 cyan--text"
        >GESTION DE STOCK</h1>
      </v-card-title>

      <v-container fluid>
        <v-row class="text-center justify-center py-6">
          <v-col cols="12" md="6">
            <img src="storage/images/logo1.png" width="400px" height="400px" />
          </v-col>

          <v-col cols="12" md="6">
            <h1 class="text-center justify-center py-6">Bienvenue</h1>
            <p>
              S.N.& INFORMATIQUE, spécialiste de la vente sur Internet de matériel informatique, High-Tech et multimédia est rapidement devenu un acteur majeur du e-commerce. 
              S.N & INFORMATIQUE a dès sa fondation souhaité trouver un positionnement différenciant, largement centré sur son offre et sa relation client : choix des produits, qualité du site, des conseils mais également du service avant et après-vente. 
              Des atouts qui ont permis à S.N.& INFORMATIQUE d'être plusieurs fois récompensé pour sa Relation Clients. 
              Nos équipes sont à votre écoute pour vous apporter les meilleurs conseils, que vous soyez un particulier ou un professionnel !
              Nos spécialistes produits sélectionnent avec soin les références de notre catalogue afin de faciliter votre choix et vous offrir le meilleur rapport qualité / prix. 
              Vous trouverez une large sélection des meilleurs composants PC pour équiper votre ordinateur : carte mère, processeur, carte graphique, disque dur SSD, disque dur interne, disque dur externe... 
              S.N.& INFORMATIQUE met à votre disposition un catalogue produits de plus de 15 000 références de marques dans les univers de l'informatique et réseau (serveur NAS ou encore de la mémoire pour ordinateur), mais aussi du High-Tech et du multimédia : smartphone, tablette tactile, téléviseur, l'audio (casque, enceinte bluetooth, HiFi...), la vidéo ou encore la photo.
            </p>
          </v-col>
        </v-row>
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
          <template v-for="(article, key) in articles">
            <v-col :key="key" cols="12" md="3">
              <v-hover v-slot:default="{ hover }">
                <v-card
                  :elevation="hover ? 12 : 2"
                  :class="{ 'on-hover': hover }"
                  :key="key"
                  class="mx-2 my-4"
                >
                  <v-img
                    :aspect-ratio="16/9"
                    :src="article.photo"
                    class="white--text align-end"
                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                  >
                    <v-card-title>{{article.mark}}</v-card-title>
                  </v-img>
                  <v-card-subtitle>Prix: {{article.price}} €</v-card-subtitle>
                  <v-card-text>Categorie: {{article.categorie.name}}</v-card-text>
                  <v-card-actions>
                    <!-- <v-btn d-inline>Voir plus</v-btn> -->
                  </v-card-actions>
                </v-card>
              </v-hover>
            </v-col>
          </template>
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
    Mark,
  },

  data: () => ({
    articles: [],
    photo: [],
    transparent: "rgba(255, 255, 255, 0)",
  }),

  methods: {
    articleDisplay() {
      apiServices.get("/api/articles").then(({ data }) => {
        data.data.forEach((_data) => {
          this.articles.push(_data);
          console.log(this.articles);
        });
      });
    },
  },

  created() {
    this.articleDisplay();
  },
};
</script>    

<style scoped>
.v-card {
  transition: opacity 0.4s ease-in-out;
}

.v-card:not(.on-hover) {
  opacity: 0.6;
}

.show-btns {
  color: rgba(255, 255, 255, 0.281) !important;
}
</style>