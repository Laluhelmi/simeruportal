<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
        
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <table class="table">
            <thead>
            <th>hari</th>
            <th>jam</th>
            <th>matkul</th>
        </thead>
        <tbody>
            <?php
            $kuliah = array(array('jam' => '07.50-08.40', 'hari' => 'selasa'),
                array('jam' => '09.35-10.25', 'hari' => 'sabtu'));
            $jam = array('07.00-07.50', '07.50-08.40', '08.45-09.35', '09.35-10.25', '10.30-11.20'
                , '11.20-12.10');
            $data = array(array('nama' => 'senin', 'jam' => $jam),
                array('nama' => 'selasa', 'jam' => $jam),
                array('nama' => 'rabu', 'jam' => $jam),
                array('nama' => 'kamis', 'jam' => $jam),
                array('nama' => 'jumat', 'jam' => $jam),
                array('nama' => 'sabtu', 'jam' => $jam));

            for ($i = 0; $i < count($data); $i++) {
                ?>
                <?php
                for ($index = 0; $index < count($jam); $index++) {
                    ?>
                    <tr>
                        <?php if ($index == 0) { ?>
                            <td rowspan="6"><?php echo $data[$i]['nama']; ?></td>

                        <?php } ?>
                        <td><?php echo $data[$i]['jam'][$index]; ?></td>
                        <?php
                        for($cek =0;$cek<count($kuliah);$cek++){
                        ?>
                        <?php if($kuliah[$cek]['hari'] == $data[$i]['nama']
                               && $kuliah[$cek]['jam'] == $data[$i]['jam'][$index]){?>
                        <td><?php echo $kuliah[$cek]['jam'];?></td>
                        <?php }?>
                        <?php }?>
                    </tr>

                    <?php
                }
                ?>
                <?php
            }
            ?></tbody>
    </table>
</body>
</html>
