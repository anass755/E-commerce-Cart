<x-admin-layout>
  <div class="right_col" role="main">
  <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2> <b>Products</b></h2>
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
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Short Description</th>
                                <th>Specification</th>
                                <th>Rate</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                    </thead>
                    <tbody><?php $c=1; ?>
                    
                     @foreach($products as $product)
                    
                        <tr>
                            <td><?php echo $c;  ?></td> 
                            <td>{{ $product->category->name ?? 'N/A' }}</td> 
                            <td>{{ $product->subcategory->name ?? 'N/A' }}</td>
                            <td>{{ $product->name }}</td> 
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->short_description }}</td> 
                            <td>{{ $product->specification }}</td>
                            <td>{{ $product->rate }}</td>
                            <td style="width:100px;"><img src="{{ ($product->photo == 'defaultproduct.png')? asset('images/default_images/defaultproduct.png') : asset('app/products/' . $product->photo) }}" alt="category Image" class="img-fluid"></td>
                            <td class="edit-btn">
                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary e-d-btn"  style="color:white;width:71px;">Edit</a>
                                <form action="{{ route('product.destroy',$product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                   <button type="submit" class="btn btn-danger e-d-btn">Delete</button>
                                </form>
                            </td>
                        </tr> 
                        <?php $c++ ?>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>
</x-admin-layout>  