import Axios from "axios"
import {apiServices} from '../_services/api.services';


export default {
    data() {
        return {
            producteurs: [],
            headers: [
                {
                    text: 'Clients',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Email', value: 'id_users.email'},
                { text: 'Name', value: 'id_users.name'},  
                { text: 'Actions', value: 'actions'},
            ],
            isModification: true, 
        }
       
    },
    created() {
        this.getClients()
    },
    methods: {
        getClients() {
            apiServices.get('api/clients').then(response => {
                response.data.data.forEach(client => {
                    this.clients.push(client)
                    
                })
            })
        },
    }
}
