<div>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Contact Form</h3>
                        </div>
                        <div class="card-body">

                            <form wire:submit.prevent="submitForm">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" wire:model="name" class="form-control" id="phone">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" wire:model="email" name="email" class="form-control" id="email">
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" wire:model="phone" name="phone" class="form-control" id="phone">
                                    @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" wire:model="message" id="message" class="form-control"></textarea>
                                    @error('$message')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="btn btn-success" type="submit">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
