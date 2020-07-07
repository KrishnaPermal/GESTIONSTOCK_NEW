import { apiServices } from '../../_services/api.services';

export default {
    props:['article','articles'],

    data () {
      return {
        dialog: false,
      }
    },
    methods:{
        
        supprimer(item){
          const index = this.articles.indexOf(item);
            apiServices.delete('/api/articles/'+ this.article.id).then(
              this.articles.splice(index,1)   
            )    
            this.dialog = false
        }
    }
  }