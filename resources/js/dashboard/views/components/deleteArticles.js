import { apiServices } from '../../_services/api.services';

export default {
    props:['article'],

    data () {
      return {
        dialog: false,
      }
    },
    methods:{
        getId(article){
            //console.log(article)

        },
        delete(){
            //console.log('toto')
            apiServices.delete('/api/articles/'+ this.article.id).then(response =>{
                console.log(response)
            })    
        }
    }
  }