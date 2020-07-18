<template>
  <v-container>
    <v-data-table :headers="headers" :items="clients" class="elevation-1" :items-per-page="5">
      <template v-slot:top>
        <v-card>
          <v-card-title class="text-center justify-center py-4">
            <h1 class="font-weight-bold display-2 basil--text" color="basil">Gestion des Clients</h1>
          </v-card-title>
        </v-card>
        <v-spacer></v-spacer>
        <v-divider></v-divider>
      </template>
    </v-data-table>
  </v-container>
</template>

<script src="./clientsTable.js" />
