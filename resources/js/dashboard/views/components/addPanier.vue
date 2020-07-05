<template>
    <v-row>
        <v-col cols="12" sm="6" md="12">
            <v-text-field 
            type="number" 
            min="0" 
            v-model="quantity"
            :max="article.quantity"
            label="Nombre"
            filled
            dense 
            required
            :hint="article.quantity<5 ? 'Quantité restante: '+article.quantity : ''"
            :persistent-hint="article.quantity<5"
            :disabled="article.quantity.quantity==0"
            :error-messages="article.quantity==0 ? 'Stock épuisé' : ''" 
            ></v-text-field>
            <v-btn :disabled="quantity==0" @click="add">
                <v-icon>mdi-plus</v-icon> Ajouter
            </v-btn>
        </v-col>
    </v-row>
</template>

<script src="./addPanier.js"></script>

