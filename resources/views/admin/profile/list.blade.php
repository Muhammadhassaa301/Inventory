@extends('admin.layouts.master')
@section('title','Profile')
@section('content')

    <section id="basic-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Profile</h4>
                    </div>
                    <div class="card-body">

                        @include('admin.partials.session_msgs')

                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
                            Profile Updated Successfully
                        </div>

                        <form id="SubmitForm" action="">
                        <input class="users" type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-name">Name</label>
                                <input type="text" class="form-control name" placeholder="Enter name" name="name" id="name" value="{{ Auth::user()->name }}" aria-label="Name" aria-describedby="basic-addon1" required/>
                                <span class="text-danger error-text name_error"></span>
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-email">Email</label>
                                <input type="email" class="form-control" aria-label="Email" value="{{ Auth::user()->email }}" aria-describedby="basic-addon1" disabled />
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-password">Password</label>
                                <div class="input-group form-password-toggle mb-2">
                                <input type="password" class="form-control password" id="password" name="password"  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password"/>
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                                <span class="text-danger error-text password_error"></span>
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-confirm-password">Confirm Password</label>
                                <div class="input-group form-password-toggle mb-2">
                                <input type="password" class="form-control confirm_password" id="confirm_password" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-confirm-password"/>
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                                <span class="text-danger error-text confirm_password_error"></span>
                            </div>

                            <div class="profile-img-container d-flex align-items-center">
                                <div class="profile-img">
                                    <img src="{{ auth()->user()->image ?: "/app-assets/images/avatars/placeholder.jpg" }}" class="rounded img-fluid" alt="Card image" id="profile-picture">
                                        <input type="file" name="image" class="profile-image d-none" accept=".jpg,.png,.jpeg">
                                        <button type="button" class="float-end ms-1" id="profile-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </button>
                                </div>
                            </div>

                        <button class="btn btn-primary mt-3" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>






@endsection





@section('scripts')
<!-- BEGIN: Vendor JS-->
<script src="{{ url('app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ url('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
<script src="{{ url('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ url('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ url('app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{--    <script src="{{ url('app-assets/js/scripts/pages/app-user-list.js?q='.time()) }}"></script>--}}
<!-- END: Page JS-->

{{-- </script> --}}




<script>
    $(document).ready(function (){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $('#SubmitForm').on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var user_id = $this.find('.users').val();

                var route = '{{ route('profile.edit.profile',':user_id') }}';
                route = route.replace(':user_id', user_id);


                $.ajax({
                    url:route,
                    method: 'POST',
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                // alert(prefix+' - '+val);
                                $('.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $('#successMsg').show();
                            // $('#SubmitForm')[0].reset();
                            // alert(data.msg);
                        }
                    }
                });
            });

            $('body').on('click', '#profile-button', function() {
                var $this = $(this);
                $('.profile-image').trigger('click');
            });

        $('.profile-image').change(function(){
            const file = this.files[0];
            console.log(file);
            if (file){
                let reader = new FileReader();
                reader.onload = function(event){
                    console.log(event.target.result);
                    $('#profile-picture').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });


    });

</script>

@endsection
