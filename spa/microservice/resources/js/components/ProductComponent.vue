<template>
    <div class="container my-5">
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
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <h4 class="card-header">{{ isEditMode ? 'Edit' : 'Create' }}</h4>
                    <div class="card-body">
                        <form @submit.prevent="store">
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
                         <tr v-for="product in products" :key="product.id">
                             <td>{{ product.id}}</td>
                             <td>{{ product.name }}</td>
                             <td>{{ product.price }}</td>
                             <td>
                                 <button class="btn btn-success btn-sm" @click="edit(product)">
                                     <i class="fas fa-edit mr-1"></i>
                                 </button>
                                 <button class="btn btn-danger btn-sm">
                                     <i class="fas fa-trash-alt mr-1"></i>
                                 </button>
                             </td>
                         </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductComponent",
    data() {
        return {
            isEditMode: false,
            products: [],
            product: {
                id: '',
                name: '',
                price: ''
            }
        }
    },
    methods: {

          view() {
              axios.get('/api/v1/products')
                  .then(response => {
                      console.log(response)
                      this.products = response.data;
                  })
                  .catch(error => {
                      console.log(error)
                  });
          },
          create() {
              this.isEditMode    = false;
              this.product.id    = '';
              this.product.name  = '';
              this.product.price = '';
          },
          store() {
              axios.post('/api/v1/products', this.product)
                  .then(response => {
                      console.log(response)
                      this.product = response.data;
                      this.view();
                  })
                  .catch(error => {
                      console.log(error)
                  });
          },
          edit(product) {

              this.isEditMode    = true;
              this.product.id    = product.id;
              this.product.name  = product.name;
              this.product.price = product.price;


              /*
              axios.post('/api/v1/products/' + this.product.id, this.product)
                  .then(response => {
                      console.log(response)
                      this.product = response.data;
                      this.view();
                  })
                  .catch(error => {
                      console.log(error)
                  });
              */
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
