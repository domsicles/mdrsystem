@extends('layouts.app')
@section('content')

<style>
    /* Container Styling */
    .content-wrapper {
        max-width: 90%;
        margin: auto;
        padding: 20px;
    }

    /* Title Styling */
    .title {
        font-size: 2rem;
        font-weight: bold;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Buttons Styling */
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

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: scale(1.05);
        color: white;
    }

    .btn-success:hover {
        background-color:rgb(25, 166, 58);
        transform: scale(1.05);
        color: white;
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
        text-align: center;
    }

    .custom-table td {
        padding: 12px;
        text-align: center;
        font-size: 1rem;
    }

    /* Alternating Colors for Barangays */
    .barangay-row-odd {
        background-color: #f8f9fa;
    }

    .barangay-row-even {
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

    /* Search bar styling */
    .search-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        gap: 15px;
    }

    .search-container input {
        padding: 10px;
        font-size: 1rem;
        border-radius: 8px;
        width: 300px;
        border: 1px solid #ccc;
    }

    .search-container button {
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 8px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .search-container button:hover {
        background-color: #0056b3;
    }
</style>

<div class="content-wrapper">
    <!-- Title -->
    <h2 class="title">
        <i class="fas fa-exclamation-triangle"></i> Barangay Hazard Data
    </h2>

    <!-- Search Bar and Buttons -->
    <div class="search-container">
        <form action="{{ route('dashboard2') }}" method="GET">
            <input type="text" name="search" class="form-control" placeholder="Search Barangay..." value="{{ request()->get('search') }}">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Search
            </button>
        </form>
    </div>

    <!-- Action Buttons -->
    <div class="btn-group">
        <a href="{{ route('dashboard2.create') }}" class="btn btn-primary btn-custom shadow">
            <i class="fas fa-plus-circle"></i> Add Hazard Data
        </a>
        <a href="{{ route('dashboard1') }}" class="btn btn-secondary btn-custom shadow">
            <i class="fas fa-chart-bar"></i> Go to Population Data
        </a>
        <a href="{{ route('dashboard2') }}" class="btn btn-success btn-custom shadow">
            <i class="fas fa-eye"></i> See All
        </a>
        <a href="{{ route('export.hazards') }}" class="btn btn-info btn-custom shadow">
            <i class="fas fa-download"></i> Download Excel
        </a>
    </div>

    <!-- Table Container -->
    <div class="table-responsive">
        <table class="table custom-table">
            <thead>
                <tr>
                    <th>Barangay</th>
                    <th>Hazard Type</th>
                    <th>Families Affected</th>
                    <th>Person</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $lastBarangay = null;
                    $barangayIndex = 0; // For alternating colors
                @endphp
                @foreach($hazards as $hazard)
                @php
                    $isNewBarangay = ($lastBarangay !== $hazard->barangay);
                    if ($isNewBarangay) {
                        $barangayIndex++; // Increment index for alternating colors
                        $rowClass = ($barangayIndex % 2 == 0) ? 'barangay-row-even' : 'barangay-row-odd';
                        $barangayCount = $hazards->where('barangay', $hazard->barangay)->count();
                    }
                @endphp
                <tr class="{{ $rowClass }}">
                    @if($isNewBarangay)
                        <td rowspan="{{ $barangayCount }}" class="fw-bold">{{ $hazard->barangay }}</td>
                    @endif
                    <td class="text-danger fw-bold">{{ $hazard->hazard_type }}</td>
                    <td class="text-warning fw-bold">{{ $hazard->families_affected }}</td>
                    <td class="text-primary fw-bold">{{ $hazard->persons }}</td>

                    @if($isNewBarangay)
                        <td rowspan="{{ $barangayCount }}">
                            <a href="{{ route('dashboard2.edit', $hazard->barangay) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $hazard->barangay }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>

                            <form id="delete-form-{{ $hazard->barangay }}" action="{{ route('dashboard2.destroy', $hazard->barangay) }}" method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                        @php
                            $lastBarangay = $hazard->barangay;
                        @endphp
                    @endif
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
                if (confirm('Are you sure you want to delete all hazard data for this Barangay?')) {
                    document.getElementById('delete-form-' + barangayId).submit();
                }
            });
        });
    });
</script>

@endsection
