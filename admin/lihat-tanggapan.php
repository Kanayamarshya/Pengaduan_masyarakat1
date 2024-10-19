<?php
include '../koneksi.php';

// Query untuk menampilkan data pengaduan dan hanya menampilkan satu pengaduan per ID
$sql = "SELECT pengaduan.*, tanggapan.tanggapan, tanggapan.tgl_tanggapan 
        FROM pengaduan 
        LEFT JOIN tanggapan ON pengaduan.id_pengaduan = tanggapan.id_pengaduan
        GROUP BY pengaduan.id_pengaduan
        ORDER BY pengaduan.status DESC, pengaduan.tgl_pengaduan DESC";

$query = mysqli_query($koneksi, $sql);
$no = 1;
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Pengaduan</h6>
    </div>
    <div class="card-body" style="font-size: 14px">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl Pengaduan</th>
                        <th>NIK</th>
                        <th>Isi Laporan</th>
                        <th>Tanggapan</th>
                        <th>Foto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tgl Pengaduan</th>
                        <th>NIK</th>
                        <th>Isi Laporan</th>
                        <th>Tanggapan</th>
                        <th>Foto</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['tgl_pengaduan']; ?></td>
                            <td><?= $data['nik']; ?></td>
                            <td><?= $data['isi_laporan']; ?></td>
                            <td><?= $data['tanggapan']; ?></td>
                            <td><img class="img-thumbnail" src="../foto/<?= $data['foto'] ?>" width="150"></td>
                            <td>
                                <?php if ($data['status'] == '0'): ?>Belum diproses
                                <?php elseif ($data['status'] == 'proses'): ?>Sedang dalam proses
                                <?php elseif ($data['status'] == 'selesai'): ?>Laporan sudah selesai
                                <?php elseif ($data['status'] == 'ditolak'): ?>Laporan ditolak
                            <?php endif; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

