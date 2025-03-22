<div>
    <label for="catagory_id" class="fw-bold mb-2">Select Category:</label>
    <select class="form-control" name="catagory_id" wire:model.live="selectedCatagory">
        <option value="">Select A Category</option>
        @foreach ($catagories as $catagory)
            <option value="{{ $catagory->id }}">{{ $catagory->catagory_name }}</option>
        @endforeach
    </select>
   
    <label for="subcatagory_id"  class="fw-bold mb-2">Select SubCategory:</label>
    <select class="form-control" name="subcatagory_id">
        <option value="">Select A Category</option>
        @foreach ($subcatagories as $subcatagory)
            <option value="{{ $subcatagory->id }}">{{ $subcatagory->subcatagory_name }}</option>
        @endforeach
    </select>
    
</div>