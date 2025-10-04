@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')

<section @class(['content-header'])>
    <div @class(['row'])>
        <div @class(['col-md-12'])>
            <div @class(['card'])>
                <div @class(['card-header'])>
                    <h3 @class(['card-title'])>{{ $title }}</h3>
                    <a href="{{ route('cars.index') }}" type="button" @class(['btn', 'btn-danger' , 'float-right' ])>Back</a>
                </div>
                <form method="POST" action="{{ route('cars.add-latest-update', $carId) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Notes Textarea -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="notes">Notes <span class="text-danger">*</span></label>
                                    <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Enter latest update notes" required>{{ old('notes') }}</textarea>
                                    @error('notes')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Notes Date -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="notes_date">Date <span class="text-danger">*</span></label>
                                    <input type="date" name="notes_date" id="notes_date" class="form-control" value="{{ old('notes_date', date('Y-m-d')) }}" required>
                                    @error('notes_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle"></i> Add Latest Update
                        </button>
                    </div>
                </form>


                <div class=" col-md-12">
                    @if(isset($latestUpdates) && $latestUpdates->count())
                    <table class="table table-bordered mt-3">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Notes</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestUpdates as $index => $update)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $update->notes }}</td>
                                <td>{{ \Carbon\Carbon::parse($update->notes_date)->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('latest-updates.destroy', encrypt($update->id)) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this update?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                   
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>
@endsection