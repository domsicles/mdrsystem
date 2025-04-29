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
    }

    label {
        font-weight: bold;
        margin-top: 10px;
    }

    input, select {
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

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn:hover {
        opacity: 0.8;
    }

    .row {
        margin-bottom: 15px;
    }
</style>

<div class="container">
    <h2>Add Barangay Population Data</h2>
    
    <form action="{{ route('dashboard1.store') }}" method="POST">
        @csrf

        <!-- Barangay Name Input -->
        <div class="form-group">
            <label for="name">Barangay Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Barangay Name" required>
        </div>

        <!-- Households Input -->
        <div class="form-group">
            <label for="households">Household:</label>
            <input type="number" name="households" class="form-control" placeholder="Enter Number of Households" required>
        </div>

        <!-- Families Input -->
        <div class="form-group">
            <label for="families">Families:</label>
            <input type="number" name="families" class="form-control" placeholder="Enter Number of Families" required>
        </div>

        <!-- Males Input -->
        <div class="form-group">
            <label for="males">Male:</label>
            <input type="number" name="males" class="form-control" placeholder="Enter Number of Males" required>
        </div>

        <!-- Females Input -->
        <div class="form-group">
            <label for="females">Female:</label>
            <input type="number" name="females" class="form-control" placeholder="Enter Number of Females" required>
        </div>

        <!-- LGBTQ Input -->
        <div class="form-group">
            <label for="females">LGBTQ:</label>
            <input type="number" name="lgbtq" class="form-control" placeholder="Enter Number of LGBTQ" required>
        </div>

        <!-- Total Population (Auto-calculated) -->
        <div class="form-group">
            <label for="population">Total Population:</label>
            <input type="number" id="population" name="population" class="form-control" placeholder="Total Population" readonly required>
        </div>

        <!-- Form Submit and Reset Buttons -->
        <div class="btn-group">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('dashboard1') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Update the total population field dynamically when males or females is changed
    document.addEventListener('input', function () {
        var males = parseInt(document.querySelector('input[name="males"]').value) || 0;
        var females = parseInt(document.querySelector('input[name="females"]').value) || 0;
        var lgbtq = parseInt(document.querySelector('input[name="lgbtq"]').value) || 0;
        var population = males + females + lgbtq;
        document.getElementById('population').value = population;
    });
</script>

@endsection
