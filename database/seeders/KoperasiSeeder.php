<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Anggota;
use App\Models\PiutangUang;
use App\Models\PinjamanBarang;
use App\Models\Transaksi;
use App\Models\KasKoperasi;
use App\Models\BussinessNeed;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class KoperasiSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Seed Business Need (Pengaturan Koperasi Periode Aktif)
        // BusinessNeed::create([
        //     'id_bn' => 'BN-2026-01',
        //     'periode' => '2026-01',
        //     'simpanan_pokok' => 500000,
        //     'simpanan_wajib' => 50000,
        //     'persen_bunga_barang' => 10,
        //     'status_aktif' => true,
        //     'created_at' => $now,
        // ]);

        // 2. Seed Users
        // Admin
        $adminUser = User::create([
            'id_user' => 'USR-001',
            'username' => 'admin_koperasi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'ADMIN',
            'is_active' => true,
        ]);

        // Anggota 1
        $userAnggota1 = User::create([
            'id_user' => 'USR-002',
            'username' => 'budi_santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'ANGGOTA',
            'is_active' => true,
        ]);

        // Anggota 2
        $userAnggota2 = User::create([
            'id_user' => 'USR-003',
            'username' => 'siti_aminah',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'ANGGOTA',
            'is_active' => true,
        ]);

        // 3. Seed Anggota
        $anggota1 = Anggota::create([
            'no_anggota' => 'ANG-001',
            'id_user' => $userAnggota1->id_user,
            'nama' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'saldo_akhir' => 600000, // Total simpanan pokok + wajib
            'total_tagihan' => 4500000, // Total sisa piutang + sisa pinjaman barang
            'status' => true,
        ]);

        $anggota2 = Anggota::create([
            'no_anggota' => 'ANG-002',
            'id_user' => $userAnggota2->id_user,
            'nama' => 'Siti Aminah',
            'no_hp' => '089876543210',
            'saldo_akhir' => 550000,
            'total_tagihan' => 0,
            'status' => true,
        ]);

        // 4. Seed Piutang Uang (Anggota 1 memiliki Pinjaman Uang)
        $piutangUang1 = PiutangUang::create([
            'id_piutang_uang' => 'PU-001',
            'no_anggota' => $anggota1->no_anggota,
            'total_piutang_awal' => 3000000,
            'sisa_piutang_uang' => 2500000,
            'angsuran_uang' => 500000,
            'tenor_uang' => 6,
            'sisa_tenor_uang' => 5,
        ]);

        // 5. Seed Pinjaman Barang (Anggota 1 memiliki Pinjaman Barang/Laptop)
        $pinjamanBarang1 = PinjamanBarang::create([
            'id_pinjaman_barang' => 'PB-001',
            'no_anggota' => $anggota1->no_anggota,
            'harga_barang_awal' => 2000000,
            'persen_bunga' => 10,
            'nominal_bunga' => 200000,
            'total_pinjaman_barang' => 2200000,
            'sisa_pinjaman_barang' => 2000000,
            'angsuran_barang' => 200000,
            'tenor_barang' => 11,
            'sisa_tenor_barang' => 10,
        ]);

        // 6. Seed Transaksi & Kas Koperasi (Simulasi Mutasi Kas Berdasarkan Transaksi)
        $saldoKas = 10000000; // Saldo awal kas koperasi

        // --- Transaksi 1: Setor Simpanan Pokok Budi ---
        $trx1 = Transaksi::create([
            'no_transaksi' => 'TRX-20260101-001',
            'no_anggota' => $anggota1->no_anggota,
            'id_piutang_uang' => null,
            'id_pinjaman_barang' => null,
            'jenis_transaksi' => 'SETOR_SIMPANAN_POKOK',
            'nominal' => 500000,
            'keterangan' => 'Setoran awal simpanan pokok Budi Santoso',
            'created_at' => $now->copy()->subDays(10),
        ]);

        $saldoKas += $trx1->nominal;
        KasKoperasi::create([
            'id_kas' => 'KAS-001',
            'no_transaksi' => $trx1->no_transaksi,
            'id_user' => $adminUser->id_user,
            'jenis_mutasi' => 'MASUK',
            'nominal' => $trx1->nominal,
            'saldo_setelah_mutasi' => $saldoKas,
            'keterangan' => 'Pemasukan dari Simpanan Pokok Budi Santoso',
            'created_at' => $trx1->created_at,
        ]);

        // --- Transaksi 2: Pencairan Piutang Uang Budi ---
        $trx2 = Transaksi::create([
            'no_transaksi' => 'TRX-20260101-002',
            'no_anggota' => $anggota1->no_anggota,
            'id_piutang_uang' => $piutangUang1->id_piutang_uang,
            'id_pinjaman_barang' => null,
            'jenis_transaksi' => 'PENCAIRAN_PIUTANG_UANG',
            'nominal' => 3000000,
            'keterangan' => 'Pencairan pinjaman uang tunai Budi Santoso',
            'created_at' => $now->copy()->subDays(5),
        ]);

        $saldoKas -= $trx2->nominal;
        KasKoperasi::create([
            'id_kas' => 'KAS-002',
            'no_transaksi' => $trx2->no_transaksi,
            'id_user' => $adminUser->id_user,
            'jenis_mutasi' => 'KELUAR',
            'nominal' => $trx2->nominal,
            'saldo_setelah_mutasi' => $saldoKas,
            'keterangan' => 'Pengeluaran kas untuk pencairan piutang Budi Santoso',
            'created_at' => $trx2->created_at,
        ]);

        // --- Transaksi 3: Pembayaran Angsuran Uang Ke-1 Budi ---
        $trx3 = Transaksi::create([
            'no_transaksi' => 'TRX-20260101-003',
            'no_anggota' => $anggota1->no_anggota,
            'id_piutang_uang' => $piutangUang1->id_piutang_uang,
            'id_pinjaman_barang' => null,
            'jenis_transaksi' => 'BAYAR_ANGSURAN_UANG',
            'nominal' => 500000,
            'keterangan' => 'Pembayaran angsuran uang bulan ke-1 Budi Santoso',
            'created_at' => $now->copy()->subDays(2),
        ]);

        $saldoKas += $trx3->nominal;
        KasKoperasi::create([
            'id_kas' => 'KAS-003',
            'no_transaksi' => $trx3->no_transaksi,
            'id_user' => $adminUser->id_user,
            'jenis_mutasi' => 'MASUK',
            'nominal' => $trx3->nominal,
            'saldo_setelah_mutasi' => $saldoKas,
            'keterangan' => 'Angsuran piutang uang ke-1 Budi Santoso',
            'created_at' => $trx3->created_at,
        ]);

        // --- Transaksi 4: Pengeluaran Operasional Koperasi (Tanpa Anggota) ---
        $trx4 = Transaksi::create([
            'no_transaksi' => 'TRX-20260101-004',
            'no_anggota' => null,
            'id_piutang_uang' => null,
            'id_pinjaman_barang' => null,
            'jenis_transaksi' => 'PENGELUARAN_OPERASIONAL',
            'nominal' => 150000,
            'keterangan' => 'Pembelian ATK kantor koperasi',
            'created_at' => $now->copy()->subDay(),
        ]);

        $saldoKas -= $trx4->nominal;
        KasKoperasi::create([
            'id_kas' => 'KAS-004',
            'no_transaksi' => $trx4->no_transaksi,
            'id_user' => $adminUser->id_user,
            'jenis_mutasi' => 'KELUAR',
            'nominal' => $trx4->nominal,
            'saldo_setelah_mutasi' => $saldoKas,
            'keterangan' => 'Biaya operasional ATK kantor',
            'created_at' => $trx4->created_at,
        ]);
    }
}
