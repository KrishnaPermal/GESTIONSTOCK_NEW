import { basketService } from "../../_services/basket.service";
import { apiServices } from "../../_services/api.services";
import { VStripeCard } from "v-stripe-elements/lib";

export default {
  components: {
    VStripeCard,
  },

  data() {
    return {
      apiKey:
        "pk_test_51GubhuEJzq6c1uiqcKECJgrxSg2tEilK4uWtvwztd6ZxVXFraX8ZlPg3i2nVebTWq3O3SA1sNHpnpZxxcb9Xwehl00UZiqQsKD",
      e1: 1,
      valid: true,
      panel: [0],
      source: null,
      valid: true,
      priceTotal: [],
      order: {
        orderList: {},
        adresseFacturation: {
          name: "",
          firstname: "",
          city: "",
          postal_code: "",
          country: "",
          address: "",
          phone: "",
        },
      },
      rules: [(value) => !!value || "Required."],
      selectable: false,
      hidden: true,
      orderId: "",
      status: "",
      prixFinal: "",
    };
  },

  created() {
    this.getOrder();
  },
  methods: {
    getOrder() {
      this.order.orderList = basketService.getBasket();
    },
    sendOrder() {
      basketService.sendOrder(this.order).then((response) => {
        this.orderId = response.data[0].id;
        console.log(response);
        this.prixFinal = response.data.prix;
      });
      this.e1 = 3;
    },
    process() {
      console.log(this.orderId);
      apiServices
        .post("/api/commandes/" + this.orderId + "/payment", {
          id: this.source.id,
          prix: this.prixFinal,
        })
        .then((response) => {
          console.log(response);
        });

      /*  this.order.paiement = this.source
                basketService.sendOrder(this.order)
                console.log( VStripeCard)  */
    },
  },
};

//step1: valide sa commande cout total,
//step 2 : moyen de livraison, envoie en bdd -> création commande,
//rajouter une partie status de la commande (payé, pas encore, remboursé),retourne commande -> step 3, step3: id commande + carte  = paiement de la commande youpi ! ! !
