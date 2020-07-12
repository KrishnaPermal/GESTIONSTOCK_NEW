<template>
  <div class="d-inline">
    <v-dialog v-model="dialog" persistent max-width="300" class="d-inline">
      <template v-slot:activator="{ on }" class="d-inline">
        <v-btn
          color="red lighten-2"
          class="ma-2"
          v-on:click="getId(article.id)"
          dark
          small
          icon
          v-on="on"
        >
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>Supprimer l'article ?</v-card-title>
        <v-card-text>Voulez-vous vraiment supprimer l'article ?</v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="supprimer(article)">Valider</v-btn>
          <v-btn color="danger" text @click="dialog=false">Annuler</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script src='./deleteArticles.js'></script>