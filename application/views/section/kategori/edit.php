<input type="hidden" name="id" value="<?= $kategori->id ?>">
<div class="form-group">
    <label><b>Nama Kategori</b></label>
    <input type="text" class="form-control" name="nama_kategori" value="<?= $kategori->nama ?>">
</div>
<div class="form-group">
    <label><b>Layout</b></label>
    <select name="slug" class="form-control select2" name="slug" style="width: 100%;">
        <option value="">-- Pilih --</option>
        <option value="banner" <?= ($kategori->slug == "banner") ? "selected" : "" ?>>Banner</option>
        <option value="about_us" <?= ($kategori->slug == "about_us") ? "selected" : "" ?>>About US</option>
        <option value="team" <?= ($kategori->slug == "team") ? "selected" : "" ?>>Team</option>
        <option value="faq" <?= ($kategori->slug == "faq") ? "selected" : "" ?>>FAQ</option>
    </select>
</div>
<script>
    renderSelect2();
</script>