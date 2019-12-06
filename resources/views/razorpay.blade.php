<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>
</nav>

<div class="container">
	<div class="row">
		<h1>Purchase our product.</h1>
	</div>
	<div class="row">
		<div class="col-sm-offset-3 col-sm-6">
			<form id="pay_form">
			  <div class="form-group">
			    <label for="email">Product Name</label>
			    <input type="text" class="form-control" id="product">
			  </div>
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" id="email">
			  </div>
			  <div class="form-group">
			    <label for="email">Mobile</label>
			    <input type="number" class="form-control" id="mobile">
			  </div>
			  <div class="form-group">
			    <label for="pwd">Amount:</label>
			    <input type="number" class="form-control" id="amount">
			  </div>
			  <button type="submit" class="btn btn-success pay_btn">Pay Now</button>
			</form>			
		</div>
	</div>	
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
	$(function(){
		$(".pay_btn").click(function(e) {
			e.preventDefault();
			product = $("#product").val()
			email = $("#email").val()
			mobile = $("#mobile").val()
			amount = $("#amount").val()


           var options = {
           "key": "rzp_test_zR9owClk0lA0jW",
           "amount": (amount*100), // 2000 paise = INR 20
           "name": "Manish Foundation",
           "description": "Payment",
           "image": "https://timesofindia.indiatimes.com/thumb/msid-69902898,imgsize-115506,width-800,height-600,resizemode-4/69902898.jpg",
           "handler": function (response){
                 $.ajax({
                   url: '{{ url("/paysuccess") }}',
                   type: 'post',
		              headers:{
		                 'X-CSRF-TOKEN': "{{ csrf_token() }}"
		               },   

                   dataType: 'json',
                   data: {
                     razorpay_id : response.razorpay_payment_id , 
                     amount : amount,
                     product : product,
                     email : email,
                     mobile : mobile,
                   },
                   success: function (msg) {
          			
                       window.location.href = "{{ url('thankYouBlade') }}";
                   }
               });
             
           },
          "prefill": {
               "contact": mobile,
               "email":   email,
           },
           "theme": {
               "color": "#528FF0"
           }
         };



         var rzp1 = new Razorpay(options);
         rzp1.open();

		})
	})
</script>
</body>
</html>