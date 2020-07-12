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
          <v-card
            v-for="(article,key) in articlesDisplay"
            :key="key"
            class="mx-2 my-4 d-flex py-2" 
            max-width="300" 
          >
            <v-container fluid>
              <v-row dense>
                <v-col class="md-4">
                  
                  <v-responsive>
                    <v-img
                    :src="article.photo"
                    class="white--text align-end"
                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                    height="200px"
                  ></v-img>
                  </v-responsive>
                  <v-card-actions>
                    <v-card-title>{{article.mark}}</v-card-title>
                    <v-card-subtitle>Categorie: {{displayCategories(article.categories)}}</v-card-subtitle>
                    <v-card-subtitle>Prix: {{article.price}} €</v-card-subtitle>
                    <v-spacer />
                  </v-card-actions>
                  <!--ajout component addPanier-->
                  <addPanier :article="article"></addPanier>
                  <!--ajout component addPanier-->
                </v-col>
              </v-row>
              <v-row></v-row>
            </v-container>
          </v-card>
          <!--Carte-->
        </v-row>
      </div>
    </div>
  </v-container>
</template>

<script src="./Card.js"></script>