<template>
    <v-data-table :headers="headers" :items="products" class="elevation-1" :items-per-page="50">
      <template v-slot:top>
        

<v-card color="basil">
    <v-card-title class="text-center justify-center py-4">
      <h1 class="font-weight-bold display-2 basil--text">LISTES DES CONFITURES</h1>
    </v-card-title>
  </v-card>

<v-toolbar
    dark
    color="teal"
  >
    <v-toolbar-title>State selection</v-toolbar-title>
    <v-autocomplete
      v-model="select"
      :loading="loading"
      :items="items"
      :search-input.sync="search"
      cache-items
      class="mx-4"
      flat
      hide-no-data
      hide-details
      label="What state are you from?"
      solo-inverted
    ></v-autocomplete>
    <v-btn icon>
      <v-icon>mdi-dots-vertical</v-icon>
    </v-btn>
  </v-toolbar>

<v-spacer></v-spacer>
<v-divider></v-divider>

        <v-toolbar flat color="blue-grey lighten-4">
          <v-spacer></v-spacer>
          <addProduit v-on:addProduit="products.push($event)"/>
        </v-toolbar>
      </template>
      <template v-slot:item.produit="{ item }">{{item.name}},</template>
      <template v-slot:item.fruits="{ item }">{{displayFruits(item.fruits)}}</template>
      <template v-slot:item.price="{ item }">{{item.price}}</template>
      <template v-slot:item.producteur="{ item }">{{item.id_producteur.name}},</template>
      
    </v-data-table>
</template>
<script src="./Dashboard.js"/>