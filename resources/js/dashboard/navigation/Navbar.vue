<template>
  <div>

<!--  Navbar -->
    <v-app-bar color="cyan darken-1" dark fullscreen>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
     <v-toolbar-title>
          <h1 class="headline font-weight-medium d-inline">S.N & INFORMATIQUE</h1>
      </v-toolbar-title>
       <v-spacer></v-spacer>

       <v-toolbar-items>
          <Menu></Menu>
         </v-toolbar-items>    

       <!--ajout component Panier-->
        <!--<Panier></Panier>-->
      <!--ajout component Panier--> 
    </v-app-bar>

     <v-divider></v-divider>

 <!-- Navigation vertical -->
    <v-navigation-drawer v-model="drawer" absolute temporary>
     <v-img :aspect-ratio="16/9" src="https://www.universite-rose-croix.org/wp-content/uploads/2018/12/video-informatique-et-spiritualit%C3%A9.jpg"></v-img>
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

         <v-list-item link>
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

         <v-list-item link>
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
import { authenticationService } from '../_services/authentication.service';
import Panier from '../views/components/Panier.vue';
import { Role } from '../_helpers/role'; 
import router from '../routes';
import Menu from './menu.vue';
export default {

  components:{
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
        { title: "Articles", icon: "mdi-shopping" },
        { title: "Fournisseurs", icon: "mdi-account" },
        { title: "Login", icon: "mdi-login-variant" },
        { title: "Inscription", icon: "mdi-account-plus"},
      ], 
    };
  },
   computed: {
    isAdmin() {
      return this.currentUser && this.currentUser.role.role === Role.Admin;
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