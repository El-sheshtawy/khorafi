<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إحصائية التوزيع</title>
    <style>
        body { font-family: Arial, sans-serif; direction: rtl; margin: 10px; font-size: 14px; }
        .city-section { margin-bottom: 30px; page-break-after: always; }
        .city-section:last-child { page-break-after: auto; }
        .city-header { font-size: 22px; font-weight: bold; margin-bottom: 20px; text-align: center; background: #667eea; color: white; padding: 15px; border-radius: 8px; }
        .stats-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .stats-table th { background: #667eea; color: white; padding: 12px; text-align: center; border: 1px solid #ddd; font-size: 16px; }
        .stats-table td { border: 1px solid #ddd; padding: 10px; text-align: center; font-size: 15px; }
        .stats-table tr:nth-child(even) { background: #f8f9fa; }
        .total-row { background: #e8eef5 !important; font-weight: bold; font-size: 16px; }
        @media print {
            .no-print { display: none; }
            body { margin: 5px; }
        }
    </style>
</head>
<body>
    <button class="no-print" onclick="window.print()" style="margin: 10px; padding: 8px 15px; background: #667eea; color: white; border: none; cursor: pointer; border-radius: 5px;">طباعة</button>

    @foreach($cities as $city)
        @php
            $cityHasData = $data->filter(function($item) use ($city) {
                return $item->user && $item->user->city_id == $city->id;
            })->count() > 0;
        @endphp
        
        @if($cityHasData)
        <div class="city-section">
            <div class="city-header">{{ $city->name_ar }}</div>
            
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>التاريخ</th>
                        <th>رجال</th>
                        <th>نساء</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cityTotalMale = 0;
                        $cityTotalFemale = 0;
                    @endphp
                    
                    @foreach($dates as $date)
                        @php
                            $maleCount = $data->where('participation_date', $date)
                                             ->filter(function($item) use ($city) {
                                                 return $item->user && $item->user->city_id == $city->id && $item->user->gender == 'male';
                                             })->count();
                            $femaleCount = $data->where('participation_date', $date)
                                               ->filter(function($item) use ($city) {
                                                   return $item->user && $item->user->city_id == $city->id && $item->user->gender == 'female';
                                               })->count();
                            $totalCount = $maleCount + $femaleCount;
                            
                            $cityTotalMale += $maleCount;
                            $cityTotalFemale += $femaleCount;
                        @endphp
                        
                        @if($totalCount > 0)
                        <tr>
                            <td>{{ $date }}</td>
                            <td>{{ $maleCount }}</td>
                            <td>{{ $femaleCount }}</td>
                            <td><strong>{{ $totalCount }}</strong></td>
                        </tr>
                        @endif
                    @endforeach
                    
                    <tr class="total-row">
                        <td>الإجمالي الكلي</td>
                        <td>{{ $cityTotalMale }}</td>
                        <td>{{ $cityTotalFemale }}</td>
                        <td><strong>{{ $cityTotalMale + $cityTotalFemale }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    @endforeach
</body>
</html>
