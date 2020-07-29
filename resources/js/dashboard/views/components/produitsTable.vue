<template>
  <v-container>
    <v-data-table :headers="headers" :items="articles" class="elevation-1" :items-per-page="5">
      <template v-slot:top>
        <v-card>
          <v-card-title class="text-center justify-center py-4">
            <h1 class="font-weight-bold display-2 basil--text" color="basil">Gestion des Stocks</h1>
          </v-card-title>
        </v-card>
        <v-spacer></v-spacer>
        <v-divider></v-divider>
        <addArticle v-on:addArticles="articles.push($event)" />
      </template>
      <template v-slot:item.photo="{ item }">
        <v-responsive>
          <v-img :src="item.photo" aspect-ratio="1.7" contain></v-img>
        </v-responsive>
      </template>
      <template v-slot:item.article="{ item }">{{item.mark}}</template>
      <template v-slot:item.categorie="{ item }">{{(item.categorie.name)}}</template>
      <template v-slot:item.price="{ item }">{{item.price}}</template>
      <template v-slot:item.quantity="{ item }">{{item.quantity}}</template>
      <!-- <template v-slot:item.quantity="{ item }">
        <v-text-field type="number" outlined :value="item.quantity" />
      </template>-->
      <template v-slot:item.id_fournisseur="{ item }">{{item.fournisseur.name}}</template>
      <template v-slot:item.actions="{ item }">
        <addArticle :article="item" :articles="articles" :isModification="true"></addArticle>
        <delete :article="item" :articles="articles"></delete>
      </template>
    </v-data-table>
  </v-container>
</template>

<script src="./produitsTable.js"/>