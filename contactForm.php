<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function()
      {
      function validateEmail(email) 
      {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      }
      $("#email").blur(function() 
      {
        var $res = $("#validate_email_message");
        var email = $("#email").val();
        $res.text("");
        $res.hide();

        if (validateEmail(email)) 
        {
          $res.hide();
        } 
        else 
        {
          $res.show();
          $res.text(email + " is not valid :(");
          $res.css("color", "red");
        }
    });
  });
  </script>


<div class="row">
    <div class="col-75">
      <form action="email.php" method="post">
      
        <div class="row">
          <div class="col-50">
            <h3 style="text-align: center;">Personal Information</h3>
            <label for="fname"><b>Full Name<b/><span style="color:red"> *</span></label>
            <input type="text" id="fname" name="firstname" required >
            
            <label for="email"><b>Email Address<b/><span style="color:red"> *</span></label>
            <label id="validate_email_message" style="color:red"></label>
            <input type="text" id="email" name="email" onblur="validate()" required>
            
            <label for="adr"><b>Home Address<b/><span style="color:red"> *</span></label>
            <input type="text" id="adr" name="address" required>
            
            <label for="city"><b>Suburb<b/><span style="color:red"> *</span></label>
            <input type="text" id="city" name="city" required>

            <div class="row">
              <div class="col-50">
                <label for="state"><b>State<b/><span style="color:red"> *</span></label>
                <input type="text" id="state" name="state" required>
              </div>
              
              <div class="col-50">
                <label for="country"><b>Country<b/><span style="color:red"> *</span></label>
                <input type="text" id="country" name="country" required>
              </div>
            </div>
          </div>
       
        </div>

        <input type="submit" value="Purchase" class="btn">
      </form>
  </div>
</div>





