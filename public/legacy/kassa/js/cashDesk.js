var menuItems = document.querySelectorAll(".addMenuItem");

for(var index = 0; index < menuItems.length; index++){
    menuItems[index].addEventListener("click", function(event){
        document.querySelector(".itemSelectedTable .menuItem_" + event.target.value + " input").value = 1;
        document.querySelector(".itemSelectedTable .menuItem_" + event.target.value).classList.remove("hidden");
        document.querySelector(".itemSelectedTable .menuItem_" + event.target.value).classList.add("selected");
        document.querySelector(".menuItem_" + event.target.value + " .subAmount").innerHTML =
        parseFloat(document.querySelector(".menuItem_" + event.target.value).dataset["price"]).toFixed(2).replace(",", "").replace(".", ",");

        // Update total price
        document.querySelector(".totalAmount").innerHTML = 
            (parseFloat(document.querySelector(".totalAmount").innerHTML) +
            parseFloat(document.querySelector(".menuItem_" + event.target.value).dataset["price"])).toFixed(2);
    });
}

var selectedMenuItemsInput = document.querySelectorAll(".itemSelectedTable input");

for(var index = 0; index < selectedMenuItemsInput.length; index++){
    selectedMenuItemsInput[index].addEventListener("change", function(event){
        if(event.target.value == 0){
            document.querySelector(".itemSelectedTable .menuItem_" + event.target.name).classList.add("hidden");
            document.querySelector(".itemSelectedTable .menuItem_" + event.target.name).classList.remove("selected");
            document.querySelector(".menuItem_" + event.target.name + " .subAmount").innerHTML =
                parseFloat(document.querySelector(".menuItem_" + event.target.name).dataset["price"]).toFixed(2).replace(",", "").replace(".", ",");
        } else {
            document.querySelector(".menuItem_" + event.target.name + " .subAmount").innerHTML =
                (parseFloat(document.querySelector(".menuItem_" + event.target.name).dataset["price"]) * event.target.value).toFixed(2).replace(",", "").replace(".", ",");
        }

        // update total price
        var selectedItems = document.querySelectorAll(".itemSelectedTable .selected .subAmount");
        var total = 0;

        for(var selectedIndex = 0; selectedIndex < selectedItems.length; selectedIndex++){
            var currentSelectedItem = selectedItems[selectedIndex];
            total = total + parseFloat(currentSelectedItem.innerHTML.replace(",", "."));
        }

        document.querySelector(".totalAmount").innerHTML = total.toFixed(2).replace(",", "").replace(".", ",");
    }); 
}

var clearButton = document.querySelector("#clearOrder");

if(clearButton != null){
    clearButton.addEventListener("click", function(event){
        var selectedItems = document.querySelectorAll(".itemSelectedTable .selected");
        
        for(var index = 0; index < selectedItems.length; index++){
            var selectedItem = selectedItems[index];

            selectedItem.classList.remove("selected");
            selectedItem.classList.add("hidden");
            selectedItem.querySelector("input").value = 0;
        }

        document.querySelector(".totalAmount").innerHTML = "0,00";
    });
} else {
    console.error("ERROR: No clear button found!")
}

var payOrderButton = document.querySelector("#payOrder");

if(payOrderButton != null){
    payOrderButton.addEventListener("click", function(event){
        // create order data string
        var orderData = new Array();    
        var selectedItemInputs = document.querySelectorAll(".itemSelectedTable .selected input");
        var modal = document.querySelector("#myModal");

        if(selectedItemInputs.length > 0){
            for(var index = 0; index < selectedItemInputs.length; index++){
                var selectedItemInput = selectedItemInputs[index];
                
                orderData.push({"id": selectedItemInput.name, "amount": selectedItemInput.value});
            }

            // stringify the orderData
            orderData = JSON.stringify(orderData);

            var http = new XMLHttpRequest();
            var url = 'payOrder.php';
            http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                    var response = JSON.parse(http.responseText);
                    
                    if(response.includes("Verkoop succesvol")){
                        modal.querySelector("p").innerHTML = "Verkoop succesvol!";
                    } else {
                        modal.querySelector("p").innerHTML = "Iets is verkeerd gegaan. Contacteer Peter.";
                    }

                    modal.style.display = "block";
                }
            }
            http.send("orderData="+orderData);

            var selectedItems = document.querySelectorAll(".itemSelectedTable .selected");
            
            for(var index = 0; index < selectedItems.length; index++){
                var selectedItem = selectedItems[index];

                selectedItem.classList.remove("selected");
                selectedItem.classList.add("hidden");
                selectedItem.querySelector("input").value = 0;
            }

            document.querySelector(".totalAmount").innerHTML = "0,00";
        } else {
            modal.querySelector("p").innerHTML = "Niets geselecteerd";
            modal.style.display = "block";
        }
    });
} else {
    console.error("ERROR: No payOrder button found!")
}

document.getElementsByClassName("close")[0].addEventListener("click", function(event){
    document.querySelector("#myModal").style.display = "none";
});

window.onclick = function(event){
    var modal = document.querySelector("#myModal");
    if(event.target == modal){
        modal.style.display = "none";
    }
}