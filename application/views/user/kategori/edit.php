<input type="hidden" name="id" value="<?= $kategori->id ?>">
<div class="form-group">
    <label><b>Nama Kategori</b></label>
    <input type="text" class="form-control" name="nama_kategori" value="<?= $kategori->nama ?>">
</div>
<script>
    renderSelect2();
</script>