<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Upload</title>
</head>

<body>
    <?php session()->has('validation') ? $error = session('validation') : ''; ?>
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center" style="margin-top: 5rem;">
                <div class="col-md-6 col-12">
                    <form action="<?= base_url('upload'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="upload file" class="form-label">File Foxpro extension</label>
                            <input type="file" name="file_upload[]" class="form-control <?= isset($error['file_upload']) ? 'is-invalid' : ''; ?>" id="upload file" required
                                accept=".dbf" maxsize="10485760" multiple>
                            <div class="invalid-feedback">
                                <?= @$error['file_upload']; ?>
                            </div>
                            <!-- 10MB -->
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim</button>
                    </form>
                </div>
                <div class="col-12 d-none" style="margin-top: 2rem">
                    <h6 class="text-center">Atau</h6>
                </div>
                <div class="col-md-6 col-12 d-none">
                    <form action="<?= base_url('upload/csv'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="upload file" class="form-label">File CSV</label>
                            <input type="file" name="file_upload" class="form-control <?= isset($error['file_upload']) ? 'is-invalid' : ''; ?>" id="upload file" required
                                accept=".csv" maxsize="10485760">
                            <div class="invalid-feedback">
                                <?= @$error['file_upload']; ?>
                            </div>
                            <!-- 10MB -->
                        </div>
                        <button type="submit" class="btn btn-success w-100">Kirim</button>
                    </form>
                </div>
            </div>
            <p class="text-center text-secondary mt-4"> <small>Author <a href="https://github.com/Arpin2286" target="_blank" class="text-decoration-none">@Arpin2286</a></small></p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            <?php if (session()->has('success')): ?>
                Swal.fire({
                    title: "Berhasil",
                    text: '<?= session('success'); ?>',
                    icon: "success"
                });
            <?php elseif (session()->has('error')): ?>
                Swal.fire({
                    title: "Gagal",
                    text: "<?= session('error'); ?>",
                    icon: "error"
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>