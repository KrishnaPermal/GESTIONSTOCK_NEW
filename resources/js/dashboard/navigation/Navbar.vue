<template>
  <div>

<!--  Navbar -->
    <v-app-bar color="cyan darken-1" dense dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
     <v-toolbar-title>
          <h1>CONFIPEI</h1>
      </v-toolbar-title>
      <v-spacer></v-spacer>
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

      </v-list>
    </v-navigation-drawer>
<!-- Navigation vertical -->
  </div>
</template>


<script>
export default {
  data() {
    return {
      drawer: null,
      items: [
        { title: "Accueil", icon: "mdi-home" },
        { title: "Dashboard", icon: "mdi-view-dashboard" },
        { title: "Confitures", icon: "mdi-shopping" },
      ]
    };
  }
};
</script>

