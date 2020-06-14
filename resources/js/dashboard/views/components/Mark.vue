<template>
  <v-sheet
    class="mx-auto"
    max-width="700"
  >
    <v-slide-group multiple show-arrows>
      <v-slide-item
        v-for="n in mark"
        :key="n"
        v-slot:default="{ active, toggle }"
        
      >
        <v-btn
          class="mx-2"
          :input-value="active"
          active-class="purple white--text"
          depressed
          rounded
          @click="toggle"
        >
         {{ n }}
        </v-btn>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script src="./Mark.js"/>