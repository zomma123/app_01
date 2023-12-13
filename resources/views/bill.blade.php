<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ໃບບິນຮັບເງິນ</title>
       <!-- font lao -->
<link rel="stylesheet" href="../../css/font_lao.css">
 
 <!-- Icons -->
 <link rel="icon" href="../../assets/img/avatars/22.jpg">
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

 <!-- Core CSS -->
 <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css">
 <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css">
 <link rel="stylesheet" href="../../assets/css/demo.css">

 <!-- Vendors CSS -->
 <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
 <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css">
 <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css">
</head>
<body>

<div class="container text-center">
            ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</br>
        <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ</p>

        <h2 class="mt-4">ໃບບິນຮັບເງິນ</h2>
        
        <div class=" d-flex justify-content-between mb-2">
        <div class="text-start">
           @if($bills[0]['cus_name']=='')
            ລູກຄ້າ: ລູກຄ້າທົ່ວໄປ
            @else
            ລູກຄ້າ: {{ $bills[0]['cus_name'] }}, ເບີໂທ: {{$bills[0]['cus_tel']}}
            @endif
        </div>
        <span>ໃບບິນເລກທີ່: {{$bill_id}} </span>
        </div>

        <table class="table table-bordered">
            <thead>
                <th width="80">ລ/ດ</th>
                <th class="text-start">ລາຍການ</th>
                <th width="120">ລາຄາ</th>
                <th width="90">ຈຳນວນ</th>
                <th width="160">ລວມ</th>
            </thead>
            <tbody>
                    @php($num=1)
                    @php($total=0)
                    @foreach($bill_lists as $b)
                    <tr>
                        <td>{{$num++}}</td>
                        <td class="text-start">{{ $b['name'] }}</td>
                        <td class="text-end">{{ number_format($b['price'],0,',','.') }} </td>
                        <td class="text-center">{{ $b['amount'] }}</td>
                        <td class="text-end">{{ number_format($b['price']*$b['amount'],0,',','.') }}</td>
                        @php($total += $b['price']*$b['amount'])
                    </tr>
                    @endforeach
                <tr>
                    <td colspan='4' > ລວມທັງໝົດ </td>
                    <td class="text-end">   {{number_format($total,0,',','.')}}</td>
                </tr>
            </tbody>
        </table>
        <div class=" d-flex justify-content-between p-4">
            <span >ພະນັກງານ</span>
            <span >ຜູ້ຈ່າຍເງິນ</span>
        </div>
    </div>
    <script>
        window.print();
        setTimeout('window.close();', 3000);
    </script>
</body>
</html>
