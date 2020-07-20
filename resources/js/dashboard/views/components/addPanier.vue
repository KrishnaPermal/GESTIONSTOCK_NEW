<template>
  <v-row justify="center">
    <v-col cols="6" sm="6" md="10">
      <v-text-field
        type="number"
        min="0"
        v-model="quantity"
        :max="article.quantity"
        label="Quantité"
        filled
        dense
        required
        :hint="article.quantity<5 ? 'Quantité restante: '+article.quantity : ''"
        :persistent-hint="article.quantity<5"
        :disabled="article.quantity.quantity==0"
        :error-messages="article.quantity==0 ? 'Stock épuisé' : ''"
      ></v-text-field>
    </v-col>
    

    <v-col class="text-center" cols="12" sm="4">
      <v-flex class="justify-center">
        <v-btn :disabled="quantity==0" @click="add" small rounded>
          <v-icon>mdi-cart</v-icon>
        </v-btn>
      </v-flex>
    </v-col>
  </v-row>
</template>

<script src="./addPanier.js"></script>

