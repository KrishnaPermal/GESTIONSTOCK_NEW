<template>
<div>

    <v-card-title class="text-center justify-center py-6">
      <h1 class="font-italic font-weight-bold display-1 cyan--text">GESTION DE STOCK</h1>
    </v-card-title>
    

    <template>
    <v-carousel>
        <v-carousel-item
        v-for="(article,i) in articlesDisplay"
        :key="i"
        :src="article.photo.photo" :aspect-ratio="1.7"
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
        articles: [],
        photo: [],
        articlesDisplay: [],
    }),
    

    methods: {
        articleDisplay() {
            Axios.get('/api/articles')
                .then(({ data }) => {
                    data.data.forEach(_article => {
                        this.articles.push(_article)
                    })
                })
            this.articlesDisplay = this.articles;
        }, 
    },

    

    created() {
        this.articleDisplay();
    }
}

</script>    

