import {apiServices} from '../../_services/api.services';

  export default {
    data: () => ({
      model: null,
      photo: [],
      articlesDisplay: [],
    }),

  methods: {
      articleDisplay() {
          apiServices.get('/api/articles')
              .then(({ data }) => {
                  data.data.forEach(_data => {
                      this.articlesDisplay.push(_data)
                  })
              })
      },  
  },
  

  created() {
      this.articleDisplay();
  }
  }
