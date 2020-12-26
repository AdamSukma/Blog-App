function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }

}

function callAjax(url, inner) {
    var xmlhttp = getXMLHTTPRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = function () {
        document.getElementById(inner).innerHTML = '<img src ="../images/ajax_loader.png">';
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
            document.getElementById(inner).innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}

function showPost(idkategori){
    var inner = "post";
    var url = 'get_post.php?id='+idkategori;
    if(idkategori == 'default'){
        document.getElementById.innerHTML = '';
    }else{
        callAjax(url,inner);
    }
}
