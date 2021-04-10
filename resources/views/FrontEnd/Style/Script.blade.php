 <!-- jquery 3.2.1 -->
    <script src="{{asset('source/assets/frontend/js/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Countdown js -->
    <script src="{{asset('source/assets/frontend/js/jquery.countdown.min.js')}}"></script>
    <!-- Mobile menu js -->
    <script src="{{asset('source/assets/frontend/js/jquery.meanmenu.min.js')}}"></script>
    <!-- ScrollUp js -->
    <script src="{{asset('source/assets/frontend/js/jquery.scrollUp.js')}}"></script>
    <!-- Nivo slider js -->
    <script src="{{asset('source/assets/frontend/js/jquery.nivo.slider.js')}}"></script>
    <!-- Fancybox js -->
    <script src="{{asset('source/assets/frontend/js/jquery.fancybox.min.js')}}"></script>
    <!-- Jquery nice select js -->
    <script src="{{asset('source/assets/frontend/js/jquery.nice-select.min.js')}}"></script>
    <!-- Jquery ui price slider js -->
    <script src="{{asset('source/assets/frontend/js/jquery-ui.min.js')}}"></script>
    <!-- Owl carousel -->
    <script src="{{asset('source/assets/frontend/js/owl.carousel.min.js')}}"></script>
    <!-- Bootstrap popper js -->
    <script src="{{asset('source/assets/frontend/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('source/assets/frontend/js/bootstrap.min.js')}}"></script>
    <!-- Plugin js -->
    <script src="{{asset('source/assets/frontend/js/plugins.js')}}"></script>
    <!-- Main activaion js -->
    <script src="{{asset('source/assets/frontend/js/main.js')}}"></script>

    <script src="{{asset('source/assets/frontend/js/simple.money.format.js')}}"></script>
    <!-- paypal -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    @if($url_canonical == route('dathang'))
    <script>
        var usd = document.getElementById("vn_to_usd").value;
      paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
          sandbox: 'AU1aqbLwuw2HGSIQujQRTEMJ-m5aRTR_bKYLggDV8MOcDbR6AEdRKw8WuW5oYsGOMAWoojM-BWZNtu7Q',
          production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
          size: 'small',
          color: 'gold',
          shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
          return actions.payment.create({
            transactions: [{
              amount: {
                total: `${usd}`,
                // total: '0.01',
                currency: 'USD'
              }
            }]
          });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
          return actions.payment.execute().then(function() {
            // Show a confirmation message to the buyer

            window.alert('Thank you for your purchase!');

          });
        }
      }, '#paypal-button');

    </script>
    @endif


    <!-- plugin facebook -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="u24M4rrJ"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
             $('.share').click(function() {
                 var NWin = window.open($(this).prop('href'), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
                 if (window.focus)
             {
             NWin.focus();
             }
             return false;
             });
        });
    </script>
    <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
  </script>


  <!-- yeu thich -->
  <script type="text/javascript">

    function view(){
      if (localStorage.getItem('data')!=null) {
        var data = JSON.parse(localStorage.getItem('data'));

        data.reverse();
        document.getElementById('single_product_like').style.overflow = 'scroll !important';
        document.getElementById('single_product_like').style.height = '100%';
        for(i = 0; i<data.length;i++){
          var name = data[i].name;
          var price = data[i].price;
          var image = data[i].image;
          var url = data[i].url;

          $('#single_product_like').append('<div style="width:20%;height:100%; float:left; margin-right:1%" class="single-product"><div class="pro-img"><a href="'+url+'"><img style="height:200px" class="primary-img" src="'+image+'" alt="single-product"></a></div><div style="background: #fff" class="pro-content"><div class="pro-info"><h4><a href="'+url+'">'+name+'</a></h4><p><span class="price">'+price+'</span></p></div><div class="pro-actions"><div class="actions-primary"><a href="'+url+'" title="Add to Cart"> + Add To Cart</a></div></div></div></div>');
        }
      }
    }

    view();

    function add_wishList(clicked_id){
      var id = clicked_id;
      var name = document.getElementById('wishList_product_name'+id).value;
      var price = document.getElementById('wishList_price'+id).value;
      var image = document.getElementById('wishList_image'+id).src;
      var url = document.getElementById('wishList_producturl'+id).href;

      var newItem = {
          'url':url,
          'id' :id,
          'name': name,
          'price': price,
          'image': image
      }


      if(localStorage.getItem('data')==null){
           localStorage.setItem('data', '[]');
      }

      var old_data = JSON.parse(localStorage.getItem('data'));

      var matches = $.grep(old_data, function(obj){
            return obj.id == id;
      })

      if(matches.length){
        alert('Sản phẩm bạn đã yêu thích,nên không thể thêm');

      }else{
        old_data.push(newItem);
        $('#single_product_like').append('<div style="width:20%;height:50px; float:left; margin-right:1%" class="single-product"><div class="pro-img"><a href="'+url+'"><img style="height:200px" class="primary-img" src="'+image+'" alt="single-product"></a></div><div style="background: #fff" class="pro-content"><div class="pro-info"><h4><a href="'+url+'">'+name+'</a></h4><p><span class="price">'+price+'</span></p></div><div class="pro-actions"><div class="actions-primary"><a href="'+url+'" title="Add to Cart"> + Add To Cart</a></div></div></div></div>');
      }

      localStorage.setItem('data', JSON.stringify(old_data));

        // alert(price);


    }
  </script>

  <!-- sap xep -->
  <script type="text/javascript">
    $(document).ready(function(){

    $('#sort').on('change',function(){

        var url = $(this).val(); 
          if (url) { 
              window.location = url;
          }
        return false;
        });

    }); 
  </script>

<script type="text/javascript">
  $(document).ready(function(){

     $( "#slider-range" ).slider({
        orientation: "horizontal",
        range: true,

        min:{{$min_price}},
        max:{{$max_price_range}},

        steps:10000,
        values: [ {{$min_price}}, {{$max_price}} ],
       
        slide: function( event, ui ) {
          $( "#amount_start" ).val(ui.values[ 0 ]).simpleMoneyFormat();
          $( "#amount_end" ).val(ui.values[ 1 ]).simpleMoneyFormat();


          $( "#start_price" ).val(ui.values[ 0 ]);
          $( "#end_price" ).val(ui.values[ 1 ]);

        }

      });

      $( "#amount_start" ).val($( "#slider-range" ).slider("values",0)).simpleMoneyFormat();
      $( "#amount_end" ).val($( "#slider-range" ).slider("values",1)).simpleMoneyFormat();

  }); 
</script>

