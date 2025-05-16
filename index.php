<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        input[type="number"] {
            width: 80px;
            text-align: center;
        }
        button {
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .results {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .results h3 {
            margin-bottom: 10px;
        }
        .results div {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .percentage {
            color: #2196F3;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Exchange Calculator</h1>
    <p>Kendi besin planınıza göre "Exchange" değerlerini giriniz ve sonuçları hesaplayınız.</p>
    <table id="exchange-table">
        <thead>
            <tr>
                <th>Food Groups</th>
                <th>Exchange</th>
                <th>CHO (g)</th>
                <th>Protein (g)</th>
                <th>Fat (g)</th>
                <th>CHO (g) x Exchange</th>
                <th>Protein (g) x Exchange</th>
                <th>Fat (g) x Exchange</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Milk</td>
                <td><input type="number" value="1" class="exchange" data-cho="9" data-protein="6" data-fat="6" oninput="calculateRow(this)"></td>
                <td>9</td>
                <td>6</td>
                <td>6</td>
                <td class="cho-total">9</td>
                <td class="protein-total">6</td>
                <td class="fat-total">6</td>
            </tr>
            <tr>
                <td>Meat</td>
                <td><input type="number" value="1" class="exchange" data-cho="0" data-protein="6" data-fat="5" oninput="calculateRow(this)"></td>
                <td>0</td>
                <td>6</td>
                <td>5</td>
                <td class="cho-total">0</td>
                <td class="protein-total">6</td>
                <td class="fat-total">5</td>
            </tr>
            <tr>
                <td>Bread & Bread Sub.</td>
                <td><input type="number" value="1" class="exchange" data-cho="15" data-protein="2" data-fat="0" oninput="calculateRow(this)"></td>
                <td>15</td>
                <td>2</td>
                <td>0</td>
                <td class="cho-total">15</td>
                <td class="protein-total">2</td>
                <td class="fat-total">0</td>
            </tr>
            <tr>
                <td>Vegetables</td>
                <td><input type="number" value="1" class="exchange" data-cho="6" data-protein="2" data-fat="0" oninput="calculateRow(this)"></td>
                <td>6</td>
                <td>2</td>
                <td>0</td>
                <td class="cho-total">6</td>
                <td class="protein-total">2</td>
                <td class="fat-total">0</td>
            </tr>
            <tr>
                <td>Fruits</td>
                <td><input type="number" value="1" class="exchange" data-cho="15" data-protein="0" data-fat="0" oninput="calculateRow(this)"></td>
                <td>15</td>
                <td>0</td>
                <td>0</td>
                <td class="cho-total">15</td>
                <td class="protein-total">0</td>
                <td class="fat-total">0</td>
            </tr>
            <tr>
                <td>Fats & Oils</td>
                <td><input type="number" value="1" class="exchange" data-cho="0" data-protein="0" data-fat="5" oninput="calculateRow(this)"></td>
                <td>0</td>
                <td>0</td>
                <td>5</td>
                <td class="cho-total">0</td>
                <td class="protein-total">0</td>
                <td class="fat-total">5</td>
            </tr>
            <tr>
                <td>Nuts</td>
                <td><input type="number" value="1" class="exchange" data-cho="0" data-protein="2" data-fat="5" oninput="calculateRow(this)"></td>
                <td>0</td>
                <td>2</td>
                <td>5</td>
                <td class="cho-total">0</td>
                <td class="protein-total">2</td>
                <td class="fat-total">5</td>
            </tr>
        </tbody>
    </table>
    <button onclick="calculate()">Hesapla</button>

    <div class="results" id="results">
        <h3>Hesaplama Sonuçları:</h3>
        <div id="totalCHO">Toplam CHO (kcal): 0 (<span class="percentage">0%</span>)</div>
        <div id="totalProtein">Toplam Protein (kcal): 0 (<span class="percentage">0%</span>)</div>
        <div id="totalFat">Toplam Fat (kcal): 0 (<span class="percentage">0%</span>)</div>
        <div id="totalEnergy">Toplam Enerji (kcal): 0</div>
    </div>

    <script>
        function calculateRow(input) {
            const exchangeValue = parseFloat(input.value) || 0;
            const cho = parseFloat(input.dataset.cho) || 0;
            const protein = parseFloat(input.dataset.protein) || 0;
            const fat = parseFloat(input.dataset.fat) || 0;

            const row = input.closest('tr');
            row.querySelector('.cho-total').innerText = (exchangeValue * cho).toFixed(2);
            row.querySelector('.protein-total').innerText = (exchangeValue * protein).toFixed(2);
            row.querySelector('.fat-total').innerText = (exchangeValue * fat).toFixed(2);
        }

        function calculate() {
            const rows = document.querySelectorAll('tbody tr');
            let totalCHO = 0, totalProtein = 0, totalFat = 0, totalEnergy = 0;

            rows.forEach(row => {
                const cho = parseFloat(row.querySelector('.cho-total').innerText) || 0;
                const protein = parseFloat(row.querySelector('.protein-total').innerText) || 0;
                const fat = parseFloat(row.querySelector('.fat-total').innerText) || 0;

                totalCHO += cho * 4;
                totalProtein += protein * 4;
                totalFat += fat * 9;
            });

            totalEnergy = totalCHO + totalProtein + totalFat;

            document.getElementById('totalCHO').innerHTML = `Toplam CHO (kcal): ${totalCHO.toFixed(2)} (<span class="percentage">${((totalCHO / totalEnergy) * 100 || 0).toFixed(2)}%</span>)`;
            document.getElementById('totalProtein').innerHTML = `Toplam Protein (kcal): ${totalProtein.toFixed(2)} (<span class="percentage">${((totalProtein / totalEnergy) * 100 || 0).toFixed(2)}%</span>)`;
            document.getElementById('totalFat').innerHTML = `Toplam Fat (kcal): ${totalFat.toFixed(2)} (<span class="percentage">${((totalFat / totalEnergy) * 100 || 0).toFixed(2)}%</span>)`;
            document.getElementById('totalEnergy').innerText = `Toplam Enerji (kcal): ${totalEnergy.toFixed(2)}`;
        }
    </script>
</body>
</html>
