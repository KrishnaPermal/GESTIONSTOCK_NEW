import { apiServices } from "../../_services/api.services";

export default {
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
        console.log("tototo");
        console.log(data.data);
        data.data.forEach((_clients) => {
          this.clients.push(_clients);
        });
      });
    },
  },
};
