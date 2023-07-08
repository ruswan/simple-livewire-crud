<div>
    <div class="form-group">
        <input type="hidden" wire:model='user_id'>
        <label for="name">Name</label>
        <input type="text" name="name"  id="name" class="form-control" wire:model='name'>
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" wire:model='email'>
    </div>
    <button wire:click="update()" class="btn btn-primary mt-2">Update</button>
    <button wire:click="cancel()" class="btn btn-secondary mt-2">Cancel</button>
</div>