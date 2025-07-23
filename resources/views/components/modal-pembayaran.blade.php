<!-- Modal Input Pembayaran -->
<div id="bayarModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white p-6 rounded-lg shadow-md w-[90%] max-w-md text-center">
    <h2 class="text-lg font-semibold text-gray-700 mb-4">Masukkan Jumlah Pembayaran</h2>
    <input type="number" id="inputPembayaran"
           class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring focus:border-[#0BB4B2]"
           placeholder="Jumlah pembayaran...">
    <div class="flex justify-end gap-2">
      <button onclick="tutupModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
      <button onclick="konfirmasiBayar()" class="bg-[#0BB4B2] text-white px-4 py-2 rounded hover:bg-[#099e9d]">Bayar</button>
    </div>
  </div>
</div>
