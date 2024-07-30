<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MODAL BOOTSTRAP PLUGINS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- DATA TABLES CSS PLUGIN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>
    <title>Read CSV</title>

</head>

<body>
    <div class="card">
        <div class="card-body">
            <div>
                <form action="convertcsv.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <div>
                                <a href="senior_active.php" data-toggle="tooltip" data-placement="bottom" title="Go Back"><i class="fas fa-arrow-left" style="font-size: 1.7rem; margin: 0;"></i></a>
                            </div>
                        </div>
                        <div class="form-group col-md-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file-input" name="file-input" required>
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="submit" value="Upload" name="upload" id="upload" class="btn btn-primary"></input>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <?php
                if (!empty(isset($_POST["upload"]))) {
                    $filename = $_FILES['file-input']['name'];
                    //check valid file extension
                    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $file_ext_tolower = strtolower($file_ext);

                    //set valid file extension
                    $allowed_extension = "csv";
                    if ($file_ext_tolower == $allowed_extension) {
                        if (($fp = fopen($_FILES["file-input"]["tmp_name"], "r")) !== FALSE) {
                            echo $filename;
                ?>
                            <table class="tutorial-table" width="100%" border="1" cellspacing="0">
                                <?php
                                $i = 0;
                                while (($row = fgetcsv($fp)) !== false) {
                                    $class = "";
                                    if ($i == 0) {
                                        $class = "header";
                                    }
                                ?>
                                    <tr>
                                        <td class="<?php echo $class; ?>"><?php echo $row[0]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[1]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[2]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[3]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[4]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[5]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[6]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[7]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[8]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[9]; ?></td>
                                        <td class="<?php echo $class; ?>"><?php echo $row[10]; ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                fclose($fp);
                                ?>
                            </table>
                <?php
                            $response = array("type" => "success", "message" => "CSV is converted to HTML successfully");
                        } else {
                            $response = array("type" => "error", "message" => "Unable to process CSV");
                        }
                    } else {
                        echo "<script>alert('Invalid File Type');</script>";
                    }
                }
                ?>
            </div>
            <?php if (!empty($response)) { ?>
                <div class="response <?php echo $response["type"]; ?>
    ">
                    <?php echo $response["message"]; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>

    <!-- Bootstrap and Jquery plugin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Data tables plugin -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()
        })
    </script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>

</html>