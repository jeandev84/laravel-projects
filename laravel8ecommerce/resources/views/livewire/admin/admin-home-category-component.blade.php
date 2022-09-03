<div>
   <div class="container" style="padding: 30px 0;">
       <div class="row">
           <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Home Categories
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="updateHomeCategory()">
                             <div class="form-group">
                                 <label class="col-md-4 control-label">Choose Categories</label>
                                 <!-- wire:ignore : ignore livewire action -->
                                 <div class="col-md-4" wire:ignore>
                                     <select class="sel_categories form-control"
                                             name="categories[]"
                                             multiple="multiple"
                                             wire:model="selected_categories">
                                         @foreach($categories as $category)
                                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="form-group">
                             {{-- No Of Products : Number Of Products --}}
                                <label class="col-md-4 control-label">No Of Products</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" wire:model="number_of_products">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
           </div>
       </div>
   </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            // Event select2 (like Tags)
            $(".sel_categories").select2();

            // Event change selected categories
            $(".sel_categories").on('change', function (e) {

                  let data = $(".sel_categories").select2("val");
                  @this.set('selected_categories', data);
            });
        });
    </script>
@endpush
