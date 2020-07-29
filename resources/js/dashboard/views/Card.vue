<!--Affichage des cartes sur la page accueil-->
<template>
  <v-container>
    <div class="container">
      <v-row class="text-center justify-center py-5">
        <h1 class="font-weight-bold display-2">Informatique & High-Tech</h1>
      </v-row>
      <p class="text-center">
        <i>Listes des Articles</i>
      </p>
      <div class="row justify-content-center">
        <v-row>
          <!--Autocomplete-->
          <v-col cols="12" sm="12" md="12">
            <v-autocomplete
              v-model="categories"
              :loading="loading"
              :items="categoryList"
              item-value="mark"
              :search-input.sync="search"
              item-text="mark"
              return-object
              multiple
              cache-items
              hide-no-data
              hide-details
              label="Recherche par Categorie"
              @change="filterCategorie"
            >
              <template v-slot:prepend>
                <v-btn icon color="success" :disabled="categories.length == 0">
                  <v-icon>mdi-plus-circle</v-icon>
                </v-btn>
              </template>
            </v-autocomplete>
          </v-col>
          <!--Autocomplete-->

          <!--Carte-->
          <v-container>
            <v-row dense class="justify-center">
              <template v-for="(article,key) in articlesDisplay">
                <v-col :key="key" cols="8" md="3">
                  <v-hover v-slot:default="{ hover }">
                    <v-card
                      :elevation="hover ? 12 : 2"
                      :class="{ 'on-hover': hover }"
                      :key="key"
                      class="mx-2 my-4"
                    >
                      <v-responsive>
                        <v-img
                          :aspect-ratio="16/9"
                          :src="article.photo"
                          class="white--text align-end"
                          gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                        >
                          <v-card-title>{{article.mark}}</v-card-title>
                        </v-img>
                      </v-responsive>
                      <v-card-actions>
                        <v-card-subtitle>Categorie: {{article.categorie.name}}</v-card-subtitle>
                        <v-card-subtitle>Prix: {{article.price}} €</v-card-subtitle>
                        <v-spacer />
                      </v-card-actions>

                      <!--Rating-->
                      <v-row justify="center">
                        <v-rating
                          v-model="rating"
                          background-color="white"
                          color="yellow accent-4"
                          dense
                          half-increments
                          hover
                          size="18"
                        ></v-rating>
                      </v-row>
                      <!--Rating-->

                      <!--ajout component addPanier-->
                      <addPanier :article="article"></addPanier>
                      <!--ajout component addPanier-->
                    </v-card>
                  </v-hover>
                </v-col>
              </template>
            </v-row>
          </v-container>
          <!--Carte-->
        </v-row>
      </div>
    </div>
  </v-container>
</template>

<script src="./Card.js"></script>