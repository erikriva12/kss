<table class="table table-hover table-sm table-borderles">
    <tbody>
        <tr>
            <th>Nama</th>
            <td>:</td>
            <td>
                <?= $pesan->nama ?>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>:</td>
            <td>
                <?= $pesan->email ?>
            </td>
        </tr>
        <tr>
            <th>Tanggal Kirim</th>
            <td>:</td>
            <td>
                <?= $pesan->tanggal ?>
            </td>
        </tr>
        <tr>
            <th>Subject</th>
            <td>:</td>
            <td>
                <?= $pesan->subject ?>
            </td>
        </tr>
        <tr>
            <th>Pesan</th>
            <td>:</td>
            <td>
                <?= $pesan->pesan ?>
            </td>
        </tr>
    </tbody>
</table>