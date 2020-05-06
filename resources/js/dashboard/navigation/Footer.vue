
<template>
  <v-footer dark padless
  >
    <v-card
      class="flex"
      flat
      tile
    >
      <v-card-title class=" py-5 cyan lighten-2 text-center">
        <strong class="subheading">Connectez-vous avec nous sur les réseaux sociaux!</strong>

        <v-spacer></v-spacer>

        <v-btn
          v-for="icon in icons"
          :key="icon"
          class="mx-4"
          dark
          icon
        >
          <v-icon size="25px">{{ icon }}</v-icon>
        </v-btn>
      </v-card-title>

      <v-card-text class="py-3 white--text text-center">
        {{ new Date().getFullYear() }} — <strong>© S.N.INFORMATIQUE : By KRISHNA</strong>
      </v-card-text>
    </v-card>
  </v-footer>
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
