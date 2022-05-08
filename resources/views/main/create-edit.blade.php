@extends('layouts.app')

@section('content')
@if (Request::is('companies/*'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header"><h5>{{ __('Create Company') }}</h5></div>

                <div class="card-body">
                    <form method="POST" @if (Request::is('*/create'))action="{{ route('companies.store') }}"@endif @if (Request::is('*/edit') && isset($company))action="{{ route('companies.update', $company->slug) }}"@endif enctype="multipart/form-data">
                        @csrf
                        @isset($company)
                            @method('PUT')
                        @endisset

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Company Name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" @isset($company) value="{{ $company->name }}" @else value="{{ old('name') }}" @endif required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Company Email') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" @isset($company) value="{{ $company->email }}" @else value="{{ old('email') }}" @endif required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="website" class="col-md-4 col-form-label text-md-end">{{ __('Company Website') }}</label>

                            <div class="col-md-7">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" @isset($company) value="{{ $company->website }}" @else value="{{ old('website') }}" @endif required autocomplete="website">

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="logo" class="col-md-4 col-form-label text-md-end">{{ __('Company Logo') }}</label>

                            <div class="col-md-7">
                                <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}" autocomplete="logo">

                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @isset($company)
                            <div class="current-logo">
                                <label for="current-logo" class="col-md-4 col-form-label text-md-end">{{ __('Current Company Logo') }}</label>
                                <img id="current-logo" src="{{ asset('storage/'.$company->logo) }}" width="100" height="100" alt="{{ $company->name }}"/>
                            </div>
                            @endisset
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success">
                                    @if (Request::is('*/create'))
                                    {{ __('Create') }}
                                    @endif
                                    @if (Request::is('*/edit'))
                                    {{ __('Update') }}
                                    @endif
                                </button>
                                <a class="btn btn-danger" href="/companies">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if (Request::is('employees/*'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header"><h5>{{ __('Create Employee') }}</h5></div>

                <div class="card-body">
                    <form method="POST" @if (Request::is('*/create')) action="{{ route('employees.store') }}"@endif @if (Request::is('*/edit') && isset($employee)) update action="{{ route('employees.update', $employee->slug) }}"@endif enctype="multipart/form-data">
                        @csrf
                        @isset($employee)
                            @method('PUT')
                        @endisset

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Employee Fist Name') }}</label>

                            <div class="col-md-7">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" @isset($employee) value="{{ $employee->first_name }}" @else value="{{ old('first_name') }}" @endif required autocomplete="first_name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Employee Last Name') }}</label>

                            <div class="col-md-7">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" @isset($employee) value="{{ $employee->last_name }}" @else value="{{ old('last_name') }}" @endif required autocomplete="last_name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Employee Email') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" @isset($employee) value="{{ $employee->email }}" @else value="{{ old('email') }}" @endif required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Employee Phone') }}</label>

                            <div class="col-md-7">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" @isset($employee) value="{{ $employee->phone }}" @else value="{{ old('phone') }}" @endif required autocomplete="website">

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company_id" class="col-md-4 col-form-label text-md-end">{{ __('Employee Company') }}</label>

                            <div class="col-md-7">
                                <select id="company_id" class="form-control @error('company_id') is-invalid @enderror" name="company_id" value="{{ old('phone') }}" required autocomplete="company_id">
                                    @empty($employee)
                                    <option value="" selected>Please Select Company</option>
                                    @else
                                    <option value="">Please Select Company</option>
                                    @endempty
                                    @foreach ( $companies as $company )
                                    @if ( isset($employee) && $employee->company_id === $company->id )
                                        <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                                    @else
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endisset
                                    @endforeach
                                </select>

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success">
                                    @if (Request::is('*/create'))
                                    {{ __('Create') }}
                                    @endif
                                    @if (Request::is('*/edit'))
                                    {{ __('Update') }}
                                    @endif
                                </button>
                                <a class="btn btn-danger" href="/employees">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
