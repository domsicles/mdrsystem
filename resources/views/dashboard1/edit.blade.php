@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 80%;
        margin: auto;
        padding: 20px;
    }

    h2 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #007bff;
        text-transform: uppercase;
        margin-bottom: 20px;
        text-align: center;
    }

    label {
        font-weight: bold;
        margin-top: 10px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .row {
        margin-bottom: 15px;
    }
</style>

<div class="container">
    <h2>Edit Barangay Population Data</h2>
    
    <form action="{{ route('dashboard1.update', $barangay->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Barangay Name Input -->
        <div class="form-group">
            <label for="name">Barangay Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $barangay->name }}" required>
        </div>

        <!-- Households Input -->
        <div class="form-group">
            <label for="households">Household:</label>
            <input type="number" name="households" class="form-control" value="{{ $barangay->households }}" required>
        </div>

        <!-- Families Input -->
        <div class="form-group">
            <label for="families">Families:</label>
            <input type="number" name="families" class="form-control" value="{{ $barangay->families }}" required>
        </div>

        <!-- Males Input -->
        <div class="form-group">
            <label for="males">Male:</label>
            <input type="number" name="males" class="form-control" value="{{ $barangay->males }}" required>
        </div>

        <!-- Females Input -->
        <div class="form-group">
            <label for="females">Female:</label>
            <input type="number" name="females" class="form-control" value="{{ $barangay->females }}" required>
        </div>

        <!-- LGBTQ Input -->
        <div class="form-group">
            <label for="females">LGBTQ:</label>
            <input type="number" name="lgbtq" class="form-control" value="{{ $barangay->lgbtq }}" required>
        </div>

        <!-- Form Submit and Reset Buttons -->
        <div class="btn-group">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('dashboard1') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection
