@extends('layouts.Backend.master')
@section('title', 'attendance-Overivew')
@section('content')

<div class="container-xxl vh-100">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <th>Employee</th>
                        @foreach($periods as $period)
                            <th>{{$period->format('d')}}</th>
                        @endforeach
                    </thead>
                    <tbody>
                    @foreach($employeeList as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        @foreach($periods as $period)
                            @php
                                $checkin_icon = '';
                                $checkout_icon = '';
                                $attendance = collect($attendances)
                                    ->first(function ($item) use ($employee, $period) {
                                        return $item['user_id'] == $employee->id && $item['date'] == $period->format('Y-m-d');
                                    });

                                if ($attendance) {
                                    $attendanceCheckinTime = \Carbon\Carbon::parse($attendance['created_at'])
                                        ->setTimezone('Asia/Yangon')
                                        ->format('H:i');

                                    $attendanceCheckoutTime = \Carbon\Carbon::parse($attendance['updated_at'])
                                    ->setTimezone('Asia/Yangon')
                                    ->format('H:i');

                                    $checkin_icon = '';
                                    $checkout_icon = '';

                                    $siteCheckin = getSiteSetting()->checkin;
                                    $siteCheckout = getSiteSetting()->checkout;
                                    $breakStart = getSiteSetting()->break_start;
                                    $breakEnd = getSiteSetting()->break_end;

                                    if ($attendanceCheckinTime < $siteCheckin) {
                                        $checkin_icon = "<box-icon name='badge-check' type='solid' color='#2ebf0c'></box-icon>";
                                    } elseif ($attendanceCheckinTime > $siteCheckin && $attendanceCheckinTime < $breakStart) {
                                        $checkin_icon = "<box-icon name='badge-check' type='solid' color='#e0bb22'></box-icon>";
                                    }else {
                                        $checkin_icon = "<box-icon name='x-circle' type='solid' color='#e84d0d'></box-icon>";
                                    }

                                    if ($attendanceCheckoutTime > $breakEnd) {
                                        $checkout_icon = "<box-icon name='badge-check' type='solid' color='#2ebf0c'></box-icon>";
                                    } elseif ($attendanceCheckoutTime > $breakEnd && $attendanceCheckoutTime < $siteCheckout) {
                                        $checkout_icon = "<box-icon name='badge-check' type='solid' color='#e0bb22'></box-icon>";
                                    } else {
                                        $checkout_icon = "<box-icon name='x-circle' type='solid' color='#e84d0d'></box-icon>";
                                    }

                                }
                            @endphp
                            <td>
                                <div>{!! $checkin_icon !!}</div>
                                <div>{!! $checkout_icon !!}</div>
                            </td>
                        @endforeach
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
