let keranjang = [];

function formatRupiah(angka) {
    return angka.toLocaleString('id-ID');
}

function renderKeranjang() {
    const tbody = document.getElementById('keranjang');
    tbody.innerHTML = '';

    let total = 0;
    if (keranjang.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-gray-500 py-3">Tidak ada data!</td></tr>';
    } else {
        keranjang.forEach((item, i) => {
            const subtotal = item.harga * item.jumlah;
            total += subtotal;

            tbody.innerHTML += `
                <tr>
                    <td>${item.nama}</td>
                    <td>Rp. ${formatRupiah(item.harga)}</td>
                    <td>
                        <div class="flex items-center gap-1">
                            <button onclick="ubahJumlah(${item.id}, -1)" class="bg-gray-200 px-2">-</button>
                            ${item.jumlah}
                            <button onclick="ubahJumlah(${item.id}, 1)" class="bg-gray-200 px-2">+</button>
                        </div>
                    </td>
                    <td>Rp. ${formatRupiah(subtotal)}</td>
                    <td><button onclick="hapusItem(${item.id})" class="text-red-500">x</button></td>
                </tr>`;
        });
    }

    const pajak = total * 0.11;
    const grandTotal = total + pajak;

    // Update tampilan Grand Total
    document.getElementById('grandTotal').textContent = formatRupiah(grandTotal);

    // Jika ada detail di modal nanti, bisa ditambahkan pajak & total di situ juga
}


function tambahKeranjang(id, nama, harga) {
    const index = keranjang.findIndex(p => p.id == id);
    if (index !== -1) keranjang[index].jumlah += 1;
    else keranjang.push({ id, nama, harga, jumlah: 1 });
    renderKeranjang();
}

function ubahJumlah(id, delta) {
    const index = keranjang.findIndex(p => p.id == id);
    if (index !== -1) {
        keranjang[index].jumlah += delta;
        if (keranjang[index].jumlah <= 0) keranjang.splice(index, 1);
    }
    renderKeranjang();
}

function hapusItem(id) {
    keranjang = keranjang.filter(p => p.id != id);
    renderKeranjang();
}

function resetKeranjang() {
    keranjang = [];
    renderKeranjang();
}

function bayar() {
    if (keranjang.length === 0) return alert('Keranjang kosong!');
    document.getElementById('inputPembayaran').value = '';
    document.getElementById('bayarModal').classList.remove('hidden');
}

function tutupModal() {
    document.getElementById('bayarModal').classList.add('hidden');
}

function konfirmasiBayar() {
    const jumlah_pembayaran = document.getElementById('inputPembayaran').value;
    if (!jumlah_pembayaran || isNaN(jumlah_pembayaran)) {
        alert('Jumlah pembayaran tidak valid.');
        return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = window.location.origin + '/transaksi';
    form.innerHTML = `
        <input type="hidden" name="_token" value="${document.querySelector('meta[name=\"csrf-token\"]').content}">
        <input type="hidden" name="metode_bayar" value="cash">
        <input type="hidden" name="jumlah_pembayaran" value="${jumlah_pembayaran}">
        ${keranjang.map((item, i) => `
            <input type="hidden" name="produk[${i}][id_produk]" value="${item.id}">
            <input type="hidden" name="produk[${i}][jumlah]" value="${item.jumlah}">
        `).join('')}
    `;
    document.body.appendChild(form);
    form.submit();
}

function filterKategori(idKategori) {
    document.querySelectorAll('.produk-card').forEach(card => {
        const id = card.dataset.kategori;
        card.style.display = (idKategori == 0 || id == idKategori) ? 'block' : 'none';
    });
}

function searchProduk() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.produk-card').forEach(card => {
        const nama = card.dataset.nama;
        const barcode = card.dataset.barcode;
        card.style.display = nama.includes(keyword) || barcode.includes(keyword) ? 'block' : 'none';
    });
}

renderKeranjang();
