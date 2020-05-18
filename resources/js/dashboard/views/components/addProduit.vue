<template>
  <v-row>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-btn color="light-blue lighten-3" dark small v-on="on">
          <v-icon v-if="!isModification">mdi-plus</v-icon>
          <v-icon v-if="isModification" @click="modifierProduit(product)">mdi-pencil</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title>
          <span v-if="!isModification" class="headline">Ajouter</span>
          <span v-if="isModification" class="headline">Modifier</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-spacer></v-spacer>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-text-field color="light-blue lighten-4" 
                v-model="produit" 
                label="Nom*" 
                required>
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-select
                  :items="producteurs"
                  item-value="id"
                  v-model="id_producteur"
                  item-text="name"
                  label="Producteur*"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field color="light-blue lighten-4" v-model="price" label="Prix*" required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  color="light-blue lighten-4"
                  v-model="quantity"
                  label="Quantité*"
                  required
                ></v-text-field>
              </v-col>

          <!--autocomplete-->
              <v-col cols="12" sm="6" md="6">
                <v-autocomplete
                  v-model="fruits"
                  :loading="loading"
                  :items="fruitList"
                  :search-input.sync="search"
                  item-text="name"
                  @input="createFruit"
                  return-object
                  multiple
                  cache-items
                  hide-no-data
                  hide-details
                  placeholder="Fruits*"
                  label="Fruit"
                >
                  <template v-slot:prepend>
                    <v-btn icon color="success" :disabled="fruits.length == 0">
                      <v-icon>mdi-plus-circle</v-icon>
                    </v-btn>
                  </template>
                </v-autocomplete>
              </v-col>
          <!--autocomplete-->

            <!--upload-->
              <v-col cols="12" sm="7" md="7">
                <v-file-input
                  v-model="image"
                  color="deep-purple accent-4"
                  counter
                  label="File input"
                  multiple
                  placeholder="Select your files"
                  prepend-icon="mdi-paperclip"
                  outlined
                  :show-size="1000"
              >
                  <template v-slot:selection="{ index, text }">
                    <v-chip v-if="index < 2" color="deep-purple accent-4" dark label small>
                        {{ text }}
                    </v-chip>
                      <span v-else-if="index === 2" class="overline grey--text text--darken-3 mx-2">
                        +{{ image.length - 2 }} File(s)
                      </span>
                  </template>
                </v-file-input>
              </v-col> 
            <!--upload-->
            </v-row>
          </v-container>
          <small>*Champ obligatoire</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red" text @click="dialog=false">Fermer</v-btn>
          <v-btn color="green" text @click="dialog=false, addDatas()">Enregistrer</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- <v-snackbar v-model="snackbar">{{ text }} <v-btn color="cyan" text @click="snackbar=false">Fermer</v-btn></v-snackbar> -->
  </v-row>
</template>
<script src="./addProduit.js">



