<template>
 <div class="my-auto">
<v-menu offset-y open-on-hover :close-on-content-click="false">
    <template v-slot:activator="{on}">
      <v-btn text small class="mx-2 my-auto" v-on="on" v-if="!isCheck">
        <v-icon>mdi-account</v-icon> Me connecter
      </v-btn>
      <v-btn text small class="mx-2 my-auto" v-on="on" v-if="isCheck">
        <v-icon>mdi-account</v-icon> Se déconnecter
      </v-btn>
    </template>
    <v-list>
      <div class="d-flex flex-no-wrap justify-space-between">
        <v-card-title v-if="isCheck" class="headline">{{currentUser.name}}</v-card-title>
      </div>
      <v-list-item-group>
        <v-btn class="padding d-flex" text block v-if="isCheck" @click="logout()">Déconnexion</v-btn>
        <v-btn class="padding d-flex" text v-if="!isCheck" to="/login">Connexion</v-btn>
      </v-list-item-group>
    </v-list>
  </v-menu>
 </div>
</template>

<script src='./menu.js'></script>