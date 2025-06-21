document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("salesForm");
    const tbody = document.getElementById("salesTableBody");

    const formatCurrency = value =>
        "€ " + value.toFixed(2).replace(".", ",");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const beginDate = form.beginDate.value;
        const endDate = form.endDate.value;

        fetch("/sales/data", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ beginDate, endDate })
        })
        .then(res => res.json())
        .then(data => {
            tbody.innerHTML = "";
            let total = 0;

            if (Array.isArray(data)) {
                data.forEach(row => {
                    const tr = document.createElement("tr");

                    const date = new Date(row.sale_date);
                    tr.innerHTML = `
                        <td>${date.toLocaleDateString("nl-NL")}</td>
                        <td>${row.dish_name}</td>
                        <td>${formatCurrency(parseFloat(row.price))}</td>
                        <td>${row.quantity}</td>
                        <td>${formatCurrency(parseFloat(row.subtotal))}</td>
                    `;
                    tbody.appendChild(tr);
                    total += parseFloat(row.subtotal);
                });

                const totalExVat = (total / 1.21); // BTW 21% in Nederland
                document.getElementById("total").innerText = formatCurrency(total);
                document.getElementById("exVat").innerText = formatCurrency(totalExVat);
                document.getElementById("vat").innerText = formatCurrency(total - totalExVat);
            }
        })
        .catch(err => {
            alert("Fout bij het ophalen van de gegevens.");
            console.error(err);
        });
    });
});
