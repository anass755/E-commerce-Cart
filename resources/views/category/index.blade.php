<x-admin-layout>
  <div class="right_col" role="main">
    <div class="container-xl">
        <div class="table-responsive">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
         @endif
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2> <b>Categories</b></h2>
                        </div>
                        <!-- <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
                        </div> -->
                    </div>
                </div>
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Si No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php $c = 1; ?>
                        @foreach($categories as $category)
                            @if($category->parent_category == 0) 
                                <tr>
                                    <td>{{ $c }}</td>
                                    <td><strong>{{ $category->name }}</strong></td> 
                                    <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="edit-delete-td">
                                        <a href="{{ route('category.edit', $category->id) }}" class="edit">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="dbtn">
                                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $c++; ?>
                                @foreach($categories as $subcategory)
                                    @if($subcategory->parent_category == $category->id)
                                        <tr>
                                            <td></td>
                                            <td style="padding-left: 30px;"> 
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                {{ $subcategory->name }}
                                            </td>
                                            <td>{{ $subcategory->status ? 'Active' : 'Inactive' }}</td>
                                            <td class="edit-delete-td">
                                                <a href="{{ route('category.edit', $subcategory->id) }}" class="edit">
                                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                                </a>
                                        
                                                <form action="{{ route('category.destroy', $subcategory->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dbtn">
                                                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                                    </button>
                                                </form>
                                               
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    <!-- Edit Modal HTML -->
    
    <!-- Edit Modal HTML -->
    
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">						
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">					
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">class="btn btn-default"
                       
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
</x-admin-layout>