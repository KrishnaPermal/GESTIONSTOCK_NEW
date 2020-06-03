<template>
    <v-row>
        <v-col cols="6">
            <v-text-field type="number" min="0" v-model="quantity"
            label="Nombre" required></v-text-field>
        </v-col>
        <v-col cols="6">
            <v-btn @click="save">AJOUTER</v-btn>
        </v-col>
    </v-row>
</template>

<script src="./addPanier.js"></script>

