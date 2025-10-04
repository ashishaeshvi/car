@extends('admin.layouts.master')
@section('title', 'Car FAQs')
@section('maincontent')

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Add FAQ</h3>
    </div>

    <!-- Add FAQ Form -->
    <form method="POST" action="{{ route('cars.faqs.store', $carId) }}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <select name="section" class="form-control" required>
                        <option value="">Select Section</option>
                        <option value="Price" {{ old('section') == 'Price' ? 'selected' : '' }}>Price</option>
                        <option value="Performance" {{ old('section') == 'Performance' ? 'selected' : '' }}>Performance</option>
                        <option value="Specifications" {{ old('section') == 'Specifications' ? 'selected' : '' }}>Specifications</option>
                        <option value="Other" {{ old('section') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('section')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <input type="text" name="question" class="form-control" placeholder="Question" required>
                </div>
                <div class="col-md-5">
                    <textarea name="answer" class="form-control" rows="2" placeholder="Answer" required></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success">Add FAQ</button>
        </div>
    </form>

    <!-- Existing FAQs Table -->
    <div class="card-body">
        @if($faqs->count())
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Section</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $index => $faq)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $faq->section }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <form action="{{ route('cars.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Delete this FAQ?')">
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
        @endif
    </div>
</div>

@endsection