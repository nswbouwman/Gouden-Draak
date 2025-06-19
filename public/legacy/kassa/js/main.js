document.getElementsByClassName("close")[0].addEventListener("click", function(event){
    document.querySelector("#myModal").style.display = "none";
});

window.onclick = function(event){
    var modal = document.querySelector("#myModal");
    if(event.target == modal){
        modal.style.display = "none";
    }
}