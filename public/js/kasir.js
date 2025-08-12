let keranjang = [];

function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(angka);
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

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.nama}</td>
                <td>Rp. ${item.harga.toLocaleString('id-ID')}</td>
                <td>
                    <div class="flex items-center gap-2 justify-center">
                        <button onclick="ubahJumlah(${item.id}, -1)" class="bg-gray-200 px-3 py-1 text-lg font-bold rounded hover:bg-gray-300">−</button>
                        <span class="mx-2 text-base font-semibold">${item.jumlah}</span>
                        <button onclick="ubahJumlah(${item.id}, 1, ${item.stok})" 
                        class="bg-gray-200 px-3 py-1 text-lg font-bold rounded hover:bg-gray-300">+</button>
                    </div>
                </td>
                <td>Rp. ${subtotal.toLocaleString('id-ID')}</td>
                <td>
                    <button onclick="hapusItem(${item.id})" class="text-red-500 text-lg font-bold px-3 py-1 rounded hover:bg-red-100">×</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    const pajak = total * 0;
    const grandTotal = total + pajak;

    document.getElementById('grandTotal').textContent = formatRupiah(grandTotal);
}



async function tambahKeranjang(id, nama, harga, stok) {
    const index = keranjang.findIndex(p => p.id == id);

    if (index !== -1) {
        if (keranjang[index].jumlah >= stok) {
            Swal.fire({
                icon: 'warning',
                title: 'Stok Habis',
                text: `Stok produk "${nama}" tidak mencukupi.`,
            });
            return;
        }
        keranjang[index].jumlah += 1;
    } else {
        if (stok <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Stok Kosong',
                text: `Stok produk "${nama}" tidak tersedia.`,
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600',
                },
                buttonsStyling: false
            });
            return;
        }
        keranjang.push({ id, nama, harga, jumlah: 1, stok });
    }

    await renderKeranjang();
}

async function ubahJumlah(id, delta, stok) {
    const index = keranjang.findIndex(p => p.id == id);

    if (index !== -1) {
        if (delta > 0) {
            // Cek stok sebelum menambah
            if (keranjang[index].jumlah >= stok) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Habis',
                    text: `Stok produk "${keranjang[index].nama}" tidak mencukupi.`,
                });
                return;
            }
        }

        keranjang[index].jumlah += delta;

        // Hapus kalau jumlah <= 0
        if (keranjang[index].jumlah <= 0) {
            keranjang.splice(index, 1);
        }
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
    if (keranjang.length === 0) {
        Swal.fire({
            icon: 'info',
            title: 'Keranjang kosong!',
            text: 'Silakan tambahkan produk terlebih dahulu.',
             customClass: {
                confirmButton: 'bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600',
            }
        });
        return;
    }

    const total = keranjang.reduce((acc, item) => acc + item.harga * item.jumlah, 0);
    const pajak = total * 0;
    const grandTotal = total + pajak;
    const jumlahProduk = keranjang.reduce((acc, item) => acc + item.jumlah, 0);
    const nota = 'NOTA-' + Math.random().toString(36).substring(2, 8).toUpperCase();

    document.getElementById('modalTotalSebelumPajak').textContent = formatRupiah(total);
    document.getElementById('modalGrandTotal').textContent = formatRupiah(grandTotal);
    document.getElementById('grandTotalModal2').textContent = formatRupiah(grandTotal);
    document.getElementById('pajakDisplay').textContent = formatRupiah(pajak);
    document.getElementById('jumlahProduk').textContent = jumlahProduk;
    document.getElementById('kembalianDisplay').textContent = formatRupiah(0);
    document.getElementById('notaDisplay').textContent = nota;
    document.getElementById('inputPembayaran').value = '';

    document.getElementById('bayarModal').classList.remove('hidden');

    document.getElementById('inputPembayaran').oninput = () => {
        const bayar = parseFloat(document.getElementById('inputPembayaran').value) || 0;
        const kembalian = bayar - grandTotal;
        document.getElementById('kembalianDisplay').textContent = formatRupiah(kembalian > 0 ? kembalian : 0);
    };
}

function tutupModal() {
    document.getElementById('bayarModal').classList.add('hidden');
}

async function konfirmasiBayar() {
    const metode = document.getElementById('metodePembayaran').value;
    const total = keranjang.reduce((acc, item) => acc + item.harga * item.jumlah, 0);
    const pajak = total * 0;
    const grandTotal = total + pajak;
    const uangDiterima = parseFloat(document.getElementById('inputPembayaran').value);
    const kembalian = uangDiterima - grandTotal;

    if (isNaN(uangDiterima) || uangDiterima < grandTotal) {
        Swal.fire({
            icon: 'warning',
            title: 'Pembayaran Kurang',
            text: 'Uang diterima kurang dari total yang harus dibayar!',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600',
            },
            buttonsStyling: false
        });
        return;
    }

    Swal.fire({
        title: 'Menyimpan Transaksi...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    const keranjangPayload = keranjang.map(item => ({
        id_produk: item.id,
        jumlah: item.jumlah,
        harga: item.harga,
        diskon: 0,
        sub_total: item.harga * item.jumlah
    }));

    try {
        const response = await fetch('/kasir', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                total_harga: grandTotal,
                jumlah_pembayaran: uangDiterima,
                kembalian: kembalian,
                metode_bayar: metode,
                pajak: pajak,
                keranjang: keranjangPayload
            })
        });

        const data = await response.json();
        Swal.close();

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Pembayaran Berhasil!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                // cetakStruk(total, document.getElementById('notaDisplay')?.textContent || '', grandTotal, pajak, uangDiterima, kembalian);
                const transaksiId = data.transaksi_id; 
                
                cetakNota(transaksiId);
                
                keranjang = [];
                renderKeranjang();
                // setTimeout(() => {
                //     window.location.reload();
                // }, 1000);
            });

            tutupModal();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan Transaksi',
                text: data.message || 'Terjadi kesalahan.',
            });
        }

    } catch (error) {
        Swal.close();
        console.error('Terjadi kesalahan saat menyimpan transaksi:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Server',
            text: 'Tidak dapat terhubung ke server.',
        });
    }
}

