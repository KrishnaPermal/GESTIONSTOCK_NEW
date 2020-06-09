<template>
  <div>
  <v-footer dark padless
  >
    <v-card
      class="flex cyan darken-2 white--text text-center"
      flat
      tile
    >
    <v-divider></v-divider>

   
      <v-card-text class=" py-5 flex grey darken-3">
        <v-btn
          v-for="icon in icons"
          :key="icon"
          class="mx-2 white--text"
          icon>
          <v-icon size="24px">{{ icon }}</v-icon>
        </v-btn>
      </v-card-text>

      <v-divider></v-divider>


      <v-card-text class="py-2 flex white--text text-center">
        {{ new Date().getFullYear() }} — <strong>© S.N.INFORMATIQUE : By KRISHNA</strong>
      </v-card-text>
      
    </v-card>
  </v-footer>
  </div>
</template>

<script>
  export default {
    data: () => ({
      icons: [
        'mdi-facebook',
        'mdi-instagram',
      ],
       
    }),
  }
</script>
