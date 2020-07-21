<template>
  <v-sheet class="mx-auto">
    <v-slide-group
      v-model="model"
      class="pa-4"
      prev-icon="mdi-arrow-left-drop-circle-outline"
      next-icon="mdi-arrow-right-drop-circle-outline"
      show-arrows
      style="background-color: #E1F5FE;"
      width="800"
      height="200"
    >
      <v-slide-item v-for="(article,key) in articlesDisplay" :key="key" v-slot:default="{toggle}">
        <v-card class="ma-5" height="200" width="200" @click="toggle">
          <v-row class="fill-height" align="center" justify="center">
            <v-img
              :aspect-ratio="16/9"
              :src="article.photo"
              class="white--text align-end"
              gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
              height="200px"
            >
            <v-spacer></v-spacer>
            <v-card-title><p class="text-center justify-center py-6">{{article.mark}}</p></v-card-title>
            <v-card-text><p>Prix:{{article.price}}€</p></v-card-text>
            </v-img>
          </v-row>
        </v-card>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script src="./BestSeller.js"/>
