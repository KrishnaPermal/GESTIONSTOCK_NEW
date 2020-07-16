<template>
  <v-card>
    <v-toolbar flat color="cyan" dark>
      <v-toolbar-title>Dashboard</v-toolbar-title>
    </v-toolbar>
    <v-tabs horizontal>
      <v-tab>
        <router-link to="/dashboard">
          <v-tab>
            <v-icon left>mdi-cube</v-icon>Gestion des stocks
          </v-tab>
        </router-link>
      </v-tab>
        <v-tab>
        <router-link to="/login">
          <v-tab>
            <v-icon left>mdi-account</v-icon>Gestion des clients
          </v-tab>
        </router-link>
      </v-tab>

      <v-tab-item>
        <v-card flat>
          <v-card-text>
            <router-view></router-view>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs>
  </v-card>
</template>


