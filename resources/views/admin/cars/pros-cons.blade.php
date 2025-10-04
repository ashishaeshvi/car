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
                <form method="POST" action="{{ route('cars.add-pros-cons', $carId) }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Type Dropdown -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="pro" {{ old('type') == 'pro' ? 'selected' : '' }}>Pros</option>
                                        <option value="con" {{ old('type') == 'con' ? 'selected' : '' }}>Cons</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description Textarea -->
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description" required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle"></i> Add Pro/Con
                        </button>
                    </div>
                </form>



                <div class="col-md-12">
                    @if(isset($prosCons) && $prosCons->count())
                    <table class="table table-bordered mt-3">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prosCons as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ ucfirst($item->type) }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <form action="{{ route('pros-cons.destroy', encrypt($item->id)) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this item?')">
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