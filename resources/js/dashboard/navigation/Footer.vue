<template>
  <div>
    <v-footer dark padless>
      <v-card class="flex cyan darken-3 white--text text-center" flat tile>
        <v-divider></v-divider>

        <v-row class="cyan darken-2 white--text text-center">
          <v-col>
            <v-icon>mdi-credit-card</v-icon>Débit à l'expédition
          </v-col>
          <v-col>
            <v-icon>mdi-truck-fast</v-icon>Livraison Express
          </v-col>
          <v-col>
            <v-icon>mdi-map-marker-outline</v-icon>1 Magasin
          </v-col>
          <v-col>
            <v-icon>mdi-credit-card</v-icon>Paiement en 3X
          </v-col>
          <v-col>
            <v-icon>mdi-restore</v-icon>S.A.V
          </v-col>
        </v-row>
 <v-divider></v-divider>
        <v-row dense class="justify-center">
          <v-col cols="12" md="4" class="pa-0">
            <v-card-text class="flex cyan darken-2">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-subtitle>Moyens de paiement acceptées</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>

              <v-btn class="pa-0">
                <v-img
                  src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/Old_Visa_Logo.svg/1200px-Old_Visa_Logo.svg.png"
                  aspect-ratio="1.4"
                ></v-img>
              </v-btn>

              <v-btn class="pa-0">
                <v-img
                  src="https://dashnews.org/wp-content/uploads/2019/05/MasterCard-Pressured-to-Monitor-Far-Right-Payments.jpg"
                  aspect-ratio="1.4"
                ></v-img>
              </v-btn>

              <v-btn class="pa-0">
                <v-img
                  src="https://upload.wikimedia.org/wikipedia/fr/thumb/7/72/Logo_GIE-CB.jpg/1200px-Logo_GIE-CB.jpg"
                  aspect-ratio="1.4"
                ></v-img>
              </v-btn>

              <v-btn class="pa-0">
                <v-img
                  src="https://logo-marque.com/wp-content/uploads/2020/04/PayPal-Logo-2007%E2%80%932014.jpg"
                  aspect-ratio="1.4"
                ></v-img>
              </v-btn>

              <!--   <v-btn class="pa-0">
                <v-img 
                src="https://clubpwc.ca/wp-content/uploads/2020/02/virement-bancaire.jpg" 
                aspect-ratio="1.4">
                </v-img>
              </v-btn>-->
            </v-card-text>
          </v-col>
 <v-divider></v-divider>
          <v-col cols="12" md="4" class="pa-0">
            <v-card-text class="flex cyan darken-2">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-subtitle>Retrouvez-nous aussi sur les réseaux sociaux</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>

              <v-btn v-for="icon in icons" :key="icon" class="mx-2 white--text" icon>
                <v-icon size="20px" color="cyan lighten-5">{{ icon }}</v-icon>
              </v-btn>
            </v-card-text>
          </v-col>
 <v-divider></v-divider>
          <v-col cols="12" md="4" class="pa-0">
            <v-card-text class="flex cyan darken-2">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-subtitle>Retrait en Magasin</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>

              <v-btn class="pa-0">
                <v-img
                  src="https://www.mybijouterie.com/img/cms/RETRAIT%20BOUTIQUE.jpg"
                  aspect-ratio="1.4"
                ></v-img>
              </v-btn>
            </v-card-text>
          </v-col>
        </v-row>

        <v-divider></v-divider>

        <v-card-text class="py-2 flex white--text text-center">
          {{ new Date().getFullYear() }} —
          <strong>© S.N.INFORMATIQUE : By KRISHNA</strong>
        </v-card-text>
      </v-card>
    </v-footer>
  </div>
</template>

<script>
export default {
  data: () => ({
    icons: [
      "mdi-facebook",
      "mdi-instagram",
      "mdi-twitter-circle",
      "mdi-linkedin"
    ]
  })
};
</script>
