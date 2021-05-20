
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    ?>
    <section class="py-5 bg-light">
            <div class="container">
                <h2 id="HomePageCategories">Main Categories</h2>


               





     
                        
                            <form action="RicercaCategoriePHP.php" method="post" class="">
                                    <input class="form-control " type="text" name="search" placeholder="Search.."> <br>
                            <div class="result">
                              
                            </div>
                       
                            </form>

            
    
	
	

                <div class="row">
<?php 
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/GettingCategories.php');
while ($row = $resultCategories->fetch()) {
echo '
<div class="col-lg-4 col-sm-12 mb-4">
<a href="/EZCUT/User/CategorySalons.php?CategoryPass='.$row['ServiceCategoryName'].'">
                        <div class="card h-100">
                            <img class="card-img-top" src="/EZCUT/Images/ServiceCategoryImages/'.$row['ImageName'].'" alt="..." />
                            <div class="card-body">
                                <h4 class="card-title">'.$row['ServiceCategoryName'].'</h4>
                                
                            </div>
                        </div>
                        </a>
                    </div>
';

}?>
</div>
</div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $(' input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("RicercaCategoriePHP.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    
});
</script>
  </body>
</html>
