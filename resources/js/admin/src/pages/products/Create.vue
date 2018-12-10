<template>
  <div class="q-my-xl">
    <q-card>
      <q-card-title>Create product</q-card-title>
      <q-card-main>
        <q-field :count="250">
          <q-input float-label="Name" max-length="250" min-length="3" v-model="produkt.name" :error="$v.produkt.name.$error"/>
        </q-field>
        <q-field :count="5000">
          <q-input
            type="textarea"
            float-label="Description"
            :max-height="100"
            rows="7"
            v-model="produkt.description"
            :error="$v.produkt.description.$error"
          />
        </q-field>
        <q-field :count="250">
          <q-input float-label="Code" max-length="250" v-model="produkt.code" :error="$v.produkt.code.$error"/>
        </q-field>
        <q-field :count="250">
          <q-input float-label="Price" type="number" v-model="produkt.price" :error="$v.produkt.price.$error"/>
        </q-field>
        <q-field :count="250">
          <q-select float-label="Size" :options="sizes" v-model="produkt.size" :error="$v.produkt.size.$error"/>
        </q-field>
        <q-field :count="250">
          <q-select float-label="Category" v-model="produkt.category_id" :options="categories" radio :error="$v.produkt.category_id.$error"></q-select>
        </q-field>
        <q-field :count="250">
          <q-select float-label="Material" v-model="produkt.material_id" :options="materials" radio :error="$v.produkt.material_id.$error"></q-select>
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
import { required } from 'vuelidate/lib/validators'
export default {
  data () {
    return {
      sizes: [
        {label: '60', value: 60},
        {label: '80', value: 80},
        {label: '100', value: 100},
        {label: '120', value: 120}

      ],
      produkt: {},
      categories: [],
      materials: [],
      image: null
    }
  },
  validations: {
    produkt: {
      name: {required},
      price: {required},
      description: {required},
      size: {required},
      code: {required},
      category_id: {required},
      material_id: {required}
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
    this.loading = false
  },
  methods: {
    send: function () {
      this.$v.produkt.$touch()
      if (this.$v.produkt.$error) {
        this.$q.notify('Please review fields again.')
        return
      }
      let formData = new FormData()
      for (let key in this.produkt) {
        formData.append(key, this.produkt[key])
      }
      formData.append('image', this.image)
      // axios.post('/weby/eshop/public/api/products', this.produkt).then(({ data }) => {
      axios.post('/weby/eshop/public/api/products', formData).then(({ data }) => {
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
