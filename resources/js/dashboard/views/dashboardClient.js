
import { authenticationService } from "../_services/authentication.service";
import {apiServices} from '../_services/api.services';
export default {
        data(){
            return{
                user: JSON.parse (authenticationService.getCurrentUser()), // fait référence dans le authenticationservice
                token: this.user.token
            }
        },
        methods:{
            getCurrentUserDB(){
                 apiServices.post('/api/currentUser',token)  //envoie sur une route avec token
                    .then(({ response }) => {
                        console.log(response)
                    })
            },
        },

        created(){
            console.log(this.user.token);
            this.getCurrentUserDB();
        }

}

