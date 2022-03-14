
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\fashi.com\fashi\css\bootstrap.min.css">
        <link rel="stylesheet" href="\fashi.com\fashi\css\notyf.min.css">
        <title>Admin | Control Panel</title>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control mb-3" name="file" id="file">
                        <button class="btn btn-success" name="submit" type="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="\fashi.com\fashi\js\jquery-3.3.1.min.js"></script>
        <script src="\fashi.com\fashi\js\notyf.min.js"></script>
        <script>
           
           const form = document.querySelector('form')
           form.addEventListener('submit', e => {
               e.preventDefault();
               fetch('upload.php', {
                   method: 'POST',
                   body: new FormData(form)
               })
               .then(res => res.json())
               .then(data => {
                   var notyf = new Notyf();
                   if (data.msg == 'Success') {
                        notyf.success({
                        message: data.msg,
                        duration: 4000,
                        position: {
                            x: 'right',
                            y: 'top'
                            }
                        })
                   } else {
                       notyf.error({
                       message: data.msg,
                       duration: 4000,
                       position: {
                            x: 'right',
                            y: 'top'
                            }
                       })

                   }
               })
               .catch(err => console.log(err))
           })
        </script>
    </body>
    </html>