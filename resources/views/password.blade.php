<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>password</title>
        <link href="/css/password.css" rel="stylesheet" type="text/css"> 
        <link href="/css/cyberpunk_item.css" rel="stylesheet" type="text/css"> 
        <link href='https://fonts.googleapis.com/css?family=Zen Dots' rel='stylesheet'>
    </head>
    <body>
        <div class="center div_size div p_center" style="display:inline-block;text-align:right;" >
            <form id="form" method="POST" action="/home">
            @csrf
                <div>
                    <b class="text text_size">account</b>
                    <input id="account" name="account" type="text" style="margin:5px"><br>
                </div>
                <div>
                    <b class="text text_size" >password</b>
                    <input id="password" name="password" type="password" style="margin:5px"><br>
                </div>
            </form>
            <div style="margin:5px;">
                <?php if(isset($_GET['result'])){
                        print("<b style=\"color:#E8E8E8\"; >".$_GET['result']."</b>");} ?>
                <?php if(isset($_GET['error'])){
                        print("<b class=\"text_size\" style=\"color:#B80000\">".$_GET['error']."</b>");} ?>
                
            </div>
            <a href="/register" class="text">Register<a>
            <button class="btn btn_size" onclick="login()">login</button><br>
        </div>
    </body>
    <script src ="/js/cyberpunk.js"></script>
    <script> function login() {
                let form = document.getElementById("form");
                if(!form.account.value){
                    alert("account is empty")
                } 
                else if (!form.password.value){
                    alert("password is empty")
                }
                else{
                    form.submit()
                }
            }
    </script>
    <script>
        document.onkeyup = function(e){
            if(e.keyCode==13){
                login();
            }
        }
    </script>
</html>