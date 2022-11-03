var exibe = document.getElementById("exibe")

if(document.cookie.indexOf(['atualizado'])>=0){
    exibe.innerHTML = "Atualizado com sucesso"
    exibe.style.backgroundColor =  "teal"
    exibe.style.color = "white"
    exibe.style.textAlign = "center"
    exibe.className = "show"
    setTimeout(()=>{
        exibe.style.display = 'none'
    }, 3000)

document.cookie = "atualizado=; expires=Thu, 01 Jan1970 00:00:00 UTC; path=/teste.php" 

}