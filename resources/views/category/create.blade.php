<x-admin-layout>
  <div class="right_col" role="main">
  <div id="addEmployeeModal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('category.store') }}">
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Add Category</h4>
                    </div>
                    <div class="modal-body">					
                        <div class="form-group">
                            <label for="parentcategory">Parent Category</label>
                            <select name="parentcategory" id="parentcategory" class="form-control @error('parentcategory') is-invalid @enderror">
                                <option value="0">Root Category</option>
                                @foreach($parentCategories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                @endforeach
                            </select>
                                @error('parentcategory')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>	
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div>
                                <input type="radio"  name="status" value="0" class="status @error('status') is-invalid @enderror"> Inactive
                                <input type="radio"  name="status" value="1" class="status @error('status') is-invalid @enderror"> Active
                            </div>
                            @error('status')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                        </div>	
                    </div>
                    <div class="modal-footer">
                    <a href="{{ route('category.index') }}"><button class="btn btn-default">Cancel</button></a>
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
</x-admin-layout>