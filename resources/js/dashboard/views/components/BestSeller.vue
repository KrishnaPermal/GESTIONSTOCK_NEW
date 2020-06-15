<template>
  <v-sheet
    class="mx-auto"
   
  >
    <v-slide-group
      v-model="model"
      class="pa-4"
      prev-icon="mdi-arrow-left-drop-circle-outline"
      next-icon="mdi-arrow-right-drop-circle-outline"
      show-arrows
    >
      <v-slide-item
        v-for="(n,key) in articlesDisplay"
        :key="key" 
        v-slot:default="{toggle}"
      >
        <v-card 
          class="ma-5"
          height="200"
          width="200"
          @click="toggle"
          
        >
          <v-row
            class="fill-height"
            align="center"
            justify="center"
          >
          <v-img
          :src="n.photo"
          class="white--text align-end"
          gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
          height="200px"
          ></v-img>
          <p>{{n.mark}} {{n.price}} €</p>
          </v-row>
        </v-card>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script src="./BestSeller.js"/>
