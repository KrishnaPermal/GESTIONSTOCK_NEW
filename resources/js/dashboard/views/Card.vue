<!--Affichage des cartes sur la page accueil-->
<template>
  <v-container>
    <div class="container">
      <div class="row justify-content-center">
        <v-row class="text-center justify-center py-5">
            <h1 class="font-weight-bold display-2 ">LISTES DES CONFITURES</h1>
        </v-row>
            <v-row>

<!--Autocomplete-->
              <v-col cols="12" sm="12" md="12">
                <v-autocomplete
                  v-model="fruits"
                  :loading="loading"
                  :items="fruitList"
                  item-value="name"
                  :search-input.sync="search"
                  item-text="name"
                  return-object
                  multiple
                  cache-items
                  hide-no-data
                  hide-details
                  label="Recherche par Fruit"
                  @change="filterFruit"
                >
                  <template v-slot:prepend>
                    <v-btn icon color="success" :disabled="fruits.length == 0">
                      <v-icon>mdi-plus-circle</v-icon>
                    </v-btn>
                  </template>
                </v-autocomplete>
              </v-col>
<!--Autocomplete-->

<!--Carte-->
      <v-card v-for="(produit,key) in produitsDisplay" :key="key" class="mx-auto my-5" max-width="500">
        <v-container fluid>
          <v-row dense>
            <v-col class="md-4">
              <v-img
                :src="produit.photo.photo"
                class="white--text align-end"
                gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                height="200px"
              ></v-img>
              <v-card-actions>
                <v-card-title>{{produit.name}}</v-card-title>
                <v-card-subtitle>Liste de Fruits: {{displayFruits(produit.fruits)}}</v-card-subtitle>
                <v-card-subtitle>Prix: {{produit.price}} €</v-card-subtitle>
                <v-spacer />
              </v-card-actions>
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