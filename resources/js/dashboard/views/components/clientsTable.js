import { apiServices } from "../../_services/api.services";
import editClient from "./editClient.vue";
import Delete from "../components/deleteClients.vue";

export default {
  components: {
    editClient,
    Delete,
  },

  data() {
    return {
      clients: [],
      headers: [
        {
          text: "Clients",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "email", value: "email" },
        { text: "Actions", value: "actions" },
      ],
    };
  },

  created() {
    this.getClients();
  },
  methods: {
    getClients() {
      apiServices.get("/api/clients").then(({ data }) => {
        data.data.forEach((_clients) => {
          this.clients.push(_clients);
        });
      });
    },
  },
};
