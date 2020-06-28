<template>
<div class="d-inline">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }" class="d-inline">
        <div class="text-center">
        <v-btn v-if="!isModification" color="light-blue lighten-3" class="ma-2" dark small rounded v-on="on">
          <v-icon>mdi-plus</v-icon>Ajouter un article
        </v-btn>
        </div>
        <v-btn @click="modifierArticle(articles)" v-if="isModification" class="ma-2" color="light-blue lighten-3" dark small rounded v-on="on">
          <v-icon center>mdi-pencil</v-icon>
        </v-btn>     
      </template>

      <v-card>
        <v-card-title>
          <span v-if="!isModification" class="headline">Ajouter un article</span>
          <span v-if="isModification"  class="headline">Modifier l'article</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-spacer></v-spacer>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-text-field color="light-blue lighten-4" 
                v-model="article"
                :rules="articleRules" 
                label="Marque*" 
                required>
                </v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4" v-if="!isFournisseur"> <!--si fournisseur affiche pas le select grâce au v-if-->
                <v-select
                  :items="fournisseurs"
                  item-value="id"
                  v-model="id_fournisseur"
                  :rules="id_fournisseurRules" 
                  item-text="name"
                  label="Fournisseur"
                  required
                ></v-select>

              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field color="light-blue lighten-4" v-model="price" :rules="priceRules"  label="Prix*" required></v-text-field>
              </v-col>
               <v-col cols="12" sm="6" md="4">
                <v-text-field color="light-blue lighten-4" v-model="article_ref" :rules="article_refRules"  label="article_ref*" required></v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                 <v-textarea   
                  filled
                  name="input-7-4"
                  color="light-blue lighten-4"
                  v-model="description"
                  :rules="descriptionRules" 
                  label="description*" required 
                ></v-textarea>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  color="light-blue lighten-4"
                  v-model="quantity"
                  :rules="quantityRules" 
                  label="Quantité*"
                  required
                ></v-text-field>
              </v-col>

            <!--autocomplete-->
              <v-col cols="12" sm="6" md="6">
                <v-autocomplete
                  v-model="categories" 
                  :loading="loading"
                  :items="categoryList"
                  :search-input.sync="search"
                  item-text="name"
                  @input="createCategorie"
                  return-object
                  multiple
                  cache-items
                  hide-no-data
                  hide-details
                  placeholder="Categories*"
                  label="Categorie"
                >
                  <template v-slot:prepend>
                    <v-btn icon color="success" :disabled="categories.length == 0">
                      <v-icon>mdi-plus-circle</v-icon>
                    </v-btn>
                  </template>
                </v-autocomplete>
              </v-col>
              <v-col cols="12" sm="6" md="12">
                  <v-file-input v-on:change="onFileChange"></v-file-input>
                </v-col>
                <v-img :src="article.photo" aspect-ratio="1.9"></v-img>
             <!--autocomplete-->
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
    <v-snackbar v-model="snackbar" :timeout="timeout">{{ text }}<v-btn color="cyan" text @click="snackbar=false">Close</v-btn></v-snackbar>
  </div>
</template>
<script src="./addArticle.js">



