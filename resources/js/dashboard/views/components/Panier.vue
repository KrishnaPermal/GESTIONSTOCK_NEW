<!--ICI C'EST LA VUE POUR ICON PANIER ET VOIR LE PANIER-->
<template>
  <v-menu offset-y open-on-hover :close-on-content-click="false">
    <template v-slot:activator="{on}">
      <v-btn v-on="on" icon>
        <v-badge v-if="quantity!=0" color="red" :content="quantity">
          <v-icon>mdi-cart</v-icon>
        </v-badge>
        <v-icon v-else>mdi-cart</v-icon>
      </v-btn>
    </template>
    <v-list>
      <h1>Derniers articles ajoutés :</h1>
      <v-list-item v-for="(article, key) in itemPanier" :key="key">
        <v-list-item-title>
          <v-card>
            <div class="d-flex justify-space-between">
              <v-card-title class="headline">{{article.mark}}</v-card-title>
              <v-card-title class="headline">{{article.price}} €</v-card-title>
              <v-card-title class="headline">{{article.article_ref}}</v-card-title>

            </div>
            <v-card-subtitle>
              <v-col cols="6" sm="6" md="8">
                <v-text-field
                  type="number"
                  min="0"
                  v-model="article.quantity"
                  @input="updateQuantity(article)"
                ></v-text-field>
              </v-col>
            </v-card-subtitle>
          </v-card>
        </v-list-item-title>
      </v-list-item>
      <v-list-item>
        <v-btn to="/basket">Voir le panier</v-btn>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script src="./Panier.js"></script>


   