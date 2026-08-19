<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
<nav class="navbar">
    <div class="navbar__container">
        <a href="/">
            <img 
                src="{{ asset('Images/Logos/Avanti_logo_1.png') }}" 
                alt="Avanti Logo" 
                id="navbar__logo" 
                height="75%" 
                width="105%"
            >
        </a>
        <div class="navbar__toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>  
        <ul class="navbar__menu">
        @auth
                @if(Auth::user()->role === 'owner')
                    {{-- Owner-specific navbar items --}}
                    <li class="navbar__item">
                        <a href="{{ route('owner.orders') }}" class="navbar__links" id="orders-page">
                            Orders
                            <span id="newOrdersCount" class="order-count">0</span>
                        </a>
                    </li>
                    <li class="navbar__item">
                        <a href="{{ route('owner.reservations') }}" class="navbar__links" id="reservations-page">
                            Reservations
                        </a>
                    </li>
                    <li class="navbar__item">
                        <a href="{{ route('specialties') }}" class="navbar__links" id="specialties">
                            Specialties
                        </a>
                    </li>
                    <li class="navbar__item">
                        <a href="{{ route('owner.addDish') }}" class="navbar__links">
                            Add Dish
                        </a>
                    </li>
                @else
                    {{-- User-specific navbar items --}}
                    <li class="navbar__item">
                        <a href="{{ route('about-us') }}" class="navbar__links" id="about-page">About Us</a>
                    </li>
                    <li class="navbar__item">
                        <a href="#footer-contact" class="navbar__links" id="contact-us">Contact Us</a>
                    </li>
                    <li class="navbar__item">
                        <a href="{{ route('specialties') }}" class="navbar__links" id="specialties">Specialties</a>
                    </li>
                    <li class="navbar__item">
                        <a href="{{ route('cart.index') }}" class="navbar__links">
                            My Cart 
                            <span id="cartCount" class="cart-count">
                                {{ Auth::user()->cartItems()->sum('quantity') }}
                            </span>
                        </a>
                    </li>
                @endif
            @endguest

            @guest
                <li class="navbar__item">
                    <a href="{{ route('about-us') }}" class="navbar__links" id="about-page">About Us</a>
                </li>
                <li class="navbar__item">
                    <a href="#footer-contact" class="navbar__links" id="contact-us">Contact Us</a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('specialties') }}" class="navbar__links" id="specialties">Specialties</a>
                </li>
            @endguest

            @guest
                <li class="navbar__btn">
                    <button type="button" onclick="handleBookNow()">Book Now</button>
                </li>
                <li class="navbar__btn">
                    <a href="{{ route('login') }}"><button type="button">Login</button></a>
                </li>
            @else
                <li class="navbar__btn">
                     <button type="button" onclick="openPopup()">Book Now</button>
                </li>
                <li class="navbar__item dropdown" id='user_item'>
                    <button onclick="toggleDropdown()" class="dropbtn">{{ Auth::user()->name }}</button>
                    <div id="userDropdown" class="dropdown-content">
                        @if(Auth::user()->role === 'owner')
                            <a href="{{ route('profile.edit') }}">Profile</a>
                          
                        @else
                            <a href="{{ route('reservations.index') }}">My Reservations</a>
                            <a href="{{ route('profile.edit') }}">Profile</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-logout">Logout</button>
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>


         <!--Book now popup-->
         <div id="popup"class="popup">
            <div class="popup-content">
              <span class="close" onclick="closePopup()" >&times;</span>
              <h2 class="popup_title">Book Now</h2>
              <form method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" 
            value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" 
            required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" required>

            <label for="phone">Phone number:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="guests">Number of Guests:</label>
            <input type="number" id="guests" name="guests" min="1" max="12" required>
            <span id="guest-warning" style="color:#BF9B30; display: none;">
            For more than 12 guests, please contact us via phone at 077 705 850 or via email in the Contact Us section.</span>

            <label for="datetime">Pick Date and Time:</label>
            <input type="datetime-local" id="datetime" name="datetime" required>

            <label for="duration">Reservation Duration (Hours):</label>
                <select id="duration" name="duration" required>
                    <option value="1">1 Hour</option>
                    <option value="2">2 Hours</option>
                    <option value="3">3 Hours</option>
                    <option value="4">4 Hours</option>
                </select>

            <label for="class">Pick desired class:</label>
            <select id="class" name="class" required>
                <option value="" selected disabled>Select Preferable class</option>
                <option value="budget">Budget $</option>
                <option value="second">Second class $$</option>
                <option value="first">First class $$$</option>
            </select>

            <input type="submit" value="Book Now" id="register_btn">
        </form>
    </div>
