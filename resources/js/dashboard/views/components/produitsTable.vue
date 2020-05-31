<template>
    <v-data-table :headers="headers" :items="produits" class="elevation-1" :items-per-page="20">
      <template v-slot:top>
      
<v-card color="basil">
   
    <v-card-title class="text-center justify-center py-4">
      <h1 class="font-weight-bold display-2 basil--text">LISTES DES CONFITURES</h1>
    </v-card-title>
  </v-card>



<v-spacer></v-spacer>
<v-divider></v-divider>

        <v-toolbar flat color="blue-grey lighten-4">
          <v-spacer></v-spacer>

          <!--addProduit-->
          <addProduit v-on:addProduit="produits.push($event)"/>
        </v-toolbar>
      </template>
      <template v-slot:item.produit="{ item }">{{item.name}}</template>
      <template v-slot:item.fruits="{ item }">{{displayFruits(item.fruits)}}</template>
      <template v-slot:item.prix="{ item }">{{item.price}}</template>
      <template v-slot:item.quantite="{ item }">{{item.quantity}}</template>
      <template v-slot:item.id_producteur="{ item }">{{item.name}}</template>
      
     <template v-slot:item.photo="{ item }">
       <!--  <v-img :src="'/public/storage/images'+item.id_photo" aspect-ratio="1.9"></v-img> -->
        <v-img :src="item.photo" aspect-ratio="1.7"></v-img> 
      </template> 

      <template v-slot:item.actions="{ item }"><addProduit :product="item" :isModification='true'></addProduit></template>
    </v-data-table>
</template>

<script src="./produitsTable.js"/>