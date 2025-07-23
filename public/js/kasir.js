// Replace the entire js section with this updated version

let keranjang = [];

function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
}

async function updateServerCart() {
    try {
        const response = await fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify({ cart: keranjang })
        });
        
        if (!response.ok) {
            console.error('Failed to update server cart');
        }
    } catch (error) {
        console.error('Error updating server cart:', error);
    }
}

async function renderKeranjang() {
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
                    <td>Rp. ${item.harga.toLocaleString('id-ID')}</td>
                    <td>
                        <div class="flex items-center gap-1">
                            <button onclick="ubahJumlah(${item.id}, -1)" class="bg-gray-200 px-2">-</button>
                            ${item.jumlah}
                            <button onclick="ubahJumlah(${item.id}, 1)" class="bg-gray-200 px-2">+</button>
                        </div>
                    </td>
                    <td>Rp. ${(subtotal).toLocaleString('id-ID')}</td>
                    <td><button onclick="hapusItem(${item.id})" class="text-red-500">x</button></td>
                </tr>`;
        });
    }

    const pajak = total * 0.11;
    const grandTotal = total + pajak;

    document.getElementById('grandTotal').textContent = formatRupiah(grandTotal);
    
    // Update server cart
    await updateServerCart();
}

async function tambahKeranjang(id, nama, harga) {
    const index = keranjang.findIndex(p => p.id == id);
    if (index !== -1) keranjang[index].jumlah += 1;
    else keranjang.push({ id, nama, harga, jumlah: 1 });
    await renderKeranjang();
}

async function ubahJumlah(id, delta) {
    const index = keranjang.findIndex(p => p.id == id);
    if (index !== -1) {
        keranjang[index].jumlah += delta;
        if (keranjang[index].jumlah <= 0) keranjang.splice(index, 1);
    }
    await renderKeranjang();
}

async function hapusItem(id) {
    keranjang = keranjang.filter(p => p.id != id);
    await renderKeranjang();
}

function resetKeranjang() {
    keranjang = [];
    renderKeranjang();
}

function bayar() {
    if (keranjang.length === 0) return alert('Keranjang kosong!');

    const total = keranjang.reduce((acc, item) => acc + item.harga * item.jumlah, 0);
    const pajak = total * 0.11;
    const grandTotal = total + pajak;
    const jumlahProduk = keranjang.reduce((acc, item) => acc + item.jumlah, 0);
    const nota = 'NOTA-' + Math.random().toString(36).substring(2, 8).toUpperCase();

    // Set isi modal
    document.getElementById('modalTotalSebelumPajak').textContent = formatRupiah(total);
    document.getElementById('modalGrandTotal').textContent = formatRupiah(grandTotal);
    document.getElementById('grandTotalModal2').textContent = formatRupiah(grandTotal);
    document.getElementById('pajakDisplay').textContent = formatRupiah(pajak);
    document.getElementById('jumlahProduk').textContent = jumlahProduk;
    document.getElementById('kembalianDisplay').textContent = formatRupiah(0);
    document.getElementById('notaDisplay').textContent = nota;
    document.getElementById('inputPembayaran').value = '';

    // Tampilkan modal
    document.getElementById('bayarModal').classList.remove('hidden');

    // Hitung kembalian saat input berubah
    document.getElementById('inputPembayaran').oninput = () => {
        const bayar = parseFloat(document.getElementById('inputPembayaran').value) || 0;
        const kembalian = bayar - grandTotal;
        document.getElementById('kembalianDisplay').textContent = formatRupiah(kembalian > 0 ? kembalian : 0);
    };
}

function tutupModal() {
    document.getElementById('bayarModal').classList.add('hidden');
}

function konfirmasiBayar() {
    const jumlah_pembayaran = parseFloat(document.getElementById('inputPembayaran').value);
    if (!jumlah_pembayaran || isNaN(jumlah_pembayaran)) {
        alert('Jumlah pembayaran tidak valid.');
        return;
    }

    const metode_bayar = document.querySelector('input[name="metode_bayar"]:checked')?.value || 'cash';

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('transaksi.store') }}";
    form.innerHTML = `
        @csrf
        <input type="hidden" name="metode_bayar" value="${metode_bayar}">
        <input type="hidden" name="jumlah_pembayaran" value="${jumlah_pembayaran}">
    `;
    
    document.body.appendChild(form);
    form.submit();
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Load initial cart from server if needed
    renderKeranjang();
});