<div>
   <div class="container" style="padding: 30px 0;">
       <div class="row">
           <div class="col-md-12">
               <div class="panel panel-default">
                   <div class="panel-heading">
                       <div class="row">
                           <div class="col-md-6">
                               Add New Product
                           </div>
                           <div class="col-md-6">
                               <a href="{{ route('admin.products') }}" class="btn btn-success pull-right">
                                   All Products
                               </a>
                           </div>
                       </div>
                   </div>
                   <div class="panel-body">
                       <form class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Name</label>
                                <div class="col-md-4">
                                    <input type="text"
                                           class="form-control input-md"
                                           placeholder="Product Name"
                                    >
                                </div>
                            </div>

                            <div class="form-group">
                               <label class="col-md-4 control-label">Product Slug</label>
                               <div class="col-md-4">
                                   <input type="text"
                                          class="form-control input-md"
                                          placeholder="Product Slug"
                                   >
                               </div>
                            </div>

                            <div class="form-group">
                               <label class="col-md-4 control-label">Short Description</label>
                               <div class="col-md-4">
                                   <textarea class="form-control" placeholder="Short Description"></textarea>
                               </div>
                            </div>

                           <div class="form-group">
                               <label class="col-md-4 control-label">Description</label>
                               <div class="col-md-4">
                                   <textarea class="form-control" placeholder="Description"></textarea>
                               </div>
                           </div>

                           <div class="form-group">
                               <label class="col-md-4 control-label">Regular Price</label>
                               <div class="col-md-4">
                                   <input type="text"
                                          class="form-control input-md"
                                          placeholder="Regular Price"
                                   >
                               </div>
                           </div>


                           <div class="form-group">
                               <label class="col-md-4 control-label">Sale Price</label>
                               <div class="col-md-4">
                                   <input type="text"
                                          class="form-control input-md"
                                          placeholder="Sale Price"
                                   >
                               </div>
                           </div>

                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
