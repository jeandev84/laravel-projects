<div class="row mt-5">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h3>Information</h3>
            </div>
            <div class="card-body">

                <form action="#" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Name</label>
{{--                    <input type="text" wire:model="name" class="form-control"/>--}}
                        {{-- wire:model.debounce.1000ms: will be send request to server after 1s --}}
                        <input type="text" wire:model.debounce.1000ms="name" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea wire:model="message" class="form-control"></textarea>
                    </div>


                    <div class="form-group">
                        <div>Marital Status :</div>
                        <div>
                            <label>Single</label>
                            <input type="radio" wire:model="marital_status" value="single">

                            <label>Married</label>
                            <input type="radio" wire:model="marital_status" value="married">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>Favourite Colors:</div>
                        <div>
                            Red    <input type="checkbox" value="red" wire:model="colors">
                            Green  <input type="checkbox" value="green" wire:model="colors">
                            Blue   <input type="checkbox" value="blue" wire:model="colors">
                        </div>
                    </div>

                    <div class="form-group">
                         <div class="">Favourite Fruit:</div>
                         <select wire:model="fruit" id="fruit" class="form-control">
                            <option value="">Select Fruit</option>
                            <option value="apple">Apple</option>
                            <option value="mango">Mango</option>
                            <option value="banana">Banana</option>
                         </select>
                    </div>
                </form>

                <hr>

                <h3>Details: </h3>
                <div class="row">
                    <div class="col-md-12">
                        <div>Name : {{ $name }}</div>
                        <div>Message : {{ $message }}</div>
                        <div>Marital Status : {{ $marital_status }}</div>
                        <div>Favourite Colors: </div>
                        <ul>
                            @foreach($colors as $color)
                               <li>{{ $color }}</li>
                            @endforeach
                        </ul>
                        <div>Favourite Fruit: {{ $fruit }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
