document.addEventListener("DOMContentLoaded", function() {
    let tableRows = document.querySelectorAll("#table tbody tr");

    //show the table with the appropriate colors following my criteria
    tableRows.forEach(function(row) {
        // Debug statements
        let priceCell = row.cells[1].innerText;
        console.log("Price cell content:", priceCell);
        // Debug statements
        let price = parseFloat(priceCell.replace(/[^0-9.-]+/g, ""));
        console.log("Parsed price:", price);

        if (!isNaN(price) && price < 10) {
            row.classList.add("bg-green-400");
        } else if (!isNaN(price) && price >= 10 && price < 30) {
            row.classList.add("bg-yellow-300");
        } else if (!isNaN(price) && price >= 30 && price < 50) {
            row.classList.add("bg-yellow-500");
        } else if (!isNaN(price) && price >= 50 && price < 90) {
            row.classList.add("bg-red-600");
        } else {
            row.classList.add("bg-red-700");
        }
    });
});

// determens if the sidebar is open or closed, and when the button is clicked it will toggle the sidebarz
function toggleSidebar() {
    const sidebar = document.getElementById('mySidebar');
    const isOpen = sidebar.classList.toggle('hidden');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    sidebarToggle.setAttribute('aria-expanded', isOpen);
}

function menu_close() {
    document.getElementById("mySidebar").classList.add('hidden');
}
