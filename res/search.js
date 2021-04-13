function makeSearchList(coins){
    var list = document.getElementById("coin-list");
    
    coins.forEach(function(coin){
        list.insertAdjacentHTML('beforeend',
        "<li class='crypto clickable' onClick='parent.location=\"bitcoin.html\"'>" + coin + "<br/><br/></li>");
    });
}

/* Code based on https://www.geeksforgeeks.org/search-bar-using-html-css-and-javascript/*/ 
function searchCoins() {
    search_entry = document.getElementById('main-search-bar').value;
    crypto_name = document.getElementsByClassName('crypto');
    search_entry = search_entry.toLowerCase();

    for (i = 0; i < crypto_name.length; i++) {  
        if (crypto_name[i].innerHTML.toLowerCase().includes(search_entry)) { 
            crypto_name[i].style.display="list-item"; 
            
        }
        if (!crypto_name[i].innerHTML.toLowerCase().includes(search_entry)) { 
            crypto_name[i].style.display="none"; 
            
        }  
    } 
}