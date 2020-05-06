
<template>
  <v-footer dark padless>
    <v-card class="flex" flat tile>
      
      <v-card-text class="py-3 white--text text-center">
        {{ new Date().getFullYear() }} — <strong>© CONFIPEI : By KRISHNA</strong>
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