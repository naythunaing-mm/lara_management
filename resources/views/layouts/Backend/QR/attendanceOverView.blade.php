@extends('layouts.Backend.master')
@section('title', 'attendance-Overivew')
@section('content')

<div class="container-xxl vh-100">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="month"></label>
                        @php
                            $currentMonth = \Carbon\Carbon::now()->month;
                        @endphp
                        <select name="month" class="form-control" id="month">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == $currentMonth ? 'selected' : '' }}>{{ \Carbon\Carbon::createFromDate(null, $i, 1)->format('F') }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="month"></label>
                        @php
                        $currentYear = \Carbon\Carbon::now()->year; 
                        $startYear = $currentYear - 10; 
                        @endphp
                        <select name="year" class="form-control" id="year">
                            @for ($year = $currentYear; $year >= $startYear; $year--)
                            <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <button class="btn btn-success btn-block" id="search"><i class="fas fa search"></i>Search</button>
                </div>
            </div>
            <div class="attendance-over-view-table">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        function attendanceOverViewTable(month, year) {
            $.ajax({
                url: `/admin-backend/attendance-overview-table?month=${month}&year=${year}`,
                type: 'GET',
                success: function(res) {
                    $('.attendance-over-view-table').html(res);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching attendance overview table:', error);
                }
            });
        }
        const month = new Date().getMonth() + 1;
        const year = new Date().getFullYear();
        attendanceOverViewTable(month,year);
        $('#search').on('click', function(event){
            event.preventDefault();
            var month = $('#month').val();
            var year = $('#year').val();
            attendanceOverViewTable(month, year);
        });
    </script>
@endsection