</div>




      
        
  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>  


const menu=document.querySelector('#mobile-menu')
const menuLinks=document.querySelector('.navbar__menu')



function updateOrdersCount() {
    fetch('/owner/new-orders-count')
        .then(response => response.json())
        .then(data => {
            const countElement = document.getElementById('newOrdersCount');
            if (countElement) {
                countElement.textContent = data.count;
                // Optional: Add visual indication if there are new orders
                if (data.count > 0) {
                    countElement.classList.add('has-new-orders');
                } else {
                    countElement.classList.remove('has-new-orders');
                }
            }
        });
}

// Update count every 30 seconds
if (document.getElementById('newOrdersCount')) {
    updateOrdersCount(); 
    setInterval(updateOrdersCount, 30000); 
}


document.addEventListener('DOMContentLoaded', function() {
    // clear count when page is oppened
    if (window.location.pathname.includes('/owner/orders')) {
        const countElement = document.getElementById('newOrdersCount');
        if (countElement) {
            countElement.textContent = '0';
        }
    }
});


//Display mobile menu
const mobileMenu=()=>{
    menu.classList.toggle('is-active')
    menuLinks.classList.toggle('active')
}

menu.addEventListener('click',mobileMenu);

//Book Now Scrypt
function openPopup() {
    document.getElementById("popup").style.display = "block";
  }
  
  function closePopup() {
    document.getElementById("popup").style.display = "none";
  }

  document.getElementById('guests').addEventListener('input', function() {
        var guests = parseInt(this.value);
        var warningMessage = document.getElementById('guest-warning');

        if (guests > 12) {
            warningMessage.style.display = 'inline';  
        } else {
            warningMessage.style.display = 'none';  
        }
    });

    //unauthorised reservation attempt
    function handleBookNow() {
    @auth
        // If user is authenticated open popup
        openPopup();
    @else
        //  else show login required
        Swal.fire({
            title: 'Login Required',
            text: 'Please log in to make a reservation',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    @endauth
}

  //dropdownScrypt
  
  function toggleDropdown() {
    document.getElementById("userDropdown").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
  }

  

  //addtocart

  function handleAddToCart(dishId) {
    @auth
        // Send AJAX request to add item to cart
        fetch(`/cart/add/${dishId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            // Show success notification
            Swal.fire({
                title: 'Success!',
                text: 'Item added to cart',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
            
            // Update cart count in navbar if it exists
            if (document.getElementById('cartCount')) {
                document.getElementById('cartCount').textContent = data.cartCount;
            }
        });
    @else
        // login required notification
        Swal.fire({
            title: 'Login Required',
            text: 'Please log in to add items to your cart',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    @endauth
}

//cart quantity  summary and checkout
function updateQuantity(itemId, change) {
    const itemElement = document.querySelector(`[data-item-id="${itemId}"]`);
    const quantitySpan = itemElement.querySelector('.quantity');
    let newQuantity = parseInt(quantitySpan.textContent) + change;
    
    if (newQuantity < 1) return;

    fetch(`/cart/${itemId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQuantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            quantitySpan.textContent = newQuantity;
            itemElement.querySelector('.cart-item-total').textContent = 
                '$' + data.total.toFixed(2);
            
            // Update cart count in navbar
            document.getElementById('cartCount').textContent = data.cartCount;
            
            // Update summary
            updateCartSummary();
        }
    });
}
function updateCartSummary() {
    const totals = Array.from(document.querySelectorAll('.cart-item-total'))
        .map(el => parseFloat(el.textContent.replace('$', '')));
    const subtotal = totals.reduce((a, b) => a + b, 0);
    const total = subtotal + 5; // Adding delivery fee

    document.querySelector('.summary-row:first-child span:last-child')
        .textContent = '$' + subtotal.toFixed(2);
    document.querySelector('.summary-row.total span:last-child')
        .textContent = '$' + total.toFixed(2);
}

function proceedToCheckout() {
    window.location.href = '{{ route("checkout") }}';
}



//owner deleting the dish
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this dish?')) {
       
        const token = document.querySelector('meta[name="csrf-token"]') 
            ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            : document.querySelector('input[name="_token"]')
            ? document.querySelector('input[name="_token"]').value
            : null;

        if (!token) {
            alert('CSRF token not found');
            return;
        }

        fetch(`/dishes/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Dish deleted successfully');
                location.reload();
            } else {
                alert(data.message || 'Failed to delete dish');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the dish');
        });
    }
}


//for order status owner
document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.status-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const action = this.action;

                fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
</body>
</html>