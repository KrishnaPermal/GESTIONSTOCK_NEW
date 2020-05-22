<!--Affichage des cartes sur la page accueil-->
<template>
  <v-container>
    <v-row>

      <!--autocomplete-->
              <v-col cols="12" sm="12" md="12"><br>
                <v-autocomplete
                  v-model="fruits"
                  :loading="loading"
                  :items="fruitList"
                  :search-input.sync="search"
                  item-text="name"
                  multiple
                  cache-items
                  hide-no-data
                  hide-details
                  placeholder="Fruits*"
                  label="Fruit"
                >
                  <template v-slot:prepend>
                    <v-btn icon color="success" :disabled="fruits.length == 0">
                      <v-icon>mdi-plus-circle</v-icon>
                    </v-btn>
                  </template>
                </v-autocomplete>
              </v-col>
          <!--autocomplete-->

      <v-card v-for="(produit,key) in produits" :key="key" class="mx-auto my-5" max-width="500">
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
                <v-card-subtitle>Fruits: {{displayFruits(produit.fruits)}}</v-card-subtitle>
                <v-card-subtitle>Prix: {{produit.price}} €</v-card-subtitle>
                <v-spacer />
                <!--<show v-bind:produit ="produit"></show> -->
              </v-card-actions>
            </v-col>
          </v-row>
          <v-row></v-row>
        </v-container>
      </v-card>
    </v-row>
  </v-container>
</template>

<script src="./Home.js"></script>