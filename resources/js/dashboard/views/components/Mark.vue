<template>
  <v-sheet class="mx-auto" max-width="800">
    <v-slide-group multiple show-arrows>
      <v-slide-item v-for="(_mark, n) in mark" :key="n">
        <v-img :src="_mark.src" aspect-ratio="1.5"></v-img>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script src="./Mark.js"/>