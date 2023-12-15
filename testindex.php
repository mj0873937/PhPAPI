<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Data</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Stock Data</h1>
        <div id="stockInfo" class="styled-table"></div>
    </div>

    <script>
        // Function to fetch stock data and update the DOM
        function getStockData() {
            axios.get('WoWapi.php')  // Replace 'YOUR_API_URL' with the actual URL of your PHP API
                .then(function (response) {
                    const stocks = response.data;
                    let html = '<table>';
                    html += '<thead><tr><th>Season</th><th>Set Name</th><th>Class</th><th>Armor Type</th></tr></thead>';
                    html += '<tbody>';
                    stocks.forEach(stock => {
                        html += `<tr><td>${stock.Season}</td><td>${stock.Set_Name}</td><td>${stock.Class}</td><td>${stock.Armor_Type}</td></tr>`;
                    });
                    html += '</tbody></table>';
                    document.getElementById('stockInfo').innerHTML = html;
                })
                .catch(function (error) {
                    console.error("Error fetching stock data:", error);
                });
        }

        // Call the function on page load
        getStockData();
    </script>
</body>

</html>
