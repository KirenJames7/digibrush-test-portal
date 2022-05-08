@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @isset($employee)
            <div class="card">
                <div class="card-header">{{ __($employee->first_name.' '.$employee->last_name) }}</div>
                <div class="card-body">
                    <div class="card-text">
                        <div class="text-info">
                            First Name: <span>{{ $employee->first_name }}</span>
                        </div>
                        <div class="text-info">
                            Last Name: <span>{{ $employee->last_name }}</span>
                        </div>
                        <div class="text-info">
                            Email: <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                        </div>
                        <div class="text-info">
                            Phone: <a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('employees.destroy',$employee->slug) }}" method="post">
                        <a class="btn btn-primary" href="{{ route('employees.edit',$employee->slug) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="navbar-brand text-center">
                {{ __($employee->first_name.' '.$employee->last_name) }}'s company details
            </div>
            @endisset
            @isset($employee->company)
            <div class="card">
                <div class="card-header"><a href="/companies/{{ $employee->company->slug }}">{{ __($employee->company->name) }}</a></div>
                <div class="card-body d-flex">
                    <div class="card-info-image">
                        <img src="{{ asset('storage/'.$employee->company->logo) }}" width="100" height="100" alt="{{ $employee->company->name }}"/>
                    </div>
                    <div class="text-info details">
                        <p>Email: <a href="mailto:{{ $employee->company->email }}">{{ $employee->company->email }}</a></p>
                        <p>Website: <a href="{{ $employee->company->website }}" target="_blank" rel="noopener noreferrer">{{ $employee->company->website }}</a></p>
                        <p>No. of Employees: {{ $employee->company->employees->count() }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('companies.destroy',$employee->company->slug) }}" method="post">
                        <a class="btn btn-primary" href="{{ route('employees.edit',$employee->company->slug) }}">Edit</a>
                        @method('GET')
                        <a class="btn btn-secondary" href="/companies/{{ $employee->company->slug }}">View</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