function isMobileDevice() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

// Fungsi pencetakan yang akan disesuaikan
function cetakNota(transaksiId) {
    if (isMobileDevice()) {
        console.log('Detected mobile device');
        
        const baseUrl = window.appUrls.printJson;
        const printUrl = baseUrl.replace('TRANSACTION_ID_PLACEHOLDER', transaksiId);
        console.log('Print URL:', printUrl);

        const appSchemeUrl = `my.bluetoothprint.scheme://${window.location.origin}${printUrl}`;
        console.log('App scheme URL:', appSchemeUrl);
        window.open(appSchemeUrl, '_self');
    } else {
        // Logika untuk mencetak di PC (menggunakan window.print)
        // const printUrl = `/nota-view/${transaksiId}`; // Buat route baru untuk tampilan nota HTML/CSS
        // const printWindow = window.open(printUrl, '_blank');
        // printWindow.onload = () => {
        //     printWindow.print();
        // };
        console.log('Pencetakan di PC tidak didukung dalam mode ini. Gunakan aplikasi mobile untuk mencetak nota.');
    }
}

function cetakStruk(total, nota, grandTotal, pajak, bayar, kembalian) {
    const itemsHtml = keranjang.map(item => `
        <div style="display: flex; justify-content: space-between; font-size: 12px;">
            <div style="flex: 1;">${item.nama} x${item.jumlah}</div>
            <div style="text-align: right; flex-shrink: 0;">Rp ${(item.harga * item.jumlah).toLocaleString('id-ID')}</div>
        </div>
        <div style="font-size: 11px; color: gray; margin-bottom: 4px;">
            &nbsp;&nbsp;&nbsp;@ Rp ${item.harga.toLocaleString('id-ID')}
        </div>
    `).join('');

    const printWindow = window.open('', '', 'width=300,height=600');
    printWindow.document.write(`
        <html>
        <head>
            <title>Struk Pembayaran</title>
            <style>
                body {
                    font-family: monospace;
                    width: 250px;
                    padding: 10px;
                    color: #000;
                }
                h2 {
                    text-align: center;
                    margin: 5px 0;
                }
                .center {
                    text-align: center;
                }
                .logo {
                    width: 60px;
                    height: 60px;
                    object-fit: cover;
                    display: block;
                    margin: 0 auto 5px auto;
                }
                hr {
                    border-top: 1px dashed #000;
                    margin: 6px 0;
                }
                .summary-table {
                    width: 100%;
                    font-size: 12px;
                    border-collapse: collapse;
                }
                .summary-table td {
                    padding: 2px 0;
                }
                .summary-table td:last-child {
                    text-align: right;
                }
            </style>
        </head>
        <body>
            <h2>Fresh Market Pantai Klatak</h2>
            <p class="center" style="margin: 0;">Jalan Pantai Waru Doyong Klatak, Soireng, Keboireng, Kec. Besuki, Kab.Tulungagung</p>
            <hr>
            <p>Nota: <span>${nota}</span></p>
            <p>Tanggal: <span>${new Date().toLocaleString('id-ID')}</span></p>
            <hr>
            ${itemsHtml}
            <hr>
            <table class="summary-table">
                <tr><td>Total</td><td>${formatRupiah(total)}</td></tr>
                <tr><td>Pajak (10%)</td><td>${formatRupiah(pajak)}</td></tr>
                <tr><td><strong>Grand Total</strong></td><td><strong>${formatRupiah(grandTotal)}</strong></td></tr>
                <tr><td>Bayar</td><td>${formatRupiah(bayar)}</td></tr>
                <tr><td>Kembalian</td><td>${formatRupiah(kembalian)}</td></tr>
            </table>
            <hr>
            <p class="center">Terima kasih telah berbelanja!</p>
            <p class="center">~ E-Klatak ~</p>
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

function filterKategori(idKategori) {
    const buttons = document.querySelectorAll('.kategori-button');
    buttons.forEach(btn => {
        const btnId = btn.getAttribute('data-id');
        btn.classList.toggle('active-kategori', btnId == idKategori);
    });

    const produkCards = document.querySelectorAll('.produk-card');
    produkCards.forEach(card => {
        const kategoriId = card.getAttribute('data-kategori');
        card.style.display = (idKategori == 0 || kategoriId == idKategori) ? 'flex' : 'none';
    });
}

function searchProduk() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const produkCards = document.querySelectorAll(".produk-card");

    produkCards.forEach(card => {
        const nama = card.getAttribute("data-nama");
        const barcode = card.getAttribute("data-barcode");

        card.style.display = (nama.includes(input) || barcode.includes(input)) ? 'flex' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', function () {
    renderKeranjang();
});