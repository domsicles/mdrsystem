@extends('layouts.app')
@section('content')

<style>
    /* Centering and container styling */
    .content-wrapper {
        max-width: 90%;
        margin: auto;
        padding: 20px;
    }

    /* Title styling */
    .title {
        font-size: 2rem;
        font-weight: bold;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Search Bar Container */
    .search-bar-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
        animation: fadeIn 1s ease-out;
    }

    /* Form width */
    .search-bar-container form {
        display: flex;
        width: 80%;  /* Adjust this width to match your layout */
        max-width: 800px; /* Max width to prevent it from growing too large */
    }

    /* Input field styling */
    .search-bar-container input {
        flex: 1; /* Makes the input field fill the available space */
        padding: 10px 20px;
        font-size: 1rem;
        height: 40px;
        border-radius: 50px 0 0 50px; /* Round left corners */
        border: 2px solid #dcdcdc;
        outline: none;
        background: linear-gradient(135deg, #f0f0f0, #ffffff);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease-in-out;
    }

    /* Focus on input */
    .search-bar-container input:focus {
        border-color: #3498db;
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.5);
        background: linear-gradient(135deg, #ffffff, #e9f7fe);
    }

    /* Search button styling */
    .search-bar-container button {
        background-color: #3498db;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 0 50px 50px 0; /* Round right corners */
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 40px; /* Same height as input */
    }

    /* Hover effect on button */
    .search-bar-container button:hover {
        background-color: #2980b9;
        transform: scale(1.05);
    }

    /* Icon in the button */
    .search-bar-container button i {
        margin-right: 8px;
        transition: all 0.3s ease;
    }

    /* Icon rotation on hover */
    .search-bar-container button:hover i {
        transform: rotate(360deg);
    }

    /* Action buttons */
    .btn-group {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .btn-custom {
        padding: 12px 20px;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 8px;
        transition: 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: scale(1.05);
        color: white;
    }

    .btn-outline-dark:hover {
        background-color: #343a40;
        color: white;
        transform: scale(1.05);
    }
    
    .btn-secondary:hover {
        background-color:rgb(6, 130, 255);
        color: white;
        transform: scale(1.05);
    }

    .btn-info:hover {
        background-color:rgb(19, 109, 153);
        transform: scale(1.05);
        color: white;
    }

    /* Table Styling */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .custom-table th {
        background-color: #2c3e50;
        color: white;
        padding: 12px;
        text-transform: uppercase;
    }

    .custom-table td {
        padding: 12px;
        text-align: center;
        font-size: 1rem;
    }

    .custom-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .custom-table tr:hover {
        background-color: #e9ecef;
    }

    /* Action buttons */
    .btn-sm {
        padding: 6px 12px;
        font-size: 0.9rem;
        border-radius: 6px;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Fade-in animation */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="content-wrapper">
    <!-- Title -->
    <h2 class="title">
        <i class="fas fa-chart-bar"></i> Barangay Population Data
    </h2>

    <!-- Search Bar -->
    <div class="search-bar-container">
        <form action="{{ route('dashboard1') }}" method="GET" class="w-100">
            <input type="text" name="search" class="form-control" placeholder="Search Barangay..." value="{{ request()->get('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
        </form>
    </div>

    <!-- Action Buttons -->
    <div class="btn-group d-flex justify-content-center mb-4">
        <a href="{{ route('dashboard1.create') }}" class="btn btn-success btn-custom shadow">
            <i class="fas fa-plus-circle"></i> Add Barangay Data
        </a>
        <a href="{{ route('dashboard2') }}" class="btn btn-outline-dark btn-custom shadow">
            <i class="fas fa-map-marked-alt"></i> Go to Hazard Data
        </a>
        <!-- See All Button -->
        <a href="{{ route('dashboard1') }}" class="btn btn-secondary btn-custom shadow">
            <i class="fas fa-list"></i> See All
        </a>
        <a href="{{ route('export.barangays') }}" class="btn btn-info btn-custom shadow">
            <i class="fas fa-download"></i> Download Excel
        </a>
    </div>


    <!-- Table Container -->
    <div class="table-responsive">
        <table class="table custom-table">
            <thead>
                <tr>
                    <th>Barangay</th>
                    <th>Household</th>
                    <th>Families</th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>LGBTQ</th>
                    <th>Total Population</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangays as $barangay)
                <tr>
                    <td>{{ $barangay->name }}</td>
                    <td>{{ $barangay->households }}</td>
                    <td>{{ $barangay->families }}</td>
                    <td class="text-primary fw-bold">{{ $barangay->males }}</td>
                    <td class="text-danger fw-bold">{{ $barangay->females }}</td>
                    <td class="text-secondary fw-bold">{{ $barangay->lgbtq }}</td>
                    <td class="fw-bold text-success">{{ $barangay->population }}</td>
                    <td>
                        <a href="{{ route('dashboard1.edit', $barangay->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $barangay->id }}">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>

                        <form id="delete-form-{{ $barangay->id }}" action="{{ route('dashboard1.destroy', $barangay->id) }}" method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript for Delete Confirmation -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let barangayId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this record?')) {
                    document.getElementById('delete-form-' + barangayId).submit();
                }
            });
        });
    });
</script>

@endsection
