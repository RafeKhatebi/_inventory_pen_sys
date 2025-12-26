<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارش مشتری - {{ $customer->name }}</title>
    <style>
        body {
            font-family: 'Tahoma', Arial, sans-serif;
            direction: rtl;
            text-align: right;
            margin: 20px;
            font-size: 14px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .customer-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .summary {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .text-danger { color: #dc3545; }
        .text-success { color: #28a745; }
        .text-primary { color: #007bff; }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>گزارش کامل مشتری</h1>
        <h2>{{ $customer->name }}</h2>
        <p>تاریخ گزارش: {{ \App\Helpers\JalaliHelper::format(now()) }}</p>
    </div>

    <div class="customer-info">
        <h3>اطلاعات مشتری</h3>
        <div class="info-row">
            <span><strong>نام:</strong> {{ $customer->name }}</span>
            <span><strong>شناسه:</strong> {{ $customer->id }}</span>
        </div>
        <div class="info-row">
            <span><strong>تلفن:</strong> {{ $customer->phone }}</span>
            <span><strong>تاریخ عضویت:</strong> {{ \App\Helpers\JalaliHelper::format($customer->created_at) }}</span>
        </div>
        <div class="info-row">
            <span><strong>آدرس:</strong> {{ $customer->address }}</span>
            <span><strong>حد اعتبار:</strong> {{ \App\Helpers\CurrencyHelper::format($customer->credit_limit) }}</span>
        </div>
    </div>

    <div class="summary">
        <h3>خلاصه حساب</h3>
        <div class="info-row">
            <span><strong>کل اعتبار گرفته:</strong> <span class="text-danger">{{ \App\Helpers\CurrencyHelper::format($customer->getTotalTaken()) }}</span></span>
            <span><strong>کل پرداختی:</strong> <span class="text-success">{{ \App\Helpers\CurrencyHelper::format($customer->getTotalGiven()) }}</span></span>
        </div>
        <div class="info-row">
            <span><strong>موجودی نهایی:</strong> 
                <span class="{{ $customer->getCurrentCredit() > 0 ? 'text-danger' : 'text-success' }}">
                    {{ \App\Helpers\CurrencyHelper::format($customer->getCurrentCredit()) }}
                </span>
            </span>
            <span><strong>تعداد تراکنش:</strong> {{ $transactions->count() }}</span>
        </div>
    </div>

    @if($transactions->count() > 0)
        <h3>تاریخچه تراکنشها</h3>
        <table>
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>تاریخ</th>
                    <th>نوع تراکنش</th>
                    <th>مبلغ</th>
                    <th>یادداشت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $index => $transaction)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \App\Helpers\JalaliHelper::format($transaction->transaction_date) }}</td>
                        <td>
                            @if($transaction->type === 'take')
                                <span class="text-danger">اعتبار گرفت</span>
                            @else
                                <span class="text-success">پرداخت کرد</span>
                            @endif
                        </td>
                        <td class="{{ $transaction->type === 'take' ? 'text-danger' : 'text-success' }}">
                            {{ $transaction->type === 'take' ? '+' : '-' }}{{ \App\Helpers\CurrencyHelper::format($transaction->amount) }}
                        </td>
                        <td>{{ $transaction->note ?: 'بدون یادداشت' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px;">
            <h3>هیچ تراکنشی یافت نشد</h3>
            <p>این مشتری هنوز هیچ تراکنشی انجام نداده است.</p>
        </div>
    @endif

    <div style="margin-top: 40px; text-align: center; font-size: 12px; color: #666;">
        <p>این گزارش در تاریخ {{ \App\Helpers\JalaliHelper::format(now()) }} ساعت {{ now()->format('H:i') }} تولید شده است.</p>
        <p>سیستم مدیریت انبار - {{ config('app.name', 'انبارداری') }}</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>