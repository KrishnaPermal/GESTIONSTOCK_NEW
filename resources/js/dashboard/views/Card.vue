<!--Affichage des cartes sur la page accueil-->
<template>
  <v-container>
    <div class="container">
      <div class="row justify-content-center">
        <v-row class="text-center justify-center py-5">
          <h1 class="font-weight-bold display-2">LISTES DES ARTICLES</h1>
        </v-row>
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
                          :src="article.photo"
                          class="white--text align-end"
                          gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                        >
                        <v-card-title>{{article.mark}}</v-card-title>
                        </v-img>
                      </v-responsive>
                      <v-card-actions>
                        <v-card-subtitle>Categorie: {{displayCategories(article.categories)}}</v-card-subtitle>
                        <v-card-subtitle>Prix: {{article.price}} €</v-card-subtitle>
                        <v-spacer />
                      </v-card-actions>
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