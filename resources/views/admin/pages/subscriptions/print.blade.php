<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>طباعة المشاركين</title>
    <style>
        body { font-family: Arial, sans-serif; direction: rtl; margin: 10px; font-size: 12px; }
        .date-section { margin-bottom: 15px; }
        .date-header { font-size: 18px; font-weight: bold; margin-bottom: 10px; text-align: center; }
        .city-section { margin-bottom: 15px; page-break-before: always; }
        .date-section .city-section:first-child { page-break-before: auto; }
        .city-header { font-size: 16px; font-weight: bold; margin-bottom: 5px; background: #f0f0f0; padding: 5px; }
        .gender-tables { display: flex; gap: 10px; }
        .gender-table { flex: 1; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; font-size: 11px; }
        th { background: #667eea; color: white; padding: 4px; text-align: center; }
        td { border: 1px solid #ddd; padding: 3px 5px; }
        @media print {
            .no-print { display: none; }
            body { margin: 5px; }
        }
    </style>
</head>
<body>
    <button class="no-print" onclick="window.print()" style="margin: 10px; padding: 8px 15px; background: #667eea; color: white; border: none; cursor: pointer;">طباعة</button>

    @foreach($dates as $dateIndex => $date)
        @php
            $dateHasData = $data->where('participation_date', $date)->filter(function($item) {
                return $item->user;
            })->count() > 0;
        @endphp
        
        @if($dateHasData)
        <div class="date-section">
            <div class="date-header">يوم {{ $date }}</div>
            
            @foreach($cities as $cityIndex => $city)
                @php
                    $maleData = $data->where('participation_date', $date)
                                     ->filter(function($item) use ($city) {
                                         return $item->user && $item->user->city_id == $city->id && $item->user->gender == 'male';
                                     });
                    $femaleData = $data->where('participation_date', $date)
                                       ->filter(function($item) use ($city) {
                                           return $item->user && $item->user->city_id == $city->id && $item->user->gender == 'female';
                                       });
                    $maleCount = $maleData->count();
                    $femaleCount = $femaleData->count();
                    $totalCount = $maleCount + $femaleCount;
                @endphp
                
                @if($totalCount > 0)
                    <div class="city-section" style="{{ ($dateIndex == 0 && $loop->first) ? 'page-break-before: auto;' : '' }}">
                        <div class="city-header">{{ $city->name_ar }} - الإجمالي: {{ $totalCount }}</div>
                        
                        <div class="gender-tables">
                            <div class="gender-table">
                                <table>
                                    <thead>
                                        <tr><th>رجال ({{ $maleCount }})</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($maleData as $item)
                                            <tr><td>{{ $item->user->username }}</td></tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="gender-table">
                                <table>
                                    <thead>
                                        <tr><th>نساء ({{ $femaleCount }})</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($femaleData as $item)
                                            <tr><td>{{ $item->user->username }}</td></tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @endif
    @endforeach
</body>
</html>
