<template>
<v-menu offset-y open-on-hover :close-on-content-click="false">
    <template v-slot:activator='{on}'>
    <v-btn v-on="on">
        <v-badge color="red" :content="quantity" >
            <v-icon>mdi-cart</v-icon>
        </v-badge>
    </v-btn>
    </template>
    <v-list>
        <v-list-item v-for="(produit, key) in itemPanier" :key='key'>
            <v-list-item-title>
               <v-card>
    <div class="d-flex flex-no-wrap justify-space-between">
              <v-card-title class="headline">{{produit.name}}</v-card-title>
            </div>
            <v-card-subtitle>
              <v-text-field
                type="number"
                min="0"
                v-model="produit.quantite">
         </v-text-field>
          </v-card-subtitle>

                </v-card>

            </v-list-item-title>
        </v-list-item>
    </v-list>
</v-menu>
</template>

<script src="./Panier.js"></script>


   