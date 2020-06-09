<template>
    <v-data-table :headers="headers" :items="articles" class="elevation-1" :items-per-page="20">
      <template v-slot:top>
      
<v-card color="basil">
   
    <v-card-title class="text-center justify-center py-4">
      <h1 class="font-weight-bold display-2 basil--text">LISTES DES ARTICLES</h1>
    </v-card-title>
  </v-card>



<v-spacer></v-spacer>
<v-divider></v-divider>

        <v-toolbar flat color="blue-grey lighten-4">
          <v-spacer></v-spacer>

          <!--addProduit-->
          <addArticle v-on:addArticle="articles.push($event)"/>
        </v-toolbar>
      </template>
      <template v-slot:item.article="{ item }">{{item.mark}}</template>
      <template v-slot:item.categories="{ item }">{{displayCategories(item.categories)}}</template>
      <template v-slot:item.price="{ item }">{{item.price}}</template>
      <template v-slot:item.quantite="{ item }">{{item.quantity}}</template>
      <template v-slot:item.id_fournisseur="{ item }">{{item.fournisseur.name}}</template>
      
     <template v-slot:item.photo="{ item }">
       <!--  <v-img :src="'/public/storage/images'+item.id_photo" aspect-ratio="1.9"></v-img> -->
        <v-img :src="item.photo" aspect-ratio="1.7"></v-img> 
      </template> 

      <template v-slot:item.actions="{ item }"><addArticle :product="item" :isModification='true'></addArticle></template>
    </v-data-table>
</template>

<script src="./produitsTable.js"/>