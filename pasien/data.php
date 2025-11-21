<?php 
include_once('../_header.php'); 

$query = mysqli_query($con, "SELECT * FROM tb_pasien ORDER BY tanggal_berobat ASC") 
         or die(mysqli_error($con));
?>

<div class="box">
    <h1>Pasien</h1>
    <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle" 
       style="background: linear-gradient(90deg, #4A70A9, #1E3A8A); border: none; color: #fff;">
        Toggle Menu
    </a>

    <h4>
        <small>Data Pasien</small>
        <div class="pull-right">
            <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Pasien</a>
            <a href="import.php" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-import"></i> Import Pasien</a>
        </div>
    </h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="pasien">
            <thead>
                <tr>
                    <th>Nomor Identitas</th>
                    <th>Nama Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Tanggal</th>
                    <th><i class="glyphicon glyphicon-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nomor_identitas']); ?></td>
                        <td><?= htmlspecialchars($row['nama_pasien']); ?></td>
                        <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td><?= htmlspecialchars($row['umur']); ?></td>
                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                        <td><?= htmlspecialchars($row['no_telp']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_berobat']); ?></td>
                        <td>
                            <center>
                                <a href="edit.php?id=<?= $row['id_pasien']; ?>" 
                                   class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="del.php?id=<?= $row['id_pasien']; ?>" 
                                   onclick="return confirm('Yakin menghapus data?');" 
                                   class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </center>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function(){
    var table = $('#pasien').DataTable({
        "processing": true,
        "dom": 'Bfrtip',
        buttons: [
            'copy',
            { extend: 'excel', messageTop: 'Data Pasien Rumah Sakit' },
            'csv',
            { extend: 'pdfHtml5', download: 'open' }
        ],
        "columnDefs": [
            { "orderable": false, "targets": 7 }, 
            { "searchable": true, "targets": [0,1] } 
        ]
    });

    $('#searchBox').on('keyup', function(){
        table
            .columns([0,1])
            .search(this.value)
            .draw();
    });
});
</script>

<?php include_once('../_footer.php'); ?>
