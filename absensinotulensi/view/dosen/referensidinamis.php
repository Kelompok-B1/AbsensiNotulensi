DATA HOSTED WITH ♥ BY PASTEBIN.COM - DOWNLOAD RAW - SEE ORIGINAL
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form Dinamis</title>
    <meta content="width=device-width,initial-scale=1" name=viewport>
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/bootstrap.min.css" />
</head>
<body>
   
    <div class="container">
 
        <div class="row">
 
            <div class="col-md-8 col-md-offset-2">
 
                <h4 style="text-align: center; margin-top:20px">Form Dinamis by Kangjaz.Com</h4>
                <hr />
 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Anggota</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Opsi Form</th>
                        </tr>
                    </thead>
 
                    <tbody id="form-body">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="nama[]" placeholder="Nama Anggota">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="alamat[]" placeholder="Alamat">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="hp[]" placeholder="Telp">
                            </td>
                            <td>
                               
                            </td>
                        </tr>
                    </tbody>
                </table>
 
                <button type="button" onclick="add_form()" class="btn btn-success">Tambah Form</button>
            </div>
 
        </div>
       
    </div>
    <!-- load jquery -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- Custom JavaScript -->
    <script type="text/javascript">
        function add_form()
        {
            var html = '';
 
            html += '<tr>';
            html += '<td><input type="text" class="form-control" name="nama[]" placeholder="Nama Anggota"></td>';
            html += '<td><input type="text" class="form-control" name="alamat[]" placeholder="Alamat"></td>';
            html += '<td><input type="text" class="form-control" name="hp[]" placeholder="Telp"></td>';
            html += '<td><button type="button" class="btn btn-danger" onclick="del_form(this)">Hapus</button></td>';
            html += '</tr>';
 
            $('#form-body').append(html);
        }
 
        function del_form(id)
        {
            id.closest('tr').remove();
        }
    </script>
</body>
</html>