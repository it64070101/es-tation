<header class="bg-primary">
    <div class="container d-flex" style="height: 75px;" id="headerContainerDiv">
        <div class="col-lg-2 col-md-3 col-sm-3 col-3" id="webNameDiv">
            <a href="index.php">
                <h1 class="text-white" style="margin-top: 5%;">es'tation</h1>
            </a>
        </div>
        <div class="col-6" id="searchInputDiv">
            <input type="text" name="search" id="searchInput" style="height: 40%; border-radius: 0.2rem; border: 1px;">
            <button class="btn">
                <i class="fa fa-search bg-white"></i>
            </button>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6  text-end" style="margin-top: 20px;" id="headerButtonDiv">
            <a href="payment.php"><button class="headerButton bg-primary" id="headerPaymentButton">payment</button></a>
            <a href="shipping.php"><button class="headerButton bg-primary"
                    id="headerShippingButton">shipping</button></a>
            <?php 
            ?>
            <a href="cart.php"><button class="headerButton bg-primary" id="headerCartButton"><i
                        class="fa fa-shopping-cart" aria-hidden="true"></i></button></a>

            <a href="login.php"><button class="headerButton bg-primary" id="headerProfileButton"><i class="fa fa-user"
                        aria-hidden="true"></i></button></a>
        </div>
    </div>
</header>