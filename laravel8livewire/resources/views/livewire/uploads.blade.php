<div>

   <section style="padding-top: 60px;">
       <div class="container">
           <div class="row">
               <div class="col-md-6 offset-md-3">

                   <!-- Display flash message -->
                   @if(session()->has('message'))
                       <div class="alert alert-success">{{ session()->get('message') }}</div>
                   @endif
                   <!-- End Display -->

                   <div class="card">
                       <div class="card-header">
                           <h3>File Upload</h3>
                       </div>
                       <div class="card-body">

                           <form wire:submit.prevent="fileUpload()" id="form-upload" enctype="multipart/form-data">

                               <div class="form-group">
                                   <label for="title">Title</label>
                                   <input type="text"
                                          name="title"
                                          class="form-control"
                                          id="title"
                                          wire:model="title"
                                   >
                                   @error('title')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="form-group">
                                   <label for="filename">File</label>
                                   <input type="file"
                                          name="filename"
                                          class="form-control"
                                          id="filename"
                                          wire:model="filename"
                                   >
                                   @error('filename')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>

                               <button type="submit" class="btn btn-success float-right">
                                   Upload
                               </button>

                           </form>

                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>

</div>
