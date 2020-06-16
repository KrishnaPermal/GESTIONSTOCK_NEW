<template>
  <v-sheet
    class="mx-auto"
    max-width="700"
  >
    <v-slide-group multiple show-arrows>
      <v-slide-item
        v-for="n in mark"
        :key="n"
        
      >
      <v-img
      :src="n.src" aspect-ratio="1.5"
      >
      </v-img>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script src="./Mark.js"/>