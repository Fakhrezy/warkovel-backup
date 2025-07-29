<!DOCTYPE html>
<html>
<head>
    <title>Cart Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Cart Functionality Test</h1>

    <div id="status"></div>

    <button onclick="testAddToCart()">Test Add to Cart</button>
    <button onclick="testCartStatus()">Check Cart Status</button>
    <button onclick="testClearCart()">Test Clear Cart</button>

    <div id="results"></div>

    <script>
        function updateStatus(message) {
            document.getElementById('status').innerHTML = message;
            console.log(message);
        }

        function testAddToCart() {
            updateStatus('Testing Add to Cart...');

            fetch('/kasir/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    menu_id: 1, // Assuming menu ID 1 exists
                    jumlah: 1
                })
            })
            .then(response => {
                updateStatus('Response status: ' + response.status);
                return response.json();
            })
            .then(data => {
                updateStatus('Add to cart success: ' + JSON.stringify(data));
                document.getElementById('results').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            })
            .catch(error => {
                updateStatus('Add to cart error: ' + error.message);
                console.error('Error:', error);
            });
        }

        function testCartStatus() {
            updateStatus('Checking cart status...');

            fetch('/kasir', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                updateStatus('Cart status response: ' + response.status);
                return response.text();
            })
            .then(data => {
                updateStatus('Cart status retrieved');
                console.log('Cart response:', data);
            })
            .catch(error => {
                updateStatus('Cart status error: ' + error.message);
                console.error('Error:', error);
            });
        }

        function testClearCart() {
            updateStatus('Testing Clear Cart...');

            fetch('/kasir/cart/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                updateStatus('Clear cart response status: ' + response.status);
                return response.json();
            })
            .then(data => {
                updateStatus('Clear cart success: ' + JSON.stringify(data));
                document.getElementById('results').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            })
            .catch(error => {
                updateStatus('Clear cart error: ' + error.message);
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
