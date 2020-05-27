<template>
<div>

    <v-card-title class="text-center justify-center py-6">
      <h1 class="font-italic font-weight-bold display-1 cyan--text">BIENVENUE SUR NOTRE SITE</h1>
    </v-card-title>
    

    <template>
    <v-carousel>
        <v-carousel-item
        v-for="(produit,i) in produitsDisplay"
        :key="i"
        :src="produit.photo.photo" :aspect-ratio="1.7"
        reverse-transition="fade-transition"
        transition="fade-transition"
        ></v-carousel-item>
    </v-carousel>
    </template>

</div>
</template>

<script>
 
import Axios from 'axios';

export default {
   
    data:() => ({
        produits: [],
        photo: [],
        produitsDisplay: [],
    }),
    

    methods: {
        produitDisplay() {
            Axios.get('/api/produits')
                .then(({ data }) => {
                    data.data.forEach(_produit => {
                        this.produits.push(_produit)
                    })
                })
            this.produitsDisplay = this.produits;
        }, 
    },

    

    created() {
        this.produitDisplay();
    }
}

</script>    

