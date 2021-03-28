<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="<?= base_url('home/tambah') ;?>" >Tambah Data</a>
    <table>
        <tr>
            <td>Id</td>
            <td>RT</td>
            <td>RW</td>
        </tr>
<?php foreach($rtrw as $input):?>

        <tr>
            <td><?php echo $input['id'] ?></td>
            <td><?php echo $input['rt'] ?></td>
            <td><?php echo $input['rw'] ?></td>
            <td> <a href="<?= base_url(); ?>home/edit/<?= $input['id'];?>" >edit</i></a></td>
            <td>  <a href="<?= base_url(); ?>home/hapus/<?= $input['id'];?>" >hapus</i></a></td>

        </tr>
        <?php endforeach;
        ?>
    </table>

</body>
</html>