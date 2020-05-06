<template>
  <div>
    <v-carousel v-model="model">
      <v-carousel-item v-for="(color, i) in colors" :key="color">
        <v-sheet :color="color" height="100%" tile>
          <v-row class="fill-height" align="center" justify="center">
            <div class="display-3">TOTO EST À L'ACCUEIL {{ i + 1 }}</div>
          </v-row>
        </v-sheet>
      </v-carousel-item>
    </v-carousel>
  </div>
</template>


<script>
  export default {
    data () {
      return {
        colors: [
          'secondary',
          'secondary',
          'secondary',
        ],
        model: 0,
      }
    },
  }
</script>