const page_list=['home_page','account_detail_page','setting_page']
function set_page(page_name){
    let page = document.getElementById(page_name);
    if(page.style.display=="none"){
        for (let i=0;i<page_list.length;i++){
            let none_page = document.getElementById(page_list[i]);
            none_page.style.display="none";
        }
        page.style.display="block";
    }else if (page.style.display=="block"){
        page.style.display="none";
    }
}