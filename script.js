let cart = [];
let products = [];

function showCatalog() {
    document.getElementById('catalog-section').style.display = 'block';
    document.getElementById('cart-section').style.display = 'none';
    document.getElementById('catalog-link').classList.add('active');
    document.getElementById('cart-link').classList.remove('active');
}

function showCart() {
    document.getElementById('catalog-section').style.display = 'none';
    document.getElementById('cart-section').style.display = 'block';
    document.getElementById('cart-link').classList.add('active');
    document.getElementById('catalog-link').classList.remove('active');
    renderCart();
}

async function loadProducts() {
    try {
        const response = await fetch('/bike-shop/backend/api/products.php');
        const data = await response.json();
        products = data.data;
        renderProducts();
    } catch (error) {
        document.getElementById('products-grid').innerHTML = '<div class="loading">Ошибка загрузки</div>';
    }
}

function renderProducts() {
    const container = document.getElementById('products-grid');
    container.innerHTML = '';
    products.forEach(product => {
        container.innerHTML += `
            <div class="product-card"  data-category="${product.category}"> ${product.image ? `<img src="${product.image}" alt="${product.name}" class="product-image">` : ''}
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <p class="price">${product.price.toLocaleString()} ₽</p>
                <button onclick="addToCart(${product.id})">В корзину</button>
            </div>
        `;
    });
}

function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;
    const existing = cart.find(item => item.id === productId);
    if (existing) existing.quantity++;
    else cart.push({ id: product.id, name: product.name, price: product.price, quantity: 1 });
    saveCart();
    updateCartCount();
}

function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cart-count').textContent = count;
}

function renderCart() {
    const container = document.getElementById('cart-items');
    if (cart.length === 0) {
        container.innerHTML = '<div style="text-align:center;padding:40px;">Корзина пуста</div>';
        document.getElementById('cart-total').textContent = '0';
        return;
    }
    let total = 0;
    container.innerHTML = '';
    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        container.innerHTML += `
            <div class="cart-item">
                <span>${item.name}</span>
                <span>${item.price.toLocaleString()} ₽</span>
                <div class="cart-item-controls">
                    <button onclick="changeQuantity(${item.id}, -1)">-</button>
                    <span>${item.quantity}</span>
                    <button onclick="changeQuantity(${item.id}, 1)">+</button>
                    <button class="remove-item" onclick="removeFromCart(${item.id})">Удалить</button>
                </div>
                <span>${itemTotal.toLocaleString()} ₽</span>
            </div>
        `;
    });
    document.getElementById('cart-total').textContent = total.toLocaleString();
}

function changeQuantity(id, delta) {
    const item = cart.find(i => i.id === id);
    if (item) {
        const newQty = item.quantity + delta;
        if (newQty <= 0) removeFromCart(id);
        else { item.quantity = newQty; saveCart(); renderCart(); updateCartCount(); }
    }
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    saveCart();
    renderCart();
    updateCartCount();
}

function saveCart() { localStorage.setItem('bike_cart', JSON.stringify(cart)); }
function loadCart() { const saved = localStorage.getItem('bike_cart'); if (saved) cart = JSON.parse(saved); updateCartCount(); }
function clearCart() { cart = []; saveCart(); renderCart(); updateCartCount(); }
function checkout() {
    if (cart.length === 0) alert('Корзина пуста!');
    else { alert(`Спасибо за заказ!\nСумма: ${cart.reduce((s, i) => s + i.price * i.quantity, 0).toLocaleString()} ₽`); clearCart(); showCatalog(); }
}
function filterProducts() {
    const category = document.getElementById('category-filter').value;
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        const productId = parseInt(card.querySelector('button').getAttribute('onclick').match(/\d+/)[0]);
        const product = products.find(p => p.id === productId);
        
        if (category === 'all' || product.category === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
document.getElementById('cart-link').addEventListener('click', (e) => { e.preventDefault(); showCart(); });
document.getElementById('catalog-link').addEventListener('click', (e) => { e.preventDefault(); showCatalog(); });
document.getElementById('checkout-btn').addEventListener('click', checkout);
document.getElementById('category-filter').addEventListener('change', filterProducts);

loadProducts();
loadCart();
updateCartCount();
