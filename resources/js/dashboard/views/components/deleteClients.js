import { apiServices } from "../../_services/api.services";
export default {
  props: {
    clients: {
      default: function() {
        return {};
      },
    },
    client: {
      default: function() {
        return {};
      },
    },
  },

  data() {
    return {
      dialog: false,
    };
  },
  methods: {
    supprimer(item) {
      const index = this.clients.indexOf(item);
      //console.log(this.client.id);
      apiServices.delete("/api/" + this.client.id + "/client")
        .then(this.clients.splice(index, 1));
    },
  },
};
