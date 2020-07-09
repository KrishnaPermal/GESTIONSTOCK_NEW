<template>
  <v-container>
              <v-row class="text-center justify-center py-2">
                  <h1 class="font-weight-regular display-2 ">Mes Commandes</h1>
              </v-row>

    <v-row>


    <v-col cols="12" md="6">

            <div class="text-center justify-center py-9 font-weight-regular display-1">
                {{undefinedPanier}}
            </div>
    </v-col>

    <v-col cols="12" md="6">

            <v-img 
            src="https://faitcheznous.ca/wp-content/themes/une_boutique_fait/images/cart-empty.png"  
            aspect-ratio="1.7" 
            contain
            height="200px"
            >
            </v-img>

    </v-col>
    </v-row>

    

     
    <v-row dense v-for="(article,key) in basket" :key="key" cols="6">
      <v-col>
        <v-card>
          <div class="d-flex justify-space-between">
            <div>
              <v-card-title class="headline" v-text="article.mark"></v-card-title>
              <v-card-subtitle v-text="'Prix:'+article.price">€</v-card-subtitle>
              <v-card-subtitle v-text="'Nombre de produit:'+article.quantity"></v-card-subtitle>
              <v-card-subtitle v-text="'Total:'+article.price * article.quantity"></v-card-subtitle>
            </div>

            <div>
              <v-card-actions>
                <v-text-field
                  type="number"
                  v-model="article.quantity"
                  @input="updateQuantity(article)"
                ></v-text-field>
              </v-card-actions>
            </div>
          </div>
        </v-card>
      </v-col>
    </v-row>
    <v-btn @click="sendOrder()" v-if='undefinedPanier == ""'>Passer la commande</v-btn>
  </v-container>
</template>
<script src="./BasketOrder.js"/>