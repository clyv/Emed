<link rel="stylesheet" type="text/css" href="./style2.css">
<?php
session_start();
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = '';
$db = 'emed';

$con = new mysqli($mysql_host, $mysql_user, $mysql_password, $db) or die();
$status = "";
if (isset($_POST['code']) && $_POST['code'] != "") {
    $code = $_POST['code'];
    $result = mysqli_query($con, "SELECT * FROM `cart` WHERE `code`='$code'");
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $code = $row['code'];
    $price = $row['price'];
    $image = $row['image'];

    $cartArray = array(
        $code => array(
            'name' => $name,
            'code' => $code,
            'price' => $price,
            'quantity' => 1,
            'image' => $image
        )
    );

    if (empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='box'>Product is added to your cart!</div>";
    } else {
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if (in_array($code, $array_keys)) {
            $status = "<div class='box' style='color:red;'>
        Product is already added to your cart!</div>";
        } else {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
            $status = "<div class='box'>Product is added to your cart!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical Store - Cold</title>
    <link rel="stylesheet" type="text/css" href="diab.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="store.js"></script>

</head>

<body style="font-family: verdana; ">

    <header>
        <center>
            <i class="fa fa-ambulance" aria-hidden="true"></i>
            <h2>EMED.COM</h2>
        </center>
        <div>
            <div class="topnav">
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div id="mySidenav" class="sidenav">

                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="home.html">Home <i class="fa fa-home" aria-hidden="true"></i></a>
                <div class="dropdown">
                    <div class="dropbtn">Category <i class="fa fa-list-alt" aria-hidden="true"></i>
                    </div>
                    <div class="dropdown-content">
                        <a href="covid.php" style="color: blanchedalmond;font-size: medium;">Covid Supply</a>
                        <a href="diabetes.php" style="color: blanchedalmond;font-size: medium;">Diabetics</a>
                        <a href="cold.php" style="color: blanchedalmond; font-size: medium;">Cold & Fever</a>
                        <a href="bp.php" style="color: blanchedalmond;font-size: medium;">Blood pressure</a>
                        <a href="cardio.php" style="color: blanchedalmond;font-size: medium;">CardioVascular
                            Meds</a>
                    </div>
                </div>
                <a href="https://www.medscape.com/">MedUpdates <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
                <a href="cart.php">Cart <i class="fa fa-cart" aria-hidden="true"></i></a>
                <a href="log.php">Log Out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
    </header>
    <?php
    if (!empty($_SESSION["shopping_cart"])) {
        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    ?>
        <div class="cart_div">
            <a href="cart.php">Cart<span><?php echo $cart_count; ?></span></a>
        </div>
    <?php
    } ?>




    <hr>
    <br>
    <div class="text-top">
        <h2 style="text-align: center;">Cold & Fever</h2>
        <p>Flushed, hot face, but find yourself needing layers of blankets to avoid the chills?
            This sounds like fever symptoms,
            but you would not know until you take your temperature.
            Often caused by a cold or flu virus, fevers can knock you off your feet and straight into bed.
            Medicines like NyQuil and DayQuil have acetaminophen, an active ingredient that reduces fever.
            Find out what causes fever, so you can treat it and feel better.
            <br><br>
            A fever is the elevation of body temperature above the ideal temperature of 98.6&#8457; (37&#8451;).<br> The
            U.S. Centers
            for Disease Control and Prevention (CDC) defines a fever as a temperature at or above 100.4&#8457;
            (38&#8451;).<br>

            Fevers are extremely common and tend to occur as part of the body&#39;s response to infection as it works to
            protect
            itself and fight off viruses like a cold or the flu.

            The specific nature and severity of fevers vary depending on a number of factors. Fevers can work to combat
            problematic conditions within the body such as to kill off invading cold and flu viruses.
            Fevers also need to be monitored to ensure that they do not get high enough to cause damage to your body.
        </p>
    </div>
    <br>
    <hr>
    <br>


    <?php

    $no=1;
    $result = mysqli_query($con, "SELECT * FROM `cart` WHERE id>=9 and id<13;");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
                <div class='card'>
            
                    <br>
          
                <div class='prod_info'>
                 <div class='prodcont'>
                    <div  class='rate' id='points".$no."' >

                       Reviews : ".$row['location']."
                    </div>
                 <br>

                <div class='image'><img src='" . $row['image'] . "'; width='350px'; /></div>
      
         
          <form method='post' action=''>
          
          <input type='hidden' name='code' value=" . $row['code'] . " />
          
          <div class='addbtn3'>
            <div class='name'>" . $row['name'] . "</div>
            <div class='price'>$" . $row['price'] . "</div>
          </div>
          <button type='submit' class='buy'>Buy Now</button>
           <span onclick='showcmt".$no."()' class='addBtn2'>Comments</span>
           <br><br>
                <div id='popon".$no."' class='backpop'>
                    <div id='popin".$no."' class='contpop'>
                    <span onclick='closecmt".$no."()' class='close'>&times;</span>
                        <div id='myDIV' class='header'>
                        
                          <h2 style='margin:5px'>Comments</h2>
                          <input type='text' id='myInput".$no."' placeholder='Your comment...'>
                          <span onclick='newElement".$no."()' class='addBtn'>Add</span>
                        </div>

                        <ul id='myUL".$no."'>
                          <li>The product has worked like a charm. Thank you!!</li>
                          
                        </ul>
                    </div>
                </div>
          <br><br> 
           </div>
          </div>
          </form>
         
          </div>";
          $no++;
    }

    mysqli_close($con);
    ?>
    <script type="text/javascript">
var globalcount=0;
function showcmt1() {
    var modal1 = document.getElementById("popon1");
    modal1.style.display = "block";

}
function showcmt2() {
    var modal2 = document.getElementById("popon2");
    modal2.style.display = "block";

}
function showcmt3() {
    var modal3 = document.getElementById("popon3");
    modal3.style.display = "block";

}
function showcmt4() {
    var modal4 = document.getElementById("popon4");
    modal4.style.display = "block";

}
function closecmt1() {
    var modal1 = document.getElementById("popon1");
    modal1.style.display = "none";

}
function closecmt2() {
    var modal2 = document.getElementById("popon2");
    modal2.style.display = "none";

}
function closecmt3() {
    var modal3 = document.getElementById("popon3");
    modal3.style.display = "none";

}
function closecmt4() {
    var modal4 = document.getElementById("popon4");
    modal4.style.display = "none";

}




// Create a new list item when clicking on the "Add" button
function newElement1() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput1").value;

  
     

      


  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL1").appendChild(li);
    if (globalcount%2 == 0)
    {
        document.getElementById("points1").innerHTML = "Reviews : 5";
    }
    else{
        document.getElementById("points1").innerHTML = "Reviews : 4";
    }
    globalcount++;
  }
  document.getElementById("myInput1").value = "";

 




  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}
function newElement2() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput2").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL2").appendChild(li);
     if (globalcount%2 == 0)
    {
        document.getElementById("points2").innerHTML = "Reviews : 5";
    }
    else{
        document.getElementById("points2").innerHTML = "Reviews : 4";
    }
    globalcount++;
  }
  document.getElementById("myInput2").value = "";

 




  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}

