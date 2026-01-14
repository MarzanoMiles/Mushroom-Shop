// Function to open the floating window
function openFloatingWindow(className) {
    var floatingWindow = document.getElementById('floating-window');
    var xhr = new XMLHttpRequest();

    // Define the callback function for when the request is complete
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request was successful, inject the response HTML into the floating window container
                floatingWindow.innerHTML = xhr.responseText;
                floatingWindow.style.display = 'block';
            } else {
                // Request failed, log the error
                console.error('Failed to fetch content:', xhr.status);
            }
        }
    };

    // Open the request to fetch the content HTML file
    xhr.open('GET', className + '.html');
    xhr.send(); // Send the request
}

// Function to close the floating window
function closeFloatingWindow() {
    var floatingWindow = document.getElementById('floating-window');
    floatingWindow.style.display = 'none';
}

function updatePrice() {
    // Get the quantity input element
    var quantityInput = document.getElementById('quantity');
    
    // Get the total price span element
    var totalPriceSpan = document.getElementById('price');
    
    // Get the price per item from data attribute
    var pricePerItem = parseFloat(totalPriceSpan.getAttribute('data-price'));
    
    // Calculate the total price based on the quantity entered
    var quantity = parseInt(quantityInput.value);
    
    // Check if the input value is empty or not a number
    if (isNaN(quantity)) {
        // If input is empty or not a number, set total price to 0
        var totalPrice = 0;
    } else {
        // Otherwise, perform the calculation
        var totalPrice = quantity * pricePerItem;
    }
    
    // Update the total price displayed
    totalPriceSpan.textContent = '₱' + totalPrice.toFixed(2); // Format the total price as currency
}
///////
function sendData(button) {
    var productName = button.getAttribute("productname");
    var quantity = document.getElementById("quantity").value;
    var priceElement = document.getElementById("price");
    var price = priceElement.getAttribute("data-price");
    var totalText = priceElement.innerText;
    var total = parseFloat(totalText.replace(/[^\d.]/g, ''));
    var fullName = document.getElementById("fullname").innerText;
    var address = document.getElementById("address").innerText;
    var phoneNumber = document.getElementById("phonenumber").innerText;
    
    if (!fullName || !address || !phoneNumber) {
        return;
    }

    var xhr = new XMLHttpRequest();
    var url = "send.php";
    var params = "productname=" + encodeURIComponent(productName) +
                 "&quantity=" + encodeURIComponent(quantity) +
                 "&price=" + encodeURIComponent(price) +
                 "&total=" + encodeURIComponent(total) +
                 "&fullname=" + encodeURIComponent(fullName) +
                 "&address=" + encodeURIComponent(address) +
                 "&phonenumber=" + encodeURIComponent(phoneNumber);

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send(params);

    // Redirect to retrieve_data.php with GET parameters
    window.location.href = "retrieve_data.php?fullname=" + encodeURIComponent(fullName) +
                          "&address=" + encodeURIComponent(address) +
                          "&phonenumber=" + encodeURIComponent(phoneNumber);
}

function addComment() {
    var fullname = document.getElementById("fullname").innerHTML; // Get fullname from the element with id "fullname"
    var comment = document.getElementById("comment").value;
    var rating = document.getElementById("rating").value;

    if (fullname && comment) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "pcomments.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Clear input fields after successful submission
                document.getElementById("comment").value = "";
                document.getElementById("rating").value = "1";
                // Display any message returned from the PHP file (optional)
                alert(xhr.responseText);
                 window.location.reload();
            }
        };
        xhr.send("name=" + encodeURIComponent(fullname) + "&comment=" + encodeURIComponent(comment) + "&rating=" + encodeURIComponent(rating));
    } else if (!fullname) {
        alert("Please log in first!");
    } else {
        alert("Please enter your comment!");
    }
}

/////
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("retrieveLink").addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default link behavior

        // Get the values from the page
        var fullname = document.getElementById('fullname').innerText;
        var address = document.getElementById('address').innerText;
        var phonenumber = document.getElementById('phonenumber').innerText;

        // Construct the URL with query parameters
        var url = 'retrieve_data.php?fullname=' + encodeURIComponent(fullname) + '&address=' + encodeURIComponent(address) + '&phonenumber=' + encodeURIComponent(phonenumber);

        // Open a new window/tab with the filtered data
        var newWindow = window.open(url, '_blank');
        newWindow.focus();
    });
});
////////
function cancelOrder(fullname, phonenumber, productname, total) {
    // Display a message to indicate the cancellation process has started
    var messageElement = document.getElementById("cancelMessage");
    messageElement.innerText = "Please wait for seller response for your cancel...";

    // Send an AJAX request to your PHP script to insert data into the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cancel_order.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request successful, you can do something here if needed
                console.log("Order cancellation sent successfully!");
                // Update message to indicate success
                messageElement.innerText = "Order cancellation sent successfully!";
            } else {
                // Request failed
                console.error("Failed to cancel order.");
                // Update message to indicate failure
                messageElement.innerText = "Failed to cancel order. Please try again later.";
            }
        }
    };
    // Send the data as URL encoded form data
    xhr.send("fullname=" + encodeURIComponent(fullname) + "&phonenumber=" + encodeURIComponent(phonenumber) + "&productname=" + encodeURIComponent(productname) + "&total=" + encodeURIComponent(total));
}
//////


  
// Add event listeners to the links with class "card"
document.querySelectorAll('.card').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action of the link
        openFloatingWindow(this.getAttribute('data-content'));
    });

    function cancelOrder(fullname, phonenumber, productname, total) {
    

        setTimeout(() => {
           
            document.getElementById('cancelMessage').innerHTML = "<div class='success-message'>Your order for " + productname + " has been successfully cancelled.</div>";
    
           
            document.getElementById('homeButtonContainer').style.display = "block";
        }, 1500);
    }
    
    function goHome() {
       
        window.location.href = "index.html";  
    }
});

autoRefresh();