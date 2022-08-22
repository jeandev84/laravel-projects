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
            <!-- <form @submit.prevent="searchProduct">  -->
                 <form @submit.prevent="view">
                    <div class="input-group">
                        <input
                            v-model="search"
                            type="text"
                            placeholder="Search"
                            class="form-control"
                        >
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

                        <alert-error :form="product" :message="message"></alert-error>

                        <form @submit.prevent="isEditMode ? update() : store()" @keydown="product.onkeydown($event)">
                            <div class="form-group">
                                <label for="name">Name: </label>
                                <input type="text" v-model="product.name" id="name" class="form-control"
                                       :class="{ 'is-invalid': product.errors.has('name') }"/>
                                <has-error :form="product" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="price">Price: </label>
                                <input type="number"v-model="product.price" id="price" class="form-control"
                                       :class="{ 'is-invalid': product.errors.has('price') }"/>
                                <has-error :form="product" field="price"></has-error>
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

        <!-- Loading -->
        <!-- <loading :active.sync="isLoading" :is-full-page="true"/> -->
        <!-- End Loading -->
    </div>
</template>

<script>

// Reference : https://npmjs.com/package/vform
// https://sweetalert2.github.io/


export default {
    name: "ProductComponent",
    data() {
        return {
            // fullPage: false,
            isEditMode: false,
            search: '',
            products: {},
            product: new Form({
                id: '',
                name: '',
                price: ''
            }),
            message: ""
        }
    },
    methods: {
          /*
          searchProduct() {
             axios.get('/api/v1/products?search=' + this.search)
                 .then(response => {
                     // console.log(response)
                     this.products = response.data;
                 });
          },
          */
          view(page=1) {
              /* axios.get('/api/v1/products?page=' + page) */
              this.$Progress.start();
              // this.isLoading = true;

              /*
               let loader = this.$loading.show( {
                     container: this.fullPage ? null : this.$refs.formContainer,
                     canCancel: false,
                     onCancel: this.onCancel,
               });

               let loader = this.$loading.show({
                  color: '#3490dc',
                  width: '45px',
                  height: '45px'
                });

               */

              let loader = this.$loading.show();


              axios.get(`/api/v1/products?page=${page}&search=${this.search}`)
                  .then(response => {
                      // console.log(response.data);
                      // this.products = response.data; [ without pagination ]
                      this.products = response.data;
                      this.$Progress.finish();

                      /*
                      setTimeout(() => {
                          this.isLoading = false;
                      }, 500);
                      */

                      // simulate AJAX
                      setTimeout(() => {
                          loader.hide();
                      }, 500);
                  })
                  .catch(error => {
                      // console.log(error)
                      this.$Progress.fail();

                      setTimeout(() => {
                          loader.hide();
                      }, 500);
                  });
          },
          create() {
              this.product.clear();
              this.isEditMode = false;
              this.product.reset();
          },
          store() {
              /*
              axios.post('/api/v1/products', this.product)
                  .then(response => {
                      // console.log(response)
                      this.product = response.data;
                      this.view();
                  })
                  .catch(error => {
                      console.log(error)
                  });

              */

              this.product.post('/api/v1/products')
                  .then(response => {
                      // console.log(response)
                      this.view();
                      this.product.reset();
                      Toast.fire({
                          icon: "success",
                          title: "Created successfully"
                      });
                  })
                  .catch(error => {
                      // console.log(error)
                      // console.log(error.response)
                      // console.log(error.response.data.errors)
                      // console.log(error.response.data.message)
                      this.message = error.response.data.message;
                  });
          },
          edit(product) {
              this.product.clear();
              this.isEditMode    = true;
              this.product.fill(product);

              /*
              this.product.id    = product.id;
              this.product.name  = product.name;
              this.product.price = product.price;
              */
          },
          update() {
             this.product.put('/api/v1/products/' + this.product.id)
                 .then(response => {
                     // console.log(response)
                     this.view();
                     this.product.reset();
                     Toast.fire({
                         icon: "success",
                         title: "Updated successfully"
                     });
                 })
                 .catch(error => {
                     console.log(error)
                 });
          },
          destroy(id) {

              // Demo : Swal.fire('Any fool can use a computer');

                /*
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
              */

              Swal.fire({
                 title: 'Are you sure?',
                 // text: "You won't be able to revert this!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Delete'
              }).then((result) => {

                  if (result.isConfirmed) {

                      /*
                        Swal.fire(
                           'Deleted',
                          'Your file has been deleted.',
                          'success'
                        )
                      */

                      axios.delete('/api/v1/products/' + id)
                           .then(response => {
                              console.log(response)

                              this.view();

                              Swal.fire({ title: 'Deleted!', icon: 'success'});

                              Toast.fire({
                                   icon: "success",
                                   title: "Deleted successfully"
                              });
                           })
                  }
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
