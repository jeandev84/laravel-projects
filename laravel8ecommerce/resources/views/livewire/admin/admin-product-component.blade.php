<div>
    <div class="container" style="padding: 30px 0;">
         <div class="row">
             <div class="col-md-12">
                 <div class="panel panel-default">
                     <div class="panel-heading">
                        All Products
                     </div>
                     <div class="panel-body">
                          <table class="table table-striped">
                              <thread>
                                  <tr>
                                      <th>ID</th>
                                      <th>Image</th>
                                      <th>Name</th>
                                      <th>Stock</th>
                                      <th>Price</th>
                                      <th>Category</th>
                                      <th>Date</th>
                                      <th>Action</th>
                                  </tr>
                              </thread>
                              <tbody>
                                 @foreach($products as $product)
                                     <tr>
                                         <td>{{ $product->id }}</td>
                                         <td>
                                             <img src="{{ asset('assets/images/products/'. $product->image) }}"
                                                  alt="{{ $product->name }}"
                                                  width="60"
                                             >
                                         </td>
                                         <td>{{ $product->name }}</td>
                                         <td>{{ $product->stock_status }}</td>
                                         <td>{{ $product->regular_price }}</td>
                                         <td>{{ $product->category->name }}</td>
                                         <td>{{ $product->created_at }}</td>
                                         <td>x</td>
                                     </tr>
                                 @endforeach
                              </tbody>
                          </table>
                         {{ $products->links() }}
                     </div>
                 </div>
             </div>
         </div>
    </div>
</div>
