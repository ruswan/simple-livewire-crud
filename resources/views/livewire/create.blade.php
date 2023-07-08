<div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" wire:model='name'>
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" wire:model='email'>
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <button  wire:click="store()" class="btn btn-primary mt-2">Save</button>
</div>