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
            @isset($company)
                <div class="card">
                    <div class="card-header">{{ __($company->name) }}</div>
                    <div class="card-body d-flex">
                        <div class="card-info-image">
                            <img src="{{ asset('storage/'.$company->logo) }}" width="100" height="100" alt="{{ $company->name }}"/>
                        </div>
                        <div class="text-info details">
                            <p>Email: <a href="mailto:{{ $company->email }}">{{ $company->email }}</a></p>
                            <p>Website: <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer">{{ $company->website }}</a></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('companies.destroy',$company->slug) }}" method="post">
                            <a class="btn btn-primary" href="{{ route('companies.edit',$company->slug) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
                <hr>
            <div class="navbar-brand text-center">
                {{ $company->name }} Employees: | No. of Employees {{ $company->employees->count() }}
            </div>
            @endisset
            @isset($employees)
            @foreach( $employees as $employee )
            <div class="card">
                <div class="card-header"><a href="/employees/{{ $employee->slug }}">{{ __($employee->first_name.' '.$employee->last_name) }}</a></div>
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
                        @method('GET')
                        <a class="btn btn-secondary" href="/employees/{{ $employee->slug }}">View</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
            <div>
                {{ $employees->links() }}
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