function newElement3() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput3").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL3").appendChild(li);
     if (globalcount%2 == 0)
    {
        document.getElementById("points3").innerHTML = "Reviews : 5";
    }
    else{
        document.getElementById("points3").innerHTML = "Reviews : 4";
    }
    globalcount++;
  }
  document.getElementById("myInput3").value = "";

 




  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}

function newElement4() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput4").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL4").appendChild(li);
     if (globalcount%2 == 0)
    {
        document.getElementById("points4").innerHTML = "Reviews : 5";
    }
    else{
        document.getElementById("points4").innerHTML = "Reviews : 4";
    }
    globalcount++;
  }
  document.getElementById("myInput4").value = "";

 




  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}
</script>









    <br><br><br><br><br><br>


    <div class="bottom">
        <div style="clear:both;"></div>

        <div class="message_box" style="margin:10px 0px;">
            <?php echo $status; ?>
        </div>



        <div class="footer">
            <br><br>
            <h2>About</h2>
            This is a medical store website developed using html and css
            <br>
            <p>for more information contact us:<br> Medicalstore@gmail.com

                <br>Mobileno-98246XXXXX</p>
        </div>
        <marquee scrollamount="15">
            <h4>We ensure contact free delivery and highest quality. Daily offers on medicine avaliable. Avail now</h4>
        </marquee>

</body>

</html>