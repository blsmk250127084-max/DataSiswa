<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach (($siswa ?? []) as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nis'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['kelas'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>