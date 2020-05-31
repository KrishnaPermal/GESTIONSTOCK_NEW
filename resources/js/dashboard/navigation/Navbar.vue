<template>
  <div>

<!--  Navbar -->
    <v-app-bar color="cyan darken-1" dense dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
     <v-toolbar-title>
          <h1>CONFIPEI</h1>
      </v-toolbar-title>
      <v-spacer></v-spacer>
<!--ajout login a revoir-->
      <v-btn v-if="!ischeck" class="mr-4 deep-orange" to="/login">Log In</v-btn>
      <v-btn v-if="ischeck" class="mr-4 deep-orange" @click="logout">Log Out</v-btn>
<!--ajout login a revoir-->
    </v-app-bar>



     <v-divider></v-divider>

 <!-- Navigation vertical -->
    <v-navigation-drawer v-model="drawer" absolute temporary>
     <v-img :aspect-ratio="16/9" src="https://www.mycuisine.com/wp-content/uploads/2017/06/pots_de_confiture-768x461.jpg"></v-img>
      <v-list-item>
        <v-list-item-content color="black">
          <v-list-item-title class="font-italic">CONFIPEI</v-list-item-title>
          <v-list-item-subtitle class="font-italic">BIENVENUE SUR NOTRE SITE</v-list-item-subtitle>
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
              <router-link :to="{name:'confitures'}">Confitures</router-link>
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
              <router-link :to="{name:'producteur'}">Producteurs</router-link>
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
              <router-link :to="{name:'client'}">Client</router-link>
            </v-list-item-title>
          </v-list-item-content>
         </v-list-item>

<v-divider></v-divider>

         <!-- <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-shopping</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="font-weight-bold">
              <router-link :to="{name:'login'}">Login</router-link>
            </v-list-item-title>
          </v-list-item-content>
         </v-list-item> -->


      </v-list>
    </v-navigation-drawer>
<!-- Navigation vertical -->
  </div>
</template>




<script>
import { authenticationService } from '../../_services/authentication.service';
import router from '../routes'
export default {
  data() {
    return {
      currentUser:null,
      drawer: null,
      items: [
        { title: "Accueil", icon: "mdi-home" },
        { title: "Dashboard", icon: "mdi-view-dashboard" },
        { title: "Confitures", icon: "mdi-shopping" },
        { title: "Producteurs", icon: "mdi-account" },
        { title: "Client", icon: "mdi-account" },
        //{ title: "Login", icon: "mdi-login-variant" },
      ],
      computed:{
        ischeck(){
          return this.currentUser
        }
      },
      methods:{
        logout(){
          authenticationService.logout();
          router.push('/login')
        }
      },
      created(){
        authenticationService.currentUser.subscribe(x => (this.currentUser =x));
      }

      
    };
  }
};
</script>

