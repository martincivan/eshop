<template>
  <div class="q-my-xl">
    <q-card>
      <q-card-title>Edit product</q-card-title>
      <q-card-main>
        <img :src="'/weby/eshop/public/img/products/' + produkt.id + '.jpg'">
        <q-field :count="250">
          <q-input float-label="Name" max-length="250" v-model="produkt.name" />
        </q-field>
        <q-field :count="5000">
          <q-input
            type="textarea"
            float-label="Description"
            :max-height="100"
            rows="7"
            v-model="produkt.description"
          />
        </q-field>
        <q-field :count="250">
          <q-input float-label="Code" max-length="250" v-model="produkt.code" />
        </q-field>
        <q-field :count="250">
          <q-input float-label="Size" type="number" v-model="produkt.size"/>
        </q-field>
        <q-field :count="250">
          <q-input float-label="Price" type="number" v-model="produkt.price"/>
        </q-field>
        <q-field :count="250">
          <q-select float-label="Category" v-model="produkt.category_id" :options="categories" radio></q-select>
        </q-field>
        <q-field :count="250">
          <q-select float-label="Material" v-model="produkt.material_id" :options="materials" radio></q-select>
        </q-field>
        <q-field>
          <input type="file" id="image_input" name="image" ref="image" accept=".jpg" @change="handleImage">
        </q-field>
      </q-card-main>
      <q-card-actions class="q-mt-md">
        <div class="row justify-end full-width docs-btn">
          <q-btn label="Cancel" flat to="/products/index"/>
          <q-btn @click="send" label="Save" color="primary" />
        </div>
      </q-card-actions>
    </q-card>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  data () {
    return {
      produkt: {},
      materials: [],
      categories: []
    }
  },
  created: function () {
    this.loading = true
    axios.get('/weby/eshop/public/api/categories/list').then(({ data }) => {
      Object.values(data).forEach(this.parseCategories)
    })
      .catch(error => {
        console.log(error)
        this.loading = false
      })
    axios.get('/weby/eshop/public/api/materials/list').then(({ data }) => {
      Object.values(data).forEach(this.parseMaterials)
    })
      .catch(error => {
        console.log(error)
        this.loading = false
      })
    axios.get('/weby/eshop/public/api/products/' + this.$route.params.id)
      .then(({ data }) => {
        this.produkt = data
      })
      .catch(error => {
        console.log(error)
        this.loading = false
      })
    this.loading = false
  },
  methods: {
    send: function () {
      let formData = new FormData()
      for (let key in this.produkt) {
        formData.append(key, this.produkt[key])
      }
      formData.append('image', this.image)
      // axios.post('/weby/eshop/public/api/products', this.produkt).then(({ data }) => {
      axios.post('/weby/eshop/public/api/products/' + this.$route.params.id + '/_update', formData).then(({ data }) => {
        this.$q.notify({type: 'positive', timeout: 2000, message: 'The product has been saved.'})
      })
    },
    parseCategories: function (row) {
      this.categories.push(
        {
          label: row.name,
          value: row.id
        }
      )
    },
    parseMaterials: function (row) {
      this.materials.push(
        {
          label: row.name,
          value: row.id
        }
      )
    },
    handleImage: function () {
      this.image = this.$refs.image.files[0]
    }
  }
}
</script>

<style lang="stylus">
  .docs-btn .q-btn
    padding 15px 20px
</style>
