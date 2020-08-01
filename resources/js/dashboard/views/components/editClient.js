import { apiServices } from "../../_services/api.services";

export default {

  props: {
    client: {
      default: function() {
        return {};
      },
    },
    isModification: {
      default: false,
    },
  },

  data() {
    return {
      dialog: false,
      champ_client: '',
      email: '',
      timeout: 3000,
      snackbar: false,
      text:'',
      id: ''
    };
  },
  methods: {
    add() {
      apiServices.post('/api/clients', {name: this.champ_client, email: this.email, id: this.id}).then(({data}) => {
        this.dialog = false;
        this.$emit('modifClient', data)
        this.snackbar = true;
        this.text = 'Le client a bien été modifier'
      })
    },

    modifier(item) {
      this.champ_client = item.name
      this.email = item.email
      this.id = item.id

      
    },
  },
};
