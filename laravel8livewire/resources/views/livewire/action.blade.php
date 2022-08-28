<div class="mt-5">
    <div class="row">

        <div class="col-md-12">

            <div id="sum-action" class="form-group">
                <button type="button" class="btn btn-success" wire:click="addTwoNumbers(32, 55)">Sum</button>
                <span id="sum-result" class="mt-3">
                    Sum : {{ $sum }}
                </span>
            </div>

            <form wire:submit.prevent="getSum()">

                <div class="form-group">
                    <label for="num1">Enter Num 1:</label>
                    <input type="text" name="num1" id="num1" wire:model="num1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="num1">Enter Num 2:</label>
                    <input type="text" name="num2" id="num1" wire:model="num2" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

            <div id=" keydown-action" class="form-group">
                <label for="message">Message</label>
                <textarea wire:keydown.enter="displayMessage($event.target.value)" class="form-control" id="message"></textarea>
                <div id="message">
                    Message : {{ $message }}
                </div>
            </div>

        </div>

    </div>
</div>


