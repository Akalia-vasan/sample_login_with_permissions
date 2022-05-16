@extends('account.layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col col-sm-10 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        My Account
                    </strong>
                </div>

                <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    </div>
                @endif
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#profile" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
                            </li>

                            <li class="nav-item">
                                <a href="#edit" class="nav-link" aria-controls="edit" role="tab" data-toggle="tab">Update Information</a>
                            </li>

                            
                            <li class="nav-item">
                                <a href="#password" class="nav-link" aria-controls="password" role="tab" data-toggle="tab">Change Password</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active pt-3" id="profile" aria-labelledby="profile-tab">
                                @include('account.tabs.profile')
                            </div><!--tab panel profile-->

                            <div role="tabpanel" class="tab-pane fade show pt-3" id="edit" aria-labelledby="edit-tab">
                                @include('account.tabs.edit')
                            </div><!--tab panel profile-->
                                
                            <div role="tabpanel" class="tab-pane fade show pt-3" id="password" aria-labelledby="password-tab">
                                @include('account.tabs.change-password')
                            </div>
                        </div><!--tab content-->
                    </div><!--tab panel-->
                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection
