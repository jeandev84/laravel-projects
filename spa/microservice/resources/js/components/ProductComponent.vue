<template>
    <div class="container my-5">
        <!-- Create -->
        <div class="row justify-content-end mb-3">
            <div class="col-4">
                <button class="btn btn-primary" @click="create">
                    <i class="fas fa-plus-circle"></i> Create
                </button>
            </div>
            <div class="col-4">
                <form>
                    <div class="input-group">
                        <input type="text" placeholder="Search" class="form-control">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--/ Create End-->


        <!-- Table -->
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <h4 class="card-header">{{ isEditMode ? 'Edit' : 'Create' }}</h4>
                    <div class="card-body">
                        <form @submit.prevent="isEditMode ? update() : store()">
                            <div class="form-group">
                                <label for="name">Name: </label>
                                <input type="text" v-model="product.name" id="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="price">Price: </label>
                                <input type="number"v-model="product.price" id="price" class="form-control">
                            </div>

                            <button class="btn btn-primary mt-3" type="submit">
                                <i class="fas fa-save mr-1"></i> Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products.data" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="edit(product)">
                                <i class="fas fa-edit mr-1"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" @click="destroy(product.id)">
                                <i class="fas fa-trash-alt mr-1"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- Pagination -->
                <pagination :data="products" @pagination-change-page="view"/>
                <!-- Pagination End -->
            </div>
        </div>
        <!-- Table End -->
    </div>
</template>

<script>

import pagination from 'laravel-vue-pagination';

export default {
    name: "ProductComponent",
    components: {
        pagination
    },
    data() {
        return {
            isEditMode: false,
            products: {},
            product: {
                id: '',
                name: '',
                price: ''
            }
        }
    },
    methods: {

          view(page=1) {
              axios.get('/api/v1/products?page=' + page)
                  .then(response => {
                      console.log(response.data);
                      // this.products = response.data; [ without pagination ]
                      this.products = response.data;
                  })
                  .catch(error => {
                      console.log(error)
                  });
          },
          create() {
              this.isEditMode    = false;
              this.product       = {};
          },
          store() {
              axios.post('/api/v1/products', this.product)
                  .then(response => {
                      // console.log(response)
                      this.product = response.data;
                      this.view();
                  })
                  .catch(error => {
                      console.log(error)
                  });
          },
          edit(product) {
              this.isEditMode    = true;
              this.product       = product;
          },
          update() {
             axios.put('/api/v1/products/' + this.product.id, this.product)
                  .then(response => {
                     console.log(response)
                     this.product = response.data;
                     this.view();
                 })
                 .catch(error => {
                     console.log(error)
                 });
          },
          destroy(id) {

              if (! confirm('Are you sure to delete ?')) {
                   return;
              }

              axios.delete('/api/v1/products/' + id)
                  .then(response => {
                      console.log(response)
                      this.view();
                  })
                  .catch(error => {
                      console.log(error)
                  });
          }
    },
    created() {
        this.view()
    }
}
</script>

<style scoped>

</style>

<!--
<form>
  <button class="btn btn-primary mt-3" @click="store">
    <i class="fas fa-save mr-1"></i> Save
  </button>
</form>

OR

<form @submit.prevent="store">
  <button class="btn btn-primary mt-3" type="submit">
    <i class="fas fa-save mr-1"></i> Save
  </button>
</form>
-->
