@extends('admin.layouts.master')
@section('title', 'Car Mileages')
@section('maincontent')
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Add Mileage</h3>
                </div>

                <!-- Add Mileage Form -->
                <form method="POST" action="{{ route('cars.mileages.store', $carId) }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label>Fuel Type <span class="text-danger">*</span></label>
                                    <select name="fuel_type_id" class="form-control" required>
                                        <option value="">Select Fuel Type</option>
                                        @foreach($fuelTypes as $fuelType)
                                        <option value="{{ $fuelType->id }}">
                                            {{ $fuelType->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div @class(['form-group'])>
                                    <label>Transmission <span @class(['text-danger'])>*</span></label>


                                    <select name="transmission" class="form-control" required>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>
                                        <option value="Clutchless Manual">Clutchless Manual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div @class(['form-group'])>
                                    <label>Mileage <span @class(['text-danger'])>*</span></label>
                                <input type="text" name="mileage" class="form-control" placeholder="Mileage" required>
                            </div>
                            </div>
                            <div class="col-md-2">
                                <div @class(['form-group'])>
                                    <label>City Mileage <span @class(['text-danger'])>*</span></label>
                                <input type="text" name="city_mileage" class="form-control" placeholder="City Mileage" required>
                            </div>
                            </div>
                            <div class="col-md-2">
                                <div @class(['form-group'])>
                                    <label>Highway Mileage <span @class(['text-danger'])>*</span></label>
                                <input type="text" name="highway_mileage" class="form-control" placeholder="Highway Mileage" required>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">Add Mileage</button>
                    </div>
                </form>

                <!-- Existing Mileages Table -->
                <div class="card-body">
                    @if($mileages->count())
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fuel Type</th>
                                    <th>Transmission</th>
                                    <th>Mileage</th>
                                    <th>City Mileage</th>
                                    <th>Highway Mileage</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mileages as $index => $m)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $m->fuelType ? $m->fuelType->name : '-' }} </td>
                                    <td>{{ $m->transmission }}</td>
                                    <td>{{ $m->mileage }}</td>
                                    <td>{{ $m->city_mileage }}</td>
                                    <td>{{ $m->highway_mileage }}</td>
                                    <td>
                                        <form action="{{ route('cars.mileages.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Delete this mileage?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="mt-3">No mileage data added yet.</p>
                    @endif
                </div>
            </div>
        </div>

</section>
@endsection