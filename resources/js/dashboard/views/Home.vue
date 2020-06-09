<template>
<v-container>
<div>
    <v-card-title class="text-center justify-center py-6">
      <h1 class="font-italic font-weight-bold display-1 cyan--text">GESTION DE STOCK</h1>
    </v-card-title>



    <v-row>
  <div>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum maiores modi quidem veniam, expedita quis laboriosam, ullam facere adipisci, iusto, voluptate sapiente corrupti asperiores rem nemo numquam fuga ab at.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum maiores modi quidem veniam, expedita quis laboriosam, ullam facere adipisci, iusto, voluptate sapiente corrupti asperiores rem nemo numquam fuga ab at.</p>
  </div>
  </v-row>

<v-divider></v-divider>

 <v-subtitle class="text-center">NOS MEILLEURS VENTES</v-subtitle><br>
    <!--Carte-->
    
      <v-card v-for="(article,key) in articlesDisplay" :key="key"  class="mx-auto my-4 d-flex pa-2" max-width="400" >
        <v-container fluid>
          <v-row dense>
            <v-col class="md-4">
              <v-img
                :src="article.photo"
                class="white--text align-end"
                gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                height="200px"
              ></v-img>
            </v-col>
          </v-row>
        </v-container>
      </v-card>

<v-divider></v-divider>
      
  <blockquote class="blockquote">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum maiores modi quidem veniam, expedita quis laboriosam, ullam facere adipisci, iusto, voluptate sapiente corrupti asperiores rem nemo numquam fuga ab at.</blockquote>

     
<!--Carte-->
      </div>
      </v-container>
</template>


    

<script>
import {apiServices} from '../_services/api.services'
//import addPanier from './components/addPanier.vue';
export default {
   
    data:() => ({
        articles: [],
        photo: [],
        articlesDisplay: [],
      
    }),
    
   

    methods: {
        articleDisplay() {
            apiServices.get('/api/articles')
                .then(({ data }) => {
                    data.data.forEach(_data => {
                        this.articles.push(_data)
                    })
                })
            this.articlesDisplay = this.articles;
        },
        
        displayCategories(_categories){
            var categories=[];
            _categories.forEach(_categorie=>{
                categories.push((_categorie.name))
            })
            return categories.join(', ');
        },


    
    },
    

    created() {
        this.articleDisplay();
    }
}


</script>    

