@extends('layout.admin.app')
@section('title', 'لوحة التحكم')

@section('content')


    <h1 class="text-center my-5">{{ __('global.dashboard') }}</h1>
   
    <div class="row">
        
        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-primary-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">Members</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}

        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-danger-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">Members</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
        
        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-success-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">Members</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
        
        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-warning-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">Members</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
        
        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-secondary-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">Members</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
        
        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-info-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">Members</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
        
        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-purple-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">Members</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
        
        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-pink-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">Members</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
        
        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-teal-gradient text-white ">
                <a href="#" class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon1 mt-2 text-center text-white">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mt-0 text-center">
                                <span class="text-white">hello</span>
                                <h2 class="text-white mb-0">600</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}

    </div>

@endsection

