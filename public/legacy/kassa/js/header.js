document.querySelector("#cashDeskBtn").addEventListener("click", function(event){
    document.querySelector("#menuPage").classList.add("hidden");
    document.querySelector("#salesPage").classList.add("hidden");
    document.querySelector("#cashDeskPage").classList.remove("hidden");
});

document.querySelector("#menuBtn").addEventListener("click", function(event){
    document.querySelector("#menuPage").classList.remove("hidden");
    document.querySelector("#salesPage").classList.add("hidden");
    document.querySelector("#cashDeskPage").classList.add("hidden");
});

document.querySelector("#salesBtn").addEventListener("click", function(event){
    document.querySelector("#menuPage").classList.add("hidden");
    document.querySelector("#salesPage").classList.remove("hidden");
    document.querySelector("#cashDeskPage").classList.add("hidden");
});