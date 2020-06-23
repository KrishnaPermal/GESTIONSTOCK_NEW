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
  },

  computed: {
      
    isCheck() {
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