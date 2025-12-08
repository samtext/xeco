<!DOCTYPE html>
<html>
<head>
    <title>C2B Dashboard</title>
    <style>
        table { width: 80%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">C2B Transactions Dashboard</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaction ID</th>
                <th>Phone</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->phone }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to fetch latest transactions
        function fetchTransaction() {
            $.get('/api/transaction', function(data) {
                let tbody = '';
                data.forEach(function(tx) {
                    tbody += `<tr>
                        <td>${tx.id}</td>
                        <td>${tx.transaction_id}</td>
                        <td>${tx.phone}</td>
                        <td>${tx.amount}</td>
                        <td>${tx.status}</td>
                        <td>${tx.created_at}</td>
                    </tr>`;
                });
                $('table tbody').html(tbody);
            });
        }

        // Fetch transactions every 5 seconds
        setInterval(fetchTransaction, 5000);

        // Initial fetch
        fetchTransaction();
    </script>
</body>
</html>
