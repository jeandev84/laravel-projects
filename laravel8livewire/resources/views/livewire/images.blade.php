<div>

    <section style="padding-top: 60px;">
     {{--    .container>.row>.col-md-6.offset-md-3>.card>.card-header+.card-body --}}
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">

                    <!-- Display Message -->
                      @if(session()->has('message'))
                          <div class="alert alert-success">
                              {{ session('message') }}
                          </div>
                      @endif
                    <!-- End Display -->

                    <div class="card">
                        <div class="card-header">
                             <h4>Upload Images</h4>
                        </div>
                        <div class="card-body">

                            <form wire:submit.prevent="uploadImages()" id="upload-images" enctype="multipart/form-data">

                                 <div class="form-group">
                                     <label for="images">Choose Images</label>
                                     <input type="file"
                                            name="images"
                                            class="form-control"
                                            id="images"
                                            wire:model="images"
                                            multiple
                                     >
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
