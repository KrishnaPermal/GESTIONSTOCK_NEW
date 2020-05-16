<template>
<v-row>
  <v-dialog v-model="dialog" persistent max-width="600px">

  
    <template v-slot:activator="{ on }">
      <v-btn color="light-blue lighten-3" dark small v-on="on">
        <v-icon>mdi-plus</v-icon>Ajouter un produit
      </v-btn>
    </template>

    <v-card>
      <v-card-title>
        <span class="headline">Ajouter</span> 
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-spacer></v-spacer>
          <v-row>
            <v-col cols="12" sm="6" md="4">
              <v-text-field color="light-blue lighten-4"  v-model="produit" label="Nom*" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-select :items="producteurs" item-value="id" v-model="id_producteur" item-text="name" label="Producteur*"></v-select>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field color="light-blue lighten-4"  v-model="price" label="Prix*" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field color="light-blue lighten-4"  v-model="quantity" label="Quantité*" required></v-text-field>
            </v-col>
            
            <!-- <v-col cols="12" sm="6" md="6">
              <v-autocomplete v-model="fruits" :loading="loading" :items="Listfruit" :search-input.sync="search" item-text="name"
                @input="createFruit" return-object multiple cache-items hide-no-data hide-details placeholder="Fruits*" label="Fruit">
                <template v-slot:prepend>
                  <v-btn icon color="success" :disabled="fruits.length == 0">
                    <v-icon>mdi-plus-circle</v-icon>
                  </v-btn>
                </template>
              </v-autocomplete>
            </v-col> -->
          </v-row>
        </v-container>
        <small>*Champ obligatoire</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red" text @click="dialog = false">Fermer</v-btn>
        <v-btn color="green" text @click="dialog = false, addDatas()">Enregistrer</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
  <v-snackbar v-model="snackbar">{{ text }} <v-btn color="cyan" text @click="snackbar=false">Fermer</v-btn></v-snackbar>

  </v-row>
</template>
<script src="./addProduit.js">



