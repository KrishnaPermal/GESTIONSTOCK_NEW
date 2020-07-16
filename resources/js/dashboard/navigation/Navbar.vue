<template>
  <div>
    <!--  Navbar -->
    <v-app-bar color="cyan darken-1" dark fullscreen class="hidden" elevation="0">
      <v-app-bar-nav-icon class="hidden-md-and-up" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class="hidden-md-and-up">
        <h1 class="headline font-weight-medium d-inline">S.N & I</h1>
      </v-toolbar-title>
      <v-toolbar-title class="hidden-sm-and-down">
        <h2 class="headline font-weight-medium d-inline">S.N & INFORMATIQUE</h2>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn text class="nav-item nav-link" to="/">Accueil</v-btn>
        <v-btn v-if="isAdmin" text class="nav-item nav-link" to="/dashboard">Dashboard</v-btn>
        <v-btn v-if="isAdmin || isClient" text class="nav-item nav-link" :to="{name:'articles'}">Articles</v-btn>
        <Menu></Menu>
        <Panier></Panier>
      </v-toolbar-items>

      <!--ajout component Panier-->

      <!--ajout component Panier-->
    </v-app-bar>

    <v-divider></v-divider>

    <!-- Navigation vertical -->
    <v-navigation-drawer overlay-opacity="0.9" v-model="drawer" absolute temporary >
      <v-img
        :aspect-ratio="16/9"
        src="https://www.universite-rose-croix.org/wp-content/uploads/2018/12/video-informatique-et-spiritualit%C3%A9.jpg"
      ></v-img>
      <v-list-item>
        <v-list-item-content color="black">
          <v-list-item-title class="font-italic">S.N&INFORMATIQUE</v-list-item-title>
          <v-list-item-subtitle class="font-italic">GESTION DE STOCK INFORMATIQUE</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list rounded>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="font-weight-bold">
              <router-link :to="{name:'home'}">Accueil</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

         <v-list-item link v-if="isAdmin">
          <v-list-item-icon>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="font-weight-bold">
              <router-link :to="{name:'dashboard'}">Dashboard</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>


        <v-divider></v-divider>

        <v-list-item link v-if="isAdmin || isClient">
          <v-list-item-icon>
            <v-icon>mdi-shopping</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="font-weight-bold">
              <router-link :to="{name:'articles'}">Articles</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-shopping</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="font-weight-bold">
              <router-link :to="{name:'fournisseur'}">Fournisseurs</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item link v-if="isChecked">
          <v-list-item-icon>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="font-weight-bold">
              <a @click="logout" class="nav-item nav-link">Se deconnecter</a>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link v-if="!isChecked">
          <v-list-item-icon>
            <v-icon>mdi-login-variant</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="font-weight-bold">
              <router-link :to="{name:'login'}">Login</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item link v-if="!isChecked" small>
          <v-list-item-icon>
            <v-icon>mdi-account-plus</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="font-weight-bold">
              <router-link :to="{name:'register'}">Inscription</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>
      </v-list>
    </v-navigation-drawer>
    <!-- Navigation vertical -->
  </div>
</template>




<script>
import { authenticationService } from "../_services/authentication.service";
import Panier from "../views/components/Panier.vue";
import { Role } from "../_helpers/role";
import router from "../routes";
import Menu from "./menu.vue";
export default {
  components: {
    Panier,
    Menu
  },

  data() {
    return {
      currentUser: null,
      drawer: null,
      items: [
        { title: "Accueil", icon: "mdi-home" },
        { title: "Dashboard", icon: "mdi-view-dashboard" },
        { title: "Gestion", icon: "mdi-cube"},
        { title: "Articles", icon: "mdi-shopping" },
        { title: "Fournisseurs", icon: "mdi-account" },
        { title: "Login", icon: "mdi-login-variant" },
        { title: "Inscription", icon: "mdi-account-plus" }
      ]
    };
  },
  computed: {
    isAdmin() {
      return this.currentUser && this.currentUser.role.name === "Admin";
    },
     isClient() {
      return this.currentUser && this.currentUser.role.name === "Client";
    
    },
    
    isChecked() {
      return this.currentUser;
    }
  },
  created() {
    authenticationService.currentUser.subscribe(x => (this.currentUser = x));
  },
  methods: {
    logout() {
      authenticationService.logout();
      router.push("/login");
    }
  }
};
</script>