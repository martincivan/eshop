<template>
  <div>
    <q-table
      :data="serverData"
      :columns="columns"
      row-key="id"
      title="List of products"
      style="table-layout: fixed;"
    >
      <q-tr slot="body" slot-scope="props" :props="props">
        <img :src="'/weby/eshop/public/img/products/' + props.row.id + '.jpg'">
        <q-td key="id" :props="props">
          <span>{{ props.row.id }}</span>
        </q-td>
        <q-td key="name" :props="props">
          <span>{{ props.row.name }}</span>
        </q-td>
        <q-td key="code" :props="props">
          <span>{{ props.row.code }}</span>
        </q-td>
        <q-td key="size" :props="props">
          <span>{{ props.row.size }}</span>
        </q-td>
        <q-td key="price" :props="props">
          <span>{{ props.row.price }}</span>
        </q-td>
        <q-td key="category" :props="props">
          <span>{{ categories[props.row.category_id].name }}</span>
        </q-td>
        <q-td key="material" :props="props">
          <span>{{ materials[props.row.material_id].name }}</span>
        </q-td>
        <q-td class="text-right">
          <q-btn round icon="edit" class="q-mr-xs" @click="$router.push('/products/' + props.row.id + '/edit')" />
          <q-btn round icon="delete" @click="destroy(props.row.id, props.row.name)" />
        </q-td>
      </q-tr>
    </q-table>
  </div>
</template>

<script>
import axios from 'axios'
// import {Dialog, Notify} from 'quasar'
export default {
  data () {
    return {
      columns: [
        { name: 'img', label: 'Image', field: '', align: 'left' },
        { name: 'id', label: 'ID', field: 'id', sortable: true, align: 'left' },
        { name: 'name', label: 'Name', field: 'name', sortable: true, align: 'left' },
        { name: 'code', label: 'Code', field: 'code', sortable: true, align: 'left' },
        { name: 'size', label: 'Size', field: 'size', sortable: true, align: 'left' },
        { name: 'price', label: 'Price', field: 'price', sortable: true, align: 'left' },
        { name: 'category', label: 'Category', field: 'category', sortable: true, align: 'left' },
        { name: 'material', label: 'Material', field: 'material', sortable: true, align: 'left' },
        { name: 'actions', label: 'Actions', sortable: false, align: 'right' }
      ],
      selected: [],
      loading: false,
      serverPagination: {
        page: 1,
        rowsNumber: 10, // the number of total rows in DB
        rowsPerPage: 5,
        sortBy: 'name',
        descending: true
      },
      serverData: [],
      materials: [],
      categories: []
    }
  },
  methods: {

    request ({ pagination }) {
      this.loading = true
      axios.get('/weby/eshop/public/api/categories/list').then(({ data }) => {
        this.categories = data
      })
        .catch(error => {
          console.log(error)
          this.loading = false
        })
      axios.get('/weby/eshop/public/api/materials/list').then(({ data }) => {
        this.materials = data
      })
        .catch(error => {
          console.log(error)
          this.loading = false
        })
      axios
        .get(`/weby/eshop/public/api/products/list/${pagination.page}?rowsPerPage=${pagination.rowsPerPage}&sortBy=${pagination.sortBy}&descending=${pagination.descending}`)
        .then(({ data }) => {
          this.serverPagination = pagination

          this.serverPagination.rowsNumber = data.rowsNumber

          this.serverData = data.rows

          this.loading = false
        })
        .catch(error => {
          console.log(error)
          this.loading = false
        })
    },
    destroy (id, name) {
      this.$q.dialog({
        title: 'Delete',
        message: 'Are you sure to delete ' + name + '?',
        color: 'primary',
        ok: true,
        cancel: true
      }).then(() => {
        axios.delete('/weby/eshop/public/api/products/' + id).then(({data}) => {
          this.$q.notify({type: 'positive', timeout: 2000, message: 'The product has been deleted.'})
          this.request({
            pagination: this.serverPagination,
            filter: this.filter
          })
        })
      }).catch(() => {})
    }
  },
  mounted () {
    this.request({
      pagination: this.serverPagination,
      filter: this.filter
    })
  }
}
</script>
