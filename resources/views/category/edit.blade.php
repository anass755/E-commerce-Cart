<x-admin-layout>
<div class="right_col" role="main">
    <div id="editEmployeeModal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('category.update',$categoryname->id)  }}">
                    @csrf
                    @method('put')
                    <div class="modal-header">						
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">					
                    <label for="name">Name</label>
                            <input type="text" class="form-control form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$categoryname->name) }}">
                            @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                    </div>
                    <div class="modal-body">
                            <label for="status">Status</label>
                            <div>
                                <input type="radio"  name="status" value="0" class="status @error('status') is-invalid @enderror" > Inactive
                                <input type="radio"  name="status" value="1" class="status @error('status') is-invalid @enderror"> Active
                            </div>
                            @error('status')
                              <div class="alert alert-danger">{{ $message }}</div>
	                        @enderror
                    </div>
                    <div class="modal-footer">
                    <a href="{{ route('category.index') }}"><button class="btn btn-default">Cancel</button></a>
                        <input type="submit" class="btn btn-info" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
</x-admin-layout>