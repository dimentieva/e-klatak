<!-- resources/views/components/modal-pembayaran.blade.php -->
<div id="bayarModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white p-6 rounded-lg shadow-md w-[95%] max-w-3xl">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Pembayaran</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Kiri -->
      <div class="space-y-3">
        <div>
          <label class="text-sm font-semibold">No Nota:</label>
          <div id="notaDisplay" class="font-mono text-blue-700">-</div>
        </div>
        <div>
          <label class="text-sm font-semibold">Grand Total:</label>
          <div id="modalGrandTotal" class="bg-green-200 text-green-800 font-bold p-2 rounded">Rp. 0</div>
        </div>
        <div>
          <label class="text-sm font-semibold">Uang Diterima:</label>
          <input type="number" id="inputPembayaran"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-[#0BB4B2]"
            placeholder="Rp...">
        </div>
        <div>
          <label class="text-sm font-semibold">Kembalian:</label>
          <div id="kembalianDisplay" class="text-gray-700 font-medium">Rp. 0</div>
        </div>
        <div>
          <label class="text-sm font-semibold">Note:</label>
          <textarea rows="3" class="w-full border rounded p-2"></textarea>
        </div>
        <div class="flex justify-end gap-2 mt-2">
          <button onclick="tutupModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
          <button onclick="konfirmasiBayar()" class="bg-[#0BB4B2] text-white px-4 py-2 rounded hover:bg-[#099e9d]">Submit</button>
        </div>
      </div>

      <!-- Kanan -->
      <div class="border rounded p-4 space-y-2 text-sm text-gray-700 bg-gray-50">
        <div class="flex justify-between">
          <span>Total Produk</span>
          <span id="jumlahProduk">0</span>
        </div>
        <div class="flex justify-between">
          <span>Pajak</span>
          <span id="pajakDisplay">Rp. 0</span>
        </div>
        <div class="flex justify-between">
          <span>Diskon</span>
          <span>Rp 0.0</span>
        </div>
        <div class="flex justify-between font-bold border-t pt-2">
          <span>Grand Total</span>
          <span id="grandTotalModal2">Rp. 0</span>
        </div>
      </div>
    </div>
  </div>
</div>