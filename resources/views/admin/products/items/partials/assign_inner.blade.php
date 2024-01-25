<div class="text-center mb-2">
                    <h1 class="mb-1">Assign Employee
                        
                    </h1>

                </div>

                <form id="add-department-form" class="row gy-1 pt-75" action="{{route('productitem.assign.employee')}}" method="post">
                    @csrf

                    <input type="hidden" name="productitem_id"  value="{{$productitem->id}}"  />
                <div class="mb-1">
                                <label class="form-label" for="assign-user">Employee</label>
                                <select id="assign-user"
                                    class=" form-select"
                                    name="employee_id" >
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $employee)

                                        <option value="{{ $employee->id }}" {{$productitem->employee_id == $employee->id ? 'selected' : ' ' }} >
                                            {{ $employee->full_name }}</option>


                                            
                                    @endforeach
                                </select>
                             
                            </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1" id="create_department">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary add-department-close-btn" data-bs-dismiss="modal"
                                aria-label="Close">
                            Discard
                        </button>
                    </div>

                </form>