

    <div class="container mt-3">
        <h2>Show Products</h2>
        <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add New Product
            </button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Desccription</th>
                    <th>Product Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($products){
                        $i = 1;
                        foreach($products as $key => $value){                     
                ?>
                <tr>
                    <td><?php echo $i; $i++?></td>
                    <td><?=$value['product_name']?></td>
                    <td><?=$value['product_price']?></td>
                    <td><?=$value['product_desccription']?></td>
                    <td>
                        <?php
                            foreach(explode(',',$value['image']) as $image){                                
                                echo '<img src="'.base_url().'assets/uploads/products/'.$image.'" width="50" >';
                            }                       
                        ?>
                    </td>
                    <td>
                        <a href="#staticBackdrop" 
                        class="modal-trigger btn btn-md btn-warning edit-product-form-data" 
                        data-bs-toggle="modal" 
                        data-bs-target="#staticBackdrop"
                        data-product_id="<?=$value['id']?>"                        
                        >
                            Update
                        </a>
                    </td>
                </tr>
                <?php
                   }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add new product model -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation edit-form-data-show-value" action="" id="add_new_product_form_data" method="post" enctype="multipart/form-data" novalidate>
                        <div class="row">
                            <div class="alert alert-danger add-new-product-form-data-print-error-msg" style="display:none;width: 100%;"></div>
                        </div>
                        <div class="col-md-8">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" value="" required>
                        </div>
                        <div class="col-md-4">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="text" class="form-control" name="product_price" id="product_price" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="product_desccription" class="form-label">Product Desccription</label>
                            <textarea class="form-control" name="product_desccription" id="product_desccription" placeholder="Required example textarea" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <input type="file" class="form-control" name="product_image[]" id="product_image" aria-label="Choose multipal image" multiple required>
                            <div class="invalid-feedback">Pleas choose product image</div>
                        </div>
                        <div class="col-12">
                            <input class="btn btn-primary" type="submit" value="Submit form">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to get toaster data -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/toastr.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/toastr.min.css" rel="stylesheet">

    <script type="text/javascript">
        <?php if($this->session->flashdata('success')){ ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php }else if($this->session->flashdata('error')){  ?>
            toastr.error("<?php echo $this->session->flashdata('error'); ?>");
        <?php }else if($this->session->flashdata('warning')){  ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
        <?php }else if($this->session->flashdata('info')){  ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
        <?php } ?>
    </script>

    <!-- Form related JS Code -->
    <script>        
        var base_url = '<?php echo base_url();?>';

        $('#add_new_product_form_data').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: base_url + 'welcome/add_new_product_form_data/',
                type: 'post',
                dataType: 'json',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function(){
                    
                },
                success: function(data){
                    if($.isEmptyObject(data.error)){
                        // add_new_product_form_data_print-error-msg
                        $(".add-new-product-form-data-print-error-msg").css('display','none');
                        // $('.add-new-product-form-data-print-error-msg').css('display','block');
                        window.location.href = base_url + data.redirect;
                    }else{
                        $(".add-new-product-form-data-print-error-msg").css('display','block');
                        $(".add-new-product-form-data-print-error-msg").html(data.error);
                        // alert('Something went wrong on form submition');
                    }
                }
            })
        });

        $('.edit-product-form-data').on('click', function(e){
            var product_id = $(this).attr('data-product_id');
            // console.log(product_id);
            e.preventDefault();
            $.ajax({
                url: base_url + 'welcome/edit_product_form_data/',
                type: 'post',
                data: {product_id:product_id},
                dataType: 'json',
                success: function(data){
                    if(data !== null){
                        // console.log(data);
                        // console.log(data.products[0].product_name);                        
                        var html = '';
                        html += '<div class="row"><div class="alert alert-danger add-new-product-form-data-print-error-msg" style="display:none;width: 100%;"></div></div><div class="col-md-8"><label for="product_name" class="form-label">Product Name</label><input type="text" class="form-control" name="product_name" id="product_name" value="'+data.products[0].product_name+'" required><input type="hidden" class="form-control" name="product_id" id="product_id" value="'+data.products[0].id+'"></div><div class="col-md-4"> <label for="product_price" class="form-label">Product Price</label> <input type="text" class="form-control" name="product_price" value="'+data.products[0].product_price+'" id="product_price" value="" required></div><div class="col-md-12"> <label for="product_desccription" class="form-label">Product Desccription</label> <textarea class="form-control" name="product_desccription" value="'+data.products[0].product_desccription+'" id="product_desccription" required>'+data.products[0].product_desccription+'</textarea></div><div class="col-md-12"> <input type="file" class="form-control" name="product_image[]" id="product_image" value="'+data.products[0].product_image+'" aria-label="Choose multipal image" multiple required><div class="invalid-feedback">Pleas choose product image</div></div><div class="col-12 show-related-images"></div><div class="alert alert-success image-delete-success-message" style="display:none;"></div><div class="alert alert-danger">Click image to delete.</div><div class="col-12"> <input class="btn btn-primary" type="submit" value="Submit form"></div>';
                        $('.edit-form-data-show-value').html(html);
                        if(data.products[0].image){
                            const images = data.products[0].image.split(','); 
                            console.log(images);
                            var i;
                            var showImages = '';
                            for(i=0; i<images.length; i++){
                                showImages += '<a href="#" onclick="deleteSingleImage('+data.products[0].id+',\''+images[i]+'\')" id="delete-single-image" data-image="'+images[i]+'" data-product_id="'+data.products[0].id+'"><img src="'+base_url + '/assets/uploads/products/'+images[i]+'" width="100"></a>';
                            }
                            $('.show-related-images').html(showImages);
                        }
                        

                    }
                }
            });
        });

        function deleteSingleImage(id, images)
        {
            console.log(id);
            console.log(images);    
            $.ajax({
                url: base_url + 'welcome/delete_image/',
                type: 'post',
                data: {product_id:id, images:images},
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    // console.log(data.images[0].product_id);
                    // Show rest images
                    if(data.images){
                        var i;
                        var showImages = '';
                        for(i=0; i<data.images.length; i++){
                            showImages += '<a href="#" onclick="deleteSingleImage('+data.images[i].id+',\''+data.images[i].product_image+'\')"><img src="'+base_url + '/assets/uploads/products/'+data.images[i].product_image+'" width="100"></a>';
                        }
                        $('.show-related-images').html(showImages);
                    }
                    $('.image-delete-success-message').css('display','block');
                    $('.image-delete-success-message').html(data.success);
                    // $('.show-related-images').load('.show-related-images');
                    // $('#staticBackdrop').load(' #staticBackdrop > *');
                },
                complete: function(data){
                    // $('.image-delete-success-message').css('display','none');
                    // $('.show-related-images').load('.show-related-images');
                }
            });
        }

        $('#delete-single-image-old').on('click', function(e) {
            e.preventDefault();
            var product_id = $(this).attr('data-product_id');
            var image = $(this).attr('data-image');
            console.log(product_id);
            $.ajax({
                url: base_url + 'welcome/delete_image/',
                type: 'post',
                data: {product_id:product_id, image:image},
                dataType: 'json',
                success: function(data){
                    console.log(data);
                }
            });
        });
    </script>
</body>

</html>