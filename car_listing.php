<?php
$title = "Cars for You";
include 'header.php';
include 'db_connection.php';
?>

<main>
  <body>
    
    <section class="car-listings-hero">
      <h1>Find Your Dream Car</h1>
      <p>Explore our collection of high-quality second-hand cars.</p>
    </section>

    
    <section class="car-filters">
      <h2>Filter Cars by Price</h2>
      <form id="filterForm">
        <label for="min_price">Min Price (€):</label>
        <input type="number" name="min_price" id="min_price" placeholder="Min price">

        <label for="max_price">Max Price (€):</label>
        <input type="number" name="max_price" id="max_price" placeholder="Max price">

        <button type="submit">Apply Filters</button>
      </form>
    </section>

    <!-- Car Listings Table -->
    <section class="car-listings">
      <h2>Available Cars</h2>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Model</th>
            <th>Price</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody id="carTableBody">
         
        </tbody>
      </table>
    </section>

    <script>
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let minPrice = document.getElementById('min_price').value;
        let maxPrice = document.getElementById('max_price').value;

        fetch('fetch_cars.php?min_price=' + minPrice + '&max_price=' + maxPrice)
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('carTableBody');
            tableBody.innerHTML = ""; 
            if (data.length === 0) {
                tableBody.innerHTML = "<tr><td colspan='4'>No cars found in this price range.</td></tr>";
            } else {
                data.forEach(car => {
                    let row = `<tr>
                        <td>${car.name}</td>
                        <td>${car.model}</td>
                        <td>${car.price}€</td>
                        <td>${car.description}</td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
    });
    </script>
  </body>
</main>

<?php
include 'footer.php';
?>
