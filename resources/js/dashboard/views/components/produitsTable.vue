<template>
    <v-data-table :headers="headers" :items="articles" class="elevation-1" :items-per-page="20">
      <template v-slot:top>
          <addArticle v-on:addArticles="articles.push($event)"/>
      </template>
      <template v-slot:item.article="{ item }">{{item.mark}}</template>
      <template v-slot:item.categories="{ item }">{{displayCategories(item.categories)}}</template>
      <template v-slot:item.price="{ item }">{{item.price}}</template>
      <template v-slot:item.quantite="{ item }">{{item.quantity}}</template>
      <template v-slot:item.id_fournisseur="{ item }">{{item.fournisseur.name}}</template>
      
     <template v-slot:item.photo="{ item }">
        <v-img :src="item.photo" aspect-ratio="1.7"></v-img> 
      </template> 

      <template v-slot:item.actions="{ item }"><addArticle :product="item" :isModification='true'></addArticle></template>
    </v-data-table>
</template>

<script src="./produitsTable.js"/>