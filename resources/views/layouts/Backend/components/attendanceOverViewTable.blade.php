<div class="table-responsive text-nowrap">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th>
                @foreach($periods as $period)
                    <th>{{$period->format('d')}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($employeeList as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    @foreach($periods as $period)
                        @php
                            $isWeekendDay = false;
                            $isPublicHoliday = false;
                            $weekendDayName = null;
                            $holidayName = null;
                            $weekendDayDate = [];
                            $publicHolidayDate = [];
                            foreach ($weekends as $date) {
                                $weekendDayDate[] = $date['date'];
                                if ($date['date'] == $period->format('Y-m-d')) {
                                    $isWeekendDay = true;
                                    $weekendDayName = $date['name'];
                                    break;
                                }
                            }
                            foreach ($publicHolidays as $holiday) {
                                $publicHolidayDate[] = $holiday['date'];
                                if ($holiday['date'] == $period->format('Y-m-d')) {
                                    $isPublicHoliday = true;
                                    $holidayName = $holiday['name'];
                                    break;
                                }
                            }
                            $weekends_holidays = array_merge($weekendDayDate, $publicHolidayDate);
                            $isAttendanceDay = !in_array($period->format('Y-m-d'), $weekends_holidays);
                        @endphp
                        <td>
                            @if(!$isAttendanceDay)
                                @if($isPublicHoliday)
                                    @foreach(explode(' ', $holidayName) as $word)
                                        <div>{{ $word }}</div>
                                    @endforeach
                                @elseif($isWeekendDay)
                                    {{$weekendDayName}}
                                @endif
                            @else
                                @php
                                    $attendance = collect($attendances)
                                        ->first(function ($item) use ($employee, $period) {
                                            return $item['user_id'] == $employee->id && $item['date'] == $period->format('Y-m-d');
                                        });

                                    if (!$attendance) {
                                        $checkin_icon = '--';
                                        $checkout_icon = '--';
                                    } else {
                                        $attendanceCheckinTime = \Carbon\Carbon::parse($attendance['created_at'])
                                            ->setTimezone('Asia/Yangon')
                                            ->format('H:i');

                                        $attendanceCheckoutTime = \Carbon\Carbon::parse($attendance['updated_at'])
                                            ->setTimezone('Asia/Yangon')
                                            ->format('H:i');

                                        $siteCheckin = getSiteSetting()->checkin;
                                        $siteCheckout = getSiteSetting()->checkout;
                                        $breakStart = getSiteSetting()->break_start;
                                        $breakEnd = getSiteSetting()->break_end;

                                        if ($attendanceCheckinTime < $siteCheckin) {
                                            $checkin_icon = "<box-icon name='badge-check' type='solid' color='#2ebf0c'></box-icon>";
                                        } elseif ($attendanceCheckinTime > $siteCheckin && $attendanceCheckinTime < $breakStart) {
                                            $checkin_icon = "<box-icon name='badge-check' type='solid' color='#e0bb22'></box-icon>";
                                        } else {
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
                                <div>{!! $checkin_icon !!}</div>
                                <div>{!! $checkout_icon !!}</div>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
