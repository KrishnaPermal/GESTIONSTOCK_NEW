import { authenticationService } from "../_services/authentication.service";
import router from "../routes.js";

export default {
    data() {
        return {
          currentUser: null,
        };
      },

  created() {
    authenticationService.currentUser.subscribe(x => (this.currentUser = x));
    // faire subscribre sur le eventbus ici
    // faut faire un emit également dans authenticationService
  },

  computed: {
      
    isChecked() {
      return this.currentUser;
    },
  },

  methods: {
    logout() {
      authenticationService.logout();
      router.push("/login");
    }
  },

};