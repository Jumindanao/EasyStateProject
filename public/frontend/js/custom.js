
    $(document).ready(function (){
        loadcart();
        loadwishlist();
        $('.addToCartBtn').click(function (e){
            e.preventDefault();
            var productid=$(this).closest('.product_data').find('.productid').val();
            var productquant=$(this).closest('.product_data').find('.qty-input').val();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
            $.ajax(
                {
                    method:"POST",
                    url:"/add-to-cart",
                    data:{
                        'productid':productid,
                        'productquant':productquant  
                    },
                    success:function(response){
                        swal(response.status);
                        loadcart();
                    }
                });
        });

        $('.addToWishlist').click(function (e){
            e.preventDefault();
            var productid=$(this).closest('.product_data').find('.productid').val();
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
            $.ajax(
                {
                    method:"POST",
                    url:"/add-to-wishlist",
                    data:{
                        'productid':productid, 

                    },
                    success:function(response){
                        swal(response.status);
                        loadwishlist();
                    }
                });
        });

       // $('.increment-btn').click(function(e){
           // e.preventDefault();

            //var inc_value = $('.qty-input').val();
           // var inc_value=$(this).closest('.product_data').find('.qty-input').val();
          //  var value = parseInt(inc_value, 10);
           // value = isNaN(value) ? 0: value; //is not a number 
           // if(value < 10)
          //  {
               // value++;
              
               // $(this).closest('.product_data').find('.qty-input').val(value);
            //}
        //});
       

        $('.increment-btn').click(function(e){
            e.preventDefault();

            //var inc_value = $('.qty-input').val();
            var inc_value=$(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0: value; //is not a number 
            if(value < 10)
            {
                value++;
              
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });
        
        $('.decrement-btn').click(function(e){
            e.preventDefault();

           
            var dec_value=$(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(dec_value, 10);
            value = isNaN(value) ? 0: value; //is not a number 
            if(value > 1)
            {
                value--;
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-cart-item').click(function(e){
            e.preventDefault();
           
            var productid=$(this).closest('.product_data').find('.productid').val();

            $.ajax(
                {
                    method:"POST",
                    url:"delete-cart-item",
                    data:{
                        'productid':productid,
                        
                    },
                    success:function(response){
                        swal({
                            title: "Confirmation",
                            text: response.status,
                            icon: "success",
                            timer: 10000, // 10 seconds
                            buttons:{
                                Okey:true,
                                cancelButton:false
                            }
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
        });

        $('.remove-wishlist-item').click(function(e){
            e.preventDefault();
           
            var productid=$(this).closest('.product_data').find('.productid').val();

            $.ajax(
                {
                    method:"POST",
                    url:"delete-wishlist-item",
                    data:{
                        'productid':productid,
                    },
                    success:function(response){
                        swal({
                            title: "Confirmation",
                            text: response.status,
                            icon: "success",
                            timer: 10000, // 10 seconds
                            buttons:{
                                Okey:true,
                                cancelButton:false
                            }
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
        });

       

        $('.changeQuantity').click(function(e){
            e.preventDefault();
            
            var productid=$(this).closest('.product_data').find('.productid').val();
            var quantity=$(this).closest('.product_data').find('.qty-input').val(); 
            data={
                'productid':productid,
                'productquantity':quantity,
            }
            $.ajax(
                {
                    method:"POST",
                    url:"update-cart",
                    data:data,
                    success:function(response){
                        window.location.reload();
                     
                    }
                });
        });
        function loadcart(){
            $.ajax(
                {
                    method:"GET",
                    url:"/load-cart-data",
                    success:function(response){
                        $('.cart-count').html('');
                        $('.cart-count').html(response.count);
                    }
                });
        }
        function loadwishlist(){
            $.ajax(
                {
                    method:"GET",
                    url:"/load-wishlist-count",
                    success:function(response){
                        $('.wishlist-count').html('');
                        $('.wishlist-count').html(response.count);
                    }
                });
        }
    });