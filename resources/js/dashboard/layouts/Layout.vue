<template>
  <v-app>
    <link
      href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css"
      rel="stylesheet"
    />
    <navbar></navbar>
    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>
    <Snackbar />
    <Footer />
  </v-app>
</template>

<script>
import Navbar from "../navigation/Navbar";
import Footer from "../navigation/Footer";
import Snackbar from "../views/components/Snackbar.vue";
/* import Dashboard from "../navigation/Dashboard"; */
export default {
  components: {
    Navbar,
    Snackbar,
    //Dashboard,
    Footer: Footer
  }
};
</script>