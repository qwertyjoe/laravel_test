<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Register</title>
        <link href="/css/cyberpunk_item.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Zen Dots' rel='stylesheet'>
        <link href="/css/password.css" rel="stylesheet" type="text/css">
    </head>
    <body> 
    <div class="center div div_size p_center" style="display:inline-block;text-align:right;" >
            <form id="form" method="POST" action="/register">
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
            <div style="margin:5px">
                <?php if(isset($_GET['error'])){
                    print("<b class=\"text_size\" style=\"color:#B80000\">".$_GET['error']."</b>");} ?>
            </div>
            <button class="btn" style="height:40px;font-size:18px;margin:5px;" onclick="register()">Register</button><br>
        </div>
    </body>
    <script>
        function register(){
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
                register();
            }
        }
    </script>
    <script src ="/js/cyberpunk.js"></script>
</html>