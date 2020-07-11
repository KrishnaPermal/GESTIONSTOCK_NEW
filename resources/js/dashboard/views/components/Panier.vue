<!--ICI C'EST LA VUE POUR ICON PANIER ET VOIR LE PANIER-->
<template>
<v-menu offset-y open-on-hover :close-on-content-click="false">
    <template v-slot:activator='{on}'>
    <v-btn v-on="on" icon>
        <v-badge color="red" :content="quantity" >
            <v-icon>mdi-cart</v-icon>
        </v-badge>
    </v-btn>
    </template>
    <v-list>
        <v-list-item v-for="(article, key) in itemPanier" :key='key'>
            <v-list-item-title>
               <v-card>
            <div class="d-flex flex-no-wrap justify-space-between">
              <v-card-title class="headline">{{article.mark}}</v-card-title>
            </div>
            <v-card-subtitle>
              <v-text-field
                type="number"
                min="0"
                v-model="article.quantity" @input="updateQuantity(article)">
         </v-text-field>
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


   