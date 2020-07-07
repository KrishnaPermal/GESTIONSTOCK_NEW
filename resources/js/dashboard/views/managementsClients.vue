<template>

 <v-data-table :headers="headers" :items="clients" class="elevation-1" :items-per-page="5">
   <!--   <template v-slot:top>
      <v-card color="basil">
        <v-card-title class="text-center justify-center py-4">
          <h1 class="font-weight-bold display-2 basil--text">LISTES DES CLIENTS</h1>
        </v-card-title>
      </v-card>
        <v-spacer></v-spacer>
          <v-divider></v-divider>
      <v-toolbar flat color="blue-grey lighten-4">Client</v-toolbar>
        <v-spacer></v-spacer>
      <drawerProducteur @update="clients.push($event)" /> -->
    <!-- </template>
    <template v-slot:item.nom="{ item }">{{item.name}},</template>
    <template v-slot:item.email="{ item }">{{item.id_users.email}}</template>
     <template v-slot:item.actions="{ item }">
        <addArticle :client="item" :isModification='true'></addArticle>
        <delete :client="item"></delete>
      </template>--> 
  </v-data-table>   
</template>

<script src="./managementsClients.js"/>