var datesSelectedButton = document.querySelector("#datesSelectedBtn");

if(datesSelectedButton != null){
    datesSelectedButton.addEventListener("click", function(event){
        // get dates
        var beginDate = document.querySelector("#begindate").value;
        var endDate = document.querySelector("#enddate").value;
        var displayModal = false;        
        var modal = document.querySelector("#myModal");

        var overviewData = {
            "beginDate": beginDate,
            "endDate": endDate
        };

        // stringify the orderData
        overviewData = JSON.stringify(overviewData);

        var http = new XMLHttpRequest();
        var url = 'salesOverview.php';
        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                var response = JSON.parse(http.responseText);

                // clear current table
                var tb = document.querySelector("#salesResult tbody");

                while (tb.childNodes.length) {
                    tb.removeChild(tb.childNodes[0]);
                }

                document.querySelector("span#total").innerHTML = "0,00";
                document.querySelector("span#totalexvat").innerHTML = "0,00";
                document.querySelector("span#vat").innerHTML = "0,00";


                if(Array.isArray(response)){
                    var total = 0;

                    if(response.length > 0){
                        // Put results in table
                        for(var index=0; index < response.length; index++){
                            var currentSale = response[index];
                            var row = document.createElement('tr');

                            var dateTd = document.createElement('td');
                            var saleDate = new Date(currentSale["saleDate"]);
                            dateTd.innerHTML = saleDate.getDate() + "-" + (saleDate.getMonth()+1) + "-" + saleDate.getFullYear();
                            row.appendChild(dateTd);

                            var nameTd = document.createElement('td');
                            nameTd.innerHTML = currentSale["naam"];
                            row.appendChild(nameTd);

                            var priceTd = document.createElement('td');
                            priceTd.innerHTML = "€ " + parseFloat(currentSale["price"]).toFixed(2).replace(",", "").replace(".", ",");
                            row.appendChild(priceTd);

                            var amountTd = document.createElement('td');
                            amountTd.innerHTML = currentSale["amount"];
                            row.appendChild(amountTd);

                            var subTotalTd = document.createElement('td');
                            var subTotal = (parseFloat(currentSale["amount"])*parseFloat(currentSale["price"]));
                            total = total + subTotal;
                            subTotalTd.innerHTML = "€ " + subTotal.toFixed(2).replace(",", "").replace(".", ",");
                            row.appendChild(subTotalTd);

                            document.querySelector("#salesResult tbody").appendChild(row);
                        }

                        document.querySelector("span#total").innerHTML = total.toFixed(2).replace(",", "").replace(".", ",");
                        var totalExVat = ((total/106)*100);
                        document.querySelector("span#totalexvat").innerHTML = totalExVat.toFixed(2).replace(",", "").replace(".", ",");
                        document.querySelector("span#vat").innerHTML = (total - totalExVat).toFixed(2).replace(",", "").replace(".", ",");

                    } else {
                        modal.querySelector("p").innerHTML = "Geen verkoop op de aangegeven datum";
                        displayModal = true;
                    }
                } else {
                    if(!response.includes("Overview succesfully generated")){
                        modal.querySelector("p").innerHTML = response;
                        displayModal = true;
                    }    
                }

                if(displayModal){
                    modal.style.display = "block";
                }
            }
        };

        http.send("overviewData="+overviewData);
    });
} else {
    console.error("ERROR: No dates selected button found!")
}