<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>{{$video_name}}</title>
        <link href="../css/home.css" rel="stylesheet" type="text/css"> 
        <link href="../css/cyberpunk_item.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Zen Dots' rel='stylesheet'>
    </head>
    <body class="background"> 
        <div class="video_page_size video_page_small_size" >
            <div class="div div_size div div_flex_row_center" >  
                <div class="video_page_scroll" style="height:100%;width:95%">
                    <video controls id="video" class="full_size"  src="/file/{{$file_name}}" ></video>
                    <b class="text_color">{{$video_name}}</b><br>
                    <p class="text_color">information</p><br>
                    <p class="text_color">information</p><br>
                </div>
            </div>
        </div>
        <div class="right_page_size right_page_small_size">
            <div class ="div div_size">
                <p class="text">testttttttttttttttttttttttt</p>
            </div>
        </div>
        <div class="right_page_size" id="home_page" style="display:none">
            <div class ="div div_size">
                <p class="text">home</p>
            </div>
        </div>
        <div class="right_page_size" id="account_detail_page" style="display:none">
            <div class ="div div_size">
                <p class="text">account detail</p>
            </div>
        </div>
        <div class="right_page_size" id="setting_page" style="display:none">
            <div class ="div div_size">
                <p class="text">setting</p>
            </div>
        </div>
        <div class="bottom_list_size">
            <div class="div div_size list_flex list_flex_small_size" >
                <div class="search_flex search_flex_small_size">
                    <input class="search_input_size"></input>
                    <button class="btn search_btn_size">search</button>
                </div>
               <div class="div_btn_flex div_btn_flex_small ">
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size" onclick="set_page('home_page')">home</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size" onclick="set_page('account_detail_page')">account detail</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size" onclick="set_page('setting_page')">setting</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size">logout</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size">test</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size"> 
                        <button class="btn full_size btn_size">test</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size">test</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size">test</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size">test</button>
                    </div>
                    <div class="btn_flex btn_flex_small_size">
                        <button class="btn full_size btn_size">test</button>
                    </div>
               </div>
            </div>
        </div>
    </body>
    <script src ="/js/home.js"></script>
</html>