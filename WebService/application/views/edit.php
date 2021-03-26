<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="<?php echo base_url('home/proses_edit'); ?>" method="POST" id="tambah-pengguna">
<input type="hidden" name="id" value="<?= $edit['id'] ;?>">  
<div class="form-group">
          <label for="rt">RT  </label>
          <input type="text" name="rt" id="rt" value="<?php echo $edit['rt'] ;?>">
     </div>
     
     
     <div class="form-group">
          <label for="rw">RW</label>
          <input type="text" name="rw" id="rw"value="<?php echo $edit['rw'] ;?>">
     </div>
     <button type="submit" name="simpan" class="btn btn-default">Simpan</button>
     </div>
</form>
</body>
</html>