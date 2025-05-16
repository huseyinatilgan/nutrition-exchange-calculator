<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo bin2hex(random_bytes(32)); ?>">
    <title>Exchange Calculator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
            margin-bottom: 1.5rem;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .results {
            background-color: #fff;
            border-radius: 0.5rem;
            padding: 1.5rem;
        }
        .percentage {
            color: #0d6efd;
            font-weight: bold;
        }
        .input-group {
            max-width: 120px;
        }
        /* Mobil için geliştirmeler */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }
            .input-group {
                max-width: 90px;
            }
            .card-title {
                font-size: 1.5rem;
            }
            .results {
                padding: 1rem;
            }
            .table th, .table td {
                padding: 0.5rem;
            }
            .btn {
                width: 100%;
                margin-bottom: 1rem;
            }
            .alert {
                font-size: 0.9rem;
            }
            /* Mobilde tablo başlıklarını kısalt */
            .table th:nth-child(3), .table th:nth-child(4), .table th:nth-child(5) {
                font-size: 0.8rem;
            }
            .table th:nth-child(6), .table th:nth-child(7), .table th:nth-child(8) {
                font-size: 0.8rem;
            }
        }
        /* Çok küçük ekranlar için ek düzenlemeler */
        @media (max-width: 576px) {
            .container {
                padding: 0.5rem;
            }
            .card-body {
                padding: 1rem;
            }
            .table-responsive {
                font-size: 0.8rem;
            }
            .input-group {
                max-width: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Exchange Calculator</h1>
                        <p class="text-center mb-4">Kendi besin planınıza göre "Exchange" değerlerini giriniz ve sonuçları hesaplayınız.</p>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="exchange-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Besin Grupları</th>
                                        <th>Exchange</th>
                                        <th>CHO (g)</th>
                                        <th>Protein (g)</th>
                                        <th>Yağ (g)</th>
                                        <th>CHO (g) x Exchange</th>
                                        <th>Protein (g) x Exchange</th>
                                        <th>Yağ (g) x Exchange</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Süt</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm exchange" value="1" 
                                                    data-cho="9" data-protein="6" data-fat="6" 
                                                    oninput="validateInput(this); calculateRow(this)" min="0" step="0.5">
                                            </div>
                                        </td>
                                        <td>9</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td class="cho-total">9</td>
                                        <td class="protein-total">6</td>
                                        <td class="fat-total">6</td>
                                    </tr>
                                    <tr>
                                        <td>Et</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm exchange" value="1" 
                                                    data-cho="0" data-protein="6" data-fat="5" 
                                                    oninput="validateInput(this); calculateRow(this)" min="0" step="0.5">
                                            </div>
                                        </td>
                                        <td>0</td>
                                        <td>6</td>
                                        <td>5</td>
                                        <td class="cho-total">0</td>
                                        <td class="protein-total">6</td>
                                        <td class="fat-total">5</td>
                                    </tr>
                                    <tr>
                                        <td>Ekmek</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm exchange" value="1" 
                                                    data-cho="15" data-protein="2" data-fat="0" 
                                                    oninput="validateInput(this); calculateRow(this)" min="0" step="0.5">
                                            </div>
                                        </td>
                                        <td>15</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td class="cho-total">15</td>
                                        <td class="protein-total">2</td>
                                        <td class="fat-total">0</td>
                                    </tr>
                                    <tr>
                                        <td>Sebze</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm exchange" value="1" 
                                                    data-cho="6" data-protein="2" data-fat="0" 
                                                    oninput="validateInput(this); calculateRow(this)" min="0" step="0.5">
                                            </div>
                                        </td>
                                        <td>6</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td class="cho-total">6</td>
                                        <td class="protein-total">2</td>
                                        <td class="fat-total">0</td>
                                    </tr>
                                    <tr>
                                        <td>Meyve</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm exchange" value="1" 
                                                    data-cho="15" data-protein="0" data-fat="0" 
                                                    oninput="validateInput(this); calculateRow(this)" min="0" step="0.5">
                                            </div>
                                        </td>
                                        <td>15</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="cho-total">15</td>
                                        <td class="protein-total">0</td>
                                        <td class="fat-total">0</td>
                                    </tr>
                                    <tr>
                                        <td>Yağlar</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm exchange" value="1" 
                                                    data-cho="0" data-protein="0" data-fat="5" 
                                                    oninput="validateInput(this); calculateRow(this)" min="0" step="0.5">
                                            </div>
                                        </td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>5</td>
                                        <td class="cho-total">0</td>
                                        <td class="protein-total">0</td>
                                        <td class="fat-total">5</td>
                                    </tr>
                                    <tr>
                                        <td>Kuruyemişler</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm exchange" value="1" 
                                                    data-cho="0" data-protein="2" data-fat="5" 
                                                    oninput="validateInput(this); calculateRow(this)" min="0" step="0.5">
                                            </div>
                                        </td>
                                        <td>0</td>
                                        <td>2</td>
                                        <td>5</td>
                                        <td class="cho-total">0</td>
                                        <td class="protein-total">2</td>
                                        <td class="fat-total">5</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mb-4">
                            <button class="btn btn-primary" onclick="calculate()">
                                <span class="d-none d-md-inline">Hesapla</span>
                                <span class="d-md-none">✓</span>
                            </button>
                        </div>

                        <div class="results" id="results">
                            <h3 class="text-center mb-4">Hesaplama Sonuçları</h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title">Makro Besinler</h5>
                                            <div id="totalCHO" class="mb-2">Toplam CHO (kcal): 0 (<span class="percentage">0%</span>)</div>
                                            <div id="totalProtein" class="mb-2">Toplam Protein (kcal): 0 (<span class="percentage">0%</span>)</div>
                                            <div id="totalFat" class="mb-2">Toplam Yağ (kcal): 0 (<span class="percentage">0%</span>)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title">Toplam Enerji</h5>
                                            <div id="totalEnergy" class="h4 text-center">0 kcal</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Disclaimer -->
                <div class="alert alert-warning mt-4" role="alert">
                    <h5 class="alert-heading">⚠️ Önemli Uyarı</h5>
                    <p class="mb-0">Bu hesaplayıcı sadece bilgilendirme amaçlıdır ve tıbbi tavsiye niteliği taşımamaktadır. Beslenme planınızı değiştirmeden önce mutlaka bir diyetisyene veya doktora danışınız. Bu hesaplayıcıda yer alan bilgilerin doğruluğu garanti edilmemektedir.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Input validasyonu
        function validateInput(input) {
            const value = parseFloat(input.value);
            if (value < 0) {
                input.value = 0;
            }
            // XSS koruması
            input.value = input.value.replace(/[<>]/g, '');
        }

        // Satır hesaplama
        function calculateRow(input) {
            const exchangeValue = parseFloat(input.value) || 0;
            const cho = parseFloat(input.dataset.cho) || 0;
            const protein = parseFloat(input.dataset.protein) || 0;
            const fat = parseFloat(input.dataset.fat) || 0;

            const row = input.closest('tr');
            row.querySelector('.cho-total').textContent = (exchangeValue * cho).toFixed(2);
            row.querySelector('.protein-total').textContent = (exchangeValue * protein).toFixed(2);
            row.querySelector('.fat-total').textContent = (exchangeValue * fat).toFixed(2);
        }

        // Toplam hesaplama
        function calculate() {
            const rows = document.querySelectorAll('tbody tr');
            let totalCHO = 0, totalProtein = 0, totalFat = 0, totalEnergy = 0;

            rows.forEach(row => {
                const cho = parseFloat(row.querySelector('.cho-total').textContent) || 0;
                const protein = parseFloat(row.querySelector('.protein-total').textContent) || 0;
                const fat = parseFloat(row.querySelector('.fat-total').textContent) || 0;

                totalCHO += cho * 4;
                totalProtein += protein * 4;
                totalFat += fat * 9;
            });

            totalEnergy = totalCHO + totalProtein + totalFat;

            // Sonuçları güvenli bir şekilde güncelle
            document.getElementById('totalCHO').innerHTML = `Toplam CHO (kcal): ${totalCHO.toFixed(2)} (<span class="percentage">${((totalCHO / totalEnergy) * 100 || 0).toFixed(2)}%</span>)`;
            document.getElementById('totalProtein').innerHTML = `Toplam Protein (kcal): ${totalProtein.toFixed(2)} (<span class="percentage">${((totalProtein / totalEnergy) * 100 || 0).toFixed(2)}%</span>)`;
            document.getElementById('totalFat').innerHTML = `Toplam Yağ (kcal): ${totalFat.toFixed(2)} (<span class="percentage">${((totalFat / totalEnergy) * 100 || 0).toFixed(2)}%</span>)`;
            document.getElementById('totalEnergy').textContent = `${totalEnergy.toFixed(2)} kcal`;
        }

        // Sayfa yüklendiğinde ilk hesaplamayı yap
        document.addEventListener('DOMContentLoaded', calculate);
    </script>
</body>
</html>
