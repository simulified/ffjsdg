@extends('layouts.app')

@section('content')
    <h1>Send Trade</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Your Inventory</div>
                <div class="card-body">
                    <div class="row">
                        @foreach($items as $item)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        @if($item->itemData)
                                            <img src="{{ $item->itemData->image }}" alt="{{ $item->itemData->name }}" class="mr-2" style="width: 30px; height: 30px;">
                                            {{ $item->itemData->name }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Other Person's Inventory</div>
                <div class="card-body">
                    <div class="row">
                        @foreach($otherPersonItems as $item)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        @if($item->itemData)
                                            <img src="{{ $item->itemData->image }}" alt="{{ $item->itemData->name }}" class="mr-2" style="width: 30px; height: 30px;">
                                            {{ $item->itemData->name }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
