<template>
  <!--<q-page padding>-->
  <!--<q-list highlight>-->
  <!--<q-list-header>Products</q-list-header>-->
  <!--<q-item v-for="product in products" v-bind:key="product.name">-->
  <!--<q-item-side>-->
  <!--<q-item-tile avatar>-->
  <!--<img :src="getImageUrl(product)">-->
  <!--</q-item-tile>-->
  <!--</q-item-side>-->
  <!--<q-item-main :label="product.name"/>-->
  <!--<q-item-side right>-->
  <!--<q-btn icon="edit"/>-->
  <!--<q-btn icon="delete" color="red"/>-->
  <!--</q-item-side>-->
  <!--</q-item>-->
  <!--</q-list>-->
  <!--</q-page>-->
  <q-layout>
    <q-btn icon="add">Add product</q-btn>
    <q-table
      :data="serverData"
      :columns="columns"
      :filter="filter"
      row-key="id"
      :pagination.sync="serverPagination"
      :loading="loading"
      @request="request"
    >
    </q-table>
  </q-layout>
</template>
<script>
// import tableData from 'table-data'
import axios from 'axios'

export default {
  data () {
    return {
      filter: '',
      loading: false,
      serverPagination: {
        page: 1,
        rowsNumber: 10 // specifying this determines pagination is server-side
      },

      serverData: [],
      columns: [
        {name: 'id', label: 'ID', field: 'id', sortable: true},
        {name: 'name', label: 'Name', field: 'name', sortable: true},
        {name: 'description', label: 'Description', field: 'description'},
        {name: 'code', label: 'Code', field: 'code'},
        {name: 'size', label: 'Size', field: 'size'},
        {name: 'material', label: 'Material', field: 'material_id'},
        {name: 'category', label: 'Category', field: 'category_id'},
        {name: 'price', label: 'Price', field: 'price', sortable: true}
      ]
    }
  },
  methods: {
    request ({pagination, filter}) {
      // we set QTable to "loading" state
      this.loading = true

      // we do the server data fetch, based on pagination and filter received
      // (using Axios here, but can be anything; parameters vary based on backend implementation)

      axios
      // .get(`/data/${pagination.page}?sortBy=${pagination.sortBy}&descending=${pagination.descending}&filter=${filter}`)
        .get(`/weby/eshop/public/api/products/list`)
        .then(({data}) => {
          // updating pagination to reflect in the UI
          // this.serverPagination = pagination

          // we also set (or update) rowsNumber
          // this.serverPagination.rowsNumber = data.rowsNumber

          // then we update the rows with the fetched ones
          // this.serverData = data.rows
          this.serverData = data
          // finally we tell QTable to exit the "loading" state
          this.loading = false
        })
        .catch(error => {
          // there's an error... do SOMETHING
          console.log(error)
          // we tell QTable to exit the "loading" state
          this.loading = false
        })
    }
  },
  mounted () {
    // once mounted, we need to trigger the initial server data fetch
    this.request({
      pagination: this.serverPagination,
      filter: this.filter
    })
  }
}
// import axios from 'axios'
//
// export default {
//   name: 'Products',
//   data: function () {
//     return {
//       products: []
//     }
//   },
//   created () {
//     axios.get('/weby/eshop/public/api/products/list')
//       .then(response => {
//         this.products = response.data
//       })
//       .catch(e => {
//         this.errors.push(e)
//       })
//   },
//   methods: {
//     getImageUrl (product) {
//       return '/weby/eshop/public/img/products/' + product.id + '.jpg'
//     }
//   }
//
// }
</script>

<style>
</style>
