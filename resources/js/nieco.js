import axios from 'axios'

export default {
// name: 'PageName',
  data: function () {
    return {
      products: []
    }
  },
  created () {
    axios.get('/public/products/list')
      .then(response => {
        this.products = response.data
      })
      .catch(e => {
        this.errors.push(e)
      })
  }}
