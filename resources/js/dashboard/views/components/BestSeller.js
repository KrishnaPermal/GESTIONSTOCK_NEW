import {apiServices} from '../../_services/api.services';

  export default {
    data: () => ({
      model: null,
      articles: [],
      photo: [],
      articlesDisplay: [],
    }),

  methods: {
      articleDisplay() {
          apiServices.get('/api/articles')
              .then(({ data }) => {
                  data.data.forEach(_data => {
                      this.articles.push(_data)
                  })
              })
          this.articlesDisplay = this.articles;
      },  
  },
  

  created() {
      this.articleDisplay();
  }
  }
