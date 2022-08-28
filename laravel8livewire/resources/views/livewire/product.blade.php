<div>

    <form>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text"  wire:model="title" class="form-control">
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" wire:model="name" class="form-control">
        </div>

        <h3>Title: {{ $title }}</h3>
        <h3>Name: {{ $name }}</h3>

        <h3>Lifecycle Hooks Method</h3>

        @foreach($infos as $info)
            <h4>{{ $info }}</h4>
        @endforeach

    </form>
</div>
