<x-admin-layout>
  <div class="right_col" role="main">
  <div id="addEmployeeModal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Add Product</h4>
                    </div>
                    
                    <div class="modal-body">					
                    <div class="form-group">
                            <label for="categoryid">Category</label>
                            <select class="form-control  @error('categoryid') is-invalid @enderror" id="category-select"  name="categoryid" value="{{ old('categoryid') }}">
                              <option value="">Select Any Option</option>  
                              @foreach($categories as $category)  
                                <option value="{{ $category->id }}"  >{{ $category->name }}</option>
                              @endforeach  
                            </select>
                            @error('categoryid')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                            <label class="json-response-label mt-1" for="subcategory"></label>
                            <div class="json-response mt-1"></div>
                            @error('subcategory')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class=" form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}">
                            @error('code')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                        <div class="form-group">
                            <label for="shortdescription">Short-Description</label>
                            <textarea name="shortdescription" id="shortdescription" class=" form-control @error('shortdescription') is-invalid @enderror">{{ old('shortdescription') }}</textarea>
                            @error('shortdescription')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="specification">Specification</label>
                            <input type="text" class=" form-control @error('specification') is-invalid @enderror" id="specification" name="specification" value="{{ old('specification') }}">
                            @error('specification')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                        <div class="form-group">
                            <label for="rate">Rate</label>
                            <input type="text" class=" form-control @error('rate') is-invalid @enderror" id="rate" name="rate" value="{{ old('rate') }}">
                            @error('rate')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class=" form-control @error('photo') is-invalid @enderror" id="photo" name="photo" >
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
    
  $(document).ready(function(){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    $('#category-select').on('change', function() {
      var selectedId = $(this).val(); 

        
        var url = '{{ route("category.select", ["id" => ":id"]) }}';
        url = url.replace(':id', selectedId);
        
        $.ajax({
            method: 'GET',
            url: url, 
            success: function(response) {
              $(".json-response").html("");
              var select = $("<select class='form-control' name='subcategory'><option value=''>Select any Subcategory</option></select>");
             
                response[0].forEach(function(category) {
                    var option = $("<option value='"+category.id+"' >"+category.name+"</option>");
                    select.append(option); 
                });

                $(".json-response-label").text("Sub Category");
                $(".json-response").append(select);
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("Error: " + error);
            }
        });
       
        
    });
  });
</script>
  @endpush

</x-admin-layout>