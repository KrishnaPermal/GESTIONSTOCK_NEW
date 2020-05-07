<v-toolbar dark color="light-blue lighten-3">
            <v-toolbar-title>State selection</v-toolbar-title>
              <v-autocomplete v-model="select" :loading="loading" :items="items" :search-input.sync="search" cache-items class="mx-4"
                flat hide-no-data hide-details label="What state are you from?" solo-inverted>
              </v-autocomplete>
                <v-btn icon> 
                  <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
          </v-toolbar>