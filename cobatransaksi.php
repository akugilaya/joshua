<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Transaksi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    .container {
      max-width: 900px;
      margin: auto;
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .product-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 15px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .product-info {
      display: flex;
      align-items: center;
    }
    .product-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
      margin-right: 15px;
    }
    .product-details {
      flex-grow: 1;
    }
    .product-name {
      font-size: 16px;
      font-weight: bold;
      margin: 0;
    }
    .product-price {
      font-size: 14px;
      color: #555;
      margin: 5px 0;
    }
    .product-controls {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .product-controls input {
      width: 50px;
      text-align: center;
      margin-bottom: 5px;
    }
    .product-total {
      font-size: 14px;
      font-weight: bold;
      color: #333;
    }
    .summary {
      margin-top: 20px;
      font-size: 18px;
      text-align: right;
    }
    .btn {
      display: block;
      width: 100%;
      text-align: center;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 20px;
    }
    .btn:hover {
      background-color: #0056b3;
    }
    .qris-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    .qris-content {
      background: white;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    .qris-content img {
      width: 200px;
      margin-bottom: 20px;
    }
    .close-btn {
      background-color: #ff4d4d;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      cursor: pointer;
    }
    .close-btn:hover {
      background-color: #cc0000;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Halaman Transaksi</h1>
    </div>

    <!-- Kartu Produk -->
    <div class="product-card">
      <div class="product-info">
        <img src="https://via.placeholder.com/80" alt="Barang A" class="product-image">
        <div class="product-details">
          <p class="product-name">Barang A</p>
          <p class="product-price">Harga: Rp 50,000</p>
        </div>
      </div>
      <div class="product-controls">
        <input type="number" min="1" value="1" onchange="calculateTotal(this, 50000)">
        <p class="product-total">Rp 50,000</p>
      </div>
    </div>

    <div class="product-card">
      <div class="product-info">
        <img src="https://via.placeholder.com/80" alt="Barang B" class="product-image">
        <div class="product-details">
          <p class="product-name">Barang B</p>
          <p class="product-price">Harga: Rp 100,000</p>
        </div>
      </div>
      <div class="product-controls">
        <input type="number" min="1" value="1" onchange="calculateTotal(this, 100000)">
        <p class="product-total">Rp 100,000</p>
      </div>
    </div>

    <!-- Ringkasan -->
    <div class="summary">
      <p><strong>Total Barang: <span id="totalItems">2</span></strong></p>
      <p><strong>Total Keseluruhan: <span id="grandTotal">Rp 150,000</span></strong></p>
    </div>
    <button class="btn" onclick="showQRIS()">Checkout dengan QRIS</button>

    <!-- QRIS Modal -->
    <div class="qris-modal" id="qrisModal">
      <div class="qris-content">
        <h2>Silakan Scan QRIS untuk Pembayaran</h2>
        <img src="https://via.placeholder.com/200x200.png?text=QRIS" alt="QRIS">
        <p><strong>Total: <span id="qrisTotal">Rp 150,000</span></strong></p>
        <button class="close-btn" onclick="closeQRIS()">Tutup</button>
      </div>
    </div>
  </div>

  <script>
    function calculateTotal(input, price) {
      const card = input.closest(".product-card");
      const totalElement = card.querySelector(".product-total");
      const quantity = parseInt(input.value, 10) || 0;
      const total = price * quantity;

      // Update total per item
      totalElement.textContent = `Rp ${total.toLocaleString()}`;

      // Update total items and grand total
      updateSummary();
    }

    function updateSummary() {
      const totals = document.querySelectorAll(".product-total");
      const quantities = document.querySelectorAll(".product-controls input[type='number']");
      let grandTotal = 0;
      let totalItems = 0;

      totals.forEach((total, index) => {
        const value = parseInt(total.textContent.replace(/[^\d]/g, ""), 10) || 0;
        const quantity = parseInt(quantities[index].value, 10) || 0;
        grandTotal += value;
        totalItems += quantity;
      });

      document.getElementById("grandTotal").textContent = `Rp ${grandTotal.toLocaleString()}`;
      document.getElementById("totalItems").textContent = totalItems;
      document.getElementById("qrisTotal").textContent = `Rp ${grandTotal.toLocaleString()}`;
    }

    function showQRIS() {
      document.getElementById("qrisModal").style.display = "flex";
    }

    function closeQRIS() {
      document.getElementById("qrisModal").style.display = "none";
    }
  </script>
</body>
</html>
