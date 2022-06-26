<div class="container mt-3">
    <h2>CSV Data Import / Export</h2>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <form class="form-control" id="csv-form-data" action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choose CSV File</label>
                    <input class="form-control" type="file" id="csv_file" name="csv_file">
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var base_url = '<?=base_url()?>';
    $('#csv-form-data').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: base_url + 'csv_data/get_csv_form_data',
            type:'post',
            dataType:'json',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    });
</script>