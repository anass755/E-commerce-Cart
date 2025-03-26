<x-admin-layout>
  <div class="right_col" role="main">
  <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('product.update',$products->id) }}" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <div class="modal-header">						
                        <h4 class="modal-title">Edit Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
    <label for="categoryid">Category</label>
    <select name="categoryid" id="categoryid" class="form-control form-control @error('categoryid') is-invalid @enderror">
        <option value="">Select Any Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected($products->category_id == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('categoryid')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Static Subcategory Dropdown (Hidden by Default) -->
<div class="form-group" id="static-subcategory">
    <label for="subcategoryid">Subcategory</label>
    <select name="subcategoryid" id="subcategoryid" class="form-control form-control @error('subcategoryid') is-invalid @enderror">
        <option value="">Select Any Subcategory</option>
        @foreach($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}" @selected($products->sub_category == $subcategory->id)>{{ $subcategory->name }}</option>
        @endforeach
    </select>
    @error('subcategoryid')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Dynamic Subcategory Dropdown (Initially Empty) -->
<label class="json-response-label mt-1" for="subcategory"></label>
<div class="json-response mt-1"></div>
                           
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$products->name) }}">
                            @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>					
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code',$products->code) }}">
                            @error('code')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                        <div class="form-group">
                            <label for="shortdescription">Short-Description</label>
                            <textarea name="shortdescription" id="shortdescription" class="form-control form-control @error('shortdescription') is-invalid @enderror">{{ old('shortdescription',$products->short_description) }}</textarea>
                            @error('shortdescription')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="specification">Specification</label>
                            <input type="text" class="form-control form-control @error('specification') is-invalid @enderror" id="specification" name="specification" value="{{ old('specification',$products->specification) }}">
                            @error('specification')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                        <div class="form-group">
                            <label for="rate">Rate</label>
                            <input type="text" class="form-control form-control @error('rate') is-invalid @enderror" id="rate" name="rate" value="{{ old('rate',$products->rate) }}">
                            @error('rate')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo',$products->photo) }}">
                              <div class="mt-2">
                                   <img src="{{ asset('app/products/' . $products->photo) }}" alt="Current Image" class="img-fluid" width="150">
                              </div>
                            @error('photo')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                    </div>
                    <div class="modal-footer">
                    <a href=""><button class="btn btn-default">Cancel</button></a>
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#categoryid').on('change', function() {
            var selectedId = $(this).val();

            if (selectedId) {
                var url = '{{ route("category.select", ["id" => ":id"]) }}';
                url = url.replace(':id', selectedId);

                $.ajax({
                    method: 'GET',
                    url: url,
                    success: function(response) {
                        // Hide the static subcategory dropdown
                        $('#static-subcategory').hide();

                        // Clear the dynamic subcategory dropdown
                        $(".json-response").html("");

                        // Create a new <select> element for dynamic subcategories
                        var select = $("<select class='form-control' name='subcategoryid'><option value=''>Select any Subcategory</option></select>");

                        // Populate the dynamic dropdown with subcategories
                        response[0].forEach(function(category) {
                            var option = $("<option value='" + category.id + "'>" + category.name + "</option>");
                            select.append(option);
                        });

                        // Append the dynamic dropdown to the .json-response div
                        $(".json-response-label").text("Subcategory");
                        $(".json-response").append(select);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert("Error: " + error);
                    }
                });
            } else {
                // If no category is selected, show the static subcategory dropdown and hide the dynamic one
                $('#static-subcategory').show();
                $(".json-response").html("");
            }
        });
    });
</script>

@endpush
</x-admin-layout>  