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

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        background: white;
    }

    th, td {
        border: 1px solid black;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #2c3e50;
        color: white;
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

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>

<div class="container">
    <h2>CREATE NEW DATA – DASHBOARD 2</h2>

    <form action="{{ route('dashboard2.store') }}" method="POST">
        @csrf

        <!-- Barangay Input (Single) -->
        <label for="barangay">Barangay:</label>
        <input type="text" name="barangay" id="barangay" placeholder="Input Barangay" required>

        <label>Other Info.:</label>

        <!-- Hazard Data Table -->
        <table id="hazardTable">
            <thead>
                <tr>
                    <th>Hazard Type</th>
                    <th>No. of Family Affected</th>
                    <th>No. of Person</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="hazard_type[]" required></td>
                    <td><input type="number" name="families_affected[]" required></td>
                    <td><input type="number" name="persons[]" required></td>
                    <td>
                        <button type="button" class="btn btn-danger removeRow">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Add Row Button -->
        <button type="button" class="btn btn-primary" id="addRow">+ Add More</button>

        <!-- Form Action Buttons -->
        <div class="btn-group">
            <button type="submit" class="btn btn-success">SAVE</button>
            <button type="reset" class="btn btn-danger">CLEAR</button>
        </div>
    </form>
</div>

<!-- JavaScript for Dynamic Row Management -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addRow").addEventListener("click", function() {
            let tableBody = document.querySelector("#hazardTable tbody");
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td><input type="text" name="hazard_type[]" required></td>
                <td><input type="number" name="families_affected[]" required></td>
                <td><input type="number" name="persons[]" required></td>
                <td>
                    <button type="button" class="btn btn-danger removeRow">Remove</button>
                </td>
            `;
            tableBody.appendChild(newRow);
        });

        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("removeRow")) {
                event.target.closest("tr").remove();
            }
        });
    });
</script>

@endsection
