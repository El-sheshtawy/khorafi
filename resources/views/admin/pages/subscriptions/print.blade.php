<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>طباعة المشاركين</title>
    <style>
        body { font-family: Arial, sans-serif; direction: rtl; }
        .date-section { page-break-before: always; margin-bottom: 30px; }
        .date-section:first-child { page-break-before: auto; }
        .date-header { font-size: 24px; font-weight: bold; margin-bottom: 20px; text-align: center; }
        .city-section { margin-bottom: 30px; }
        .city-header { font-size: 20px; font-weight: bold; margin-bottom: 10px; background: #f0f0f0; padding: 10px; }
        .gender-tables { display: flex; gap: 20px; }
        .gender-table { flex: 1; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #667eea; color: white; padding: 8px; text-align: center; }
        td { border: 1px solid #ddd; padding: 8px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <button class="no-print" onclick="window.print()" style="margin: 20px; padding: 10px 20px; background: #667eea; color: white; border: none; cursor: pointer;">طباعة</button>

    @foreach($dates as $date)
        <div class="date-section">
            <div class="date-header">يوم {{ $date }}</div>
            
            @foreach($cities as $city)
                @php
                    $maleData = $data->where('participation_date', $date)
                                     ->where('user.city_id', $city->id)
                                     ->where('user.gender', 'male');
                    $femaleData = $data->where('participation_date', $date)
                                       ->where('user.city_id', $city->id)
                                       ->where('user.gender', 'female');
                @endphp
                
                @if($maleData->count() > 0 || $femaleData->count() > 0)
                    <div class="city-section">
                        <div class="city-header">{{ $city->name_ar }}</div>
                        
                        <div class="gender-tables">
                            <div class="gender-table">
                                <table>
                                    <thead>
                                        <tr><th>رجال</th></tr>
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
                                        <tr><th>نساء</th></tr>
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
    @endforeach
</body>
</html>
