<body>


    <h1 class="text-margin"> Add your advertisement </h1>
    <form method="post" action="/advertisements/db/CreateAd.php" class="form-input" enctype="multipart/form-data">
        <mark>Sell </mark><input type="radio" name="sell_buy" value="Selling">
        <mark>Buy</mark> <input type="radio" name="sell_buy" value="Buying"> </br>

        Title:<br> <input type="text" name="title"> <br>
        <br>
        <textarea name="ad" class="form-input col-6 p-centered" placeholder="Your ad"></textarea> <br>
        Image:<input type="file" name="image" accept="image/*" /> <br>
        Price: <br> <input type="number" name="price"> <br>

        Your email:<br> <input type="email" name="email"> <br>

        <input type="submit" class="btn btn-primary input-group-btn" name="submit" value="Submit"> </input>
    </form>

</body>