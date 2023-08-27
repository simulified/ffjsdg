@extends('layouts.admin')

@section('title', 'Sales Log')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('users.sales') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by purchaser or seller username" name="search" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h1><b>Sales Log</b></h1>
    <p>who's money laundering and who's not?</p>
    @if ($actions->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Seller</th>
                <th scope="col">Purchaser</th>
                <th scope="col">Action</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actions as $action)
                <tr>
                    <th scope="row">{{ $action->id }}</th>
                    <td><a href="{{ route('users.profile', $action->seller->id) }}">{{ $action->seller->username }}</a></td>
                    <td><a href="{{ route('users.profile', $action->purchaser->id) }}">{{ $action->purchaser->username }}</a></td>
                    <td>
                        @php
                            $item = \App\Models\Item::find($action->product_id);
                        @endphp
                        @if ($item)
                            <a href="{{ route('item.view', $item->id) }}">{{ $item->name }}</a>
                        @else
                            DELETED ITEM
                        @endif
                        for D${{ $action->purchase_price }}
                    </td>
                    <td>{{ $action->updated_at->toDayDateTimeString() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $actions->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
    </div>
    @else
    <hr>
    <div class="text-center">
        <h1>No actions found</h1>
        <p>You really should start doing something!</p>
    </div>
    @endif
</div>
@endsection
