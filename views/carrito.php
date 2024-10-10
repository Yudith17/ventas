<div class="container my-5" style="background-color: antiquewhite;">
          <style>
            .table img {
                max-width: 80px;
            }
            .input-group .form-control {
                text-align: center;
            }
            .card {
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            .btn-outline-secondary, .btn-danger {
                border-radius: 50%;
            }
            .btn-primary {
                width: 100%;
            }
            .btn-secondary {
                width: 100%;
            }
            .bank-thumbnail img {
                width: 80px;
                height: 80px;
                cursor: pointer;
                transition: transform 0.2s;
            }
            .bank-thumbnail img:hover {
                transform: scale(1.1);
            }
            
        </style>
          <h1>Carrito de Compras</h1>
      
          <div class="row">
            <div class="col-md-8">
              <table class="table" >
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="cart-items">
      
                </tbody>
              </table>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Resumen del Pedido</h5>
                  <p class="card-text">Subtotal: <span id="cart-subtotal">S/0.00</span></p>
                  <p class="card-text">Descuento: <span id="cart-discount">S/0.00</span></p>
                  <p class="card-text">Total: <span id="cart-total">S/0.00</span></p>
      
                  <div class="mb-3">
                    <label for="account-number" class="form-label">Ingresar número de cuenta:</label>
                    <input type="text" class="form-control" id="account-number" onchange="showBankInfo(this.value)">
                  </div>
      
                  <div id="bank-info" class="mb-3 d-none">
                    <h6>Banco Seleccionado:</h6>
                    <img id="bank-logo" src="" alt="Logo Banco" style="max-width: 100px;">
                    <p id="bank-name"></p>
                  </div>
      
                  <div class="mb-3">
                    <h6>Seleccionar Banco:</h6>
                    <div class="d-flex justify-content-between align-items-center">
                      <img src="https://www.visa.com.co/dam/VCOM/regional/lac/SPA/Default/Partner%20With%20Us/Info%20for%20Partners/Info%20for%20Small%20Business/visa-pos-800x400.jpg" alt="Banco A" class="img-thumbnail" style="cursor: pointer;  width: 100px; height: 100px;" onclick="selectBank('Banco VISA', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Visa_Logo.png/640px-Visa_Logo.png')">
                      <img src="https://www.mercadonegro.pe/wp-content/uploads/2020/09/imagen-bcp.jpg" alt="Banco B" class="img-thumbnail" style="cursor: pointer;  width: 100px; height: 100px;" onclick="selectBank('Banco BCP', 'https://seeklogo.com/images/B/bcp-logo-87BA4231DF-seeklogo.com.png')">
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyQQJAsQ_pJ53VO2oZIQJrX9CjdPTam77IGw&s" alt="Banco C" class="img-thumbnail" style="cursor: pointer; width: 100px; height: 100px;" onclick="selectBank('YAPE', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyQQJAsQ_pJ53VO2oZIQJrX9CjdPTam77IGw&s')">
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsBLWz7noWqXK7MsVEyXylmZ9hEmZQUeducQ&s" alt="Banco D" class="img-thumbnail" style="cursor: pointer; width: 100px; height: 100px;" onclick="selectBank('PAY PAL', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsBLWz7noWqXK7MsVEyXylmZ9hEmZQUeducQ&s')">
                    </div>
                  </div>
                  <a href="pagar.html" class="btn btn-primary">PAGAR AHORA </a> <br> <br>
                  <a href="index.html" class="btn btn-secondary">ELEGIR OTRO PRODUCTO</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        <script>
      
          const cartItems = [
            { name: 'Abrigos niña', price: 90.00, quantity: 1, image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6XRy2Pi9Zi1sAnmJC7Kf7WwOoFM9i3HCFVQ&s' },
            { name: 'Vestido mujer', price: 120.00, quantity: 2, image: 'https://image.made-in-china.com/318f0j00OQaUfRIyvikb/9741-1-mp4.webp' },
            { name: 'conjunto elegante', price: 150.00, quantity: 1, image: 'https://img.ltwebstatic.com/images3_pi/2023/08/03/02/1691054999c27989853607ebb48a0d18186a2aceff_thumbnail_720x.jpg' }
          ];
      
          function updateCart() {
            const cartItemsElement = document.getElementById('cart-items');
            let subtotal = 0;
      
            cartItemsElement.innerHTML = '';
            cartItems.forEach((item, index) => {
              const total = item.price * item.quantity;
              subtotal += total;
      
              const row = document.createElement('tr');
              row.innerHTML = `
                <td>${item.name}</td>
                <td><img src="${item.image}" alt="${item.name}" class="img-fluid" style="max-width: 100px;"></td>
                <td>S/${item.price.toFixed(2)}</td>
                <td>
                  <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${index}, -1)">-</button>
                    <input type="number" class="form-control" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value - ${item.quantity})">
                    <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${index}, 1)">+</button>
                  </div>
                </td>
                <td>S/${total.toFixed(2)}</td>
                <td><button class="btn btn-danger" onclick="removeFromCart(${index})">Eliminar</button></td>
              `;
              cartItemsElement.appendChild(row);
            });
      
            document.getElementById('cart-subtotal').textContent = ` S/${subtotal.toFixed(2)}`;
            document.getElementById('cart-discount').textContent = 'S/0.00';
            document.getElementById('cart-total').textContent =  ` S/${subtotal.toFixed(2)}`;
          }
      
          function updateQuantity(index, change) {
            cartItems[index].quantity += change;
            if (cartItems[index].quantity < 1) {
              cartItems[index].quantity = 1;
            }
            updateCart();
          }
      
          function removeFromCart(index) {
            cartItems.splice(index, 1);
            updateCart();
          }
      
          function selectBank(bankName, bankLogoSrc) {
            const bankInfoElement = document.getElementById('bank-info');
            const bankLogoElement = document.getElementById('bank-logo');
            const bankNameElement = document.getElementById('bank-name');
      
            bankLogoElement.src = bankLogoSrc;
            bankLogoElement.alt = ` Logo ${bankName}`;
            bankNameElement.textContent = bankName;
      
            bankInfoElement.classList.remove('d-none');
          }
      
          updateCart();
        </script>
        <div id="footer" class="col-12" style="background: rgb(252, 252, 252); height: 100px;">
          <div class="container-fluid">
            <div class="row bg-dark text-white py-3">
              <div class="col-4">
                <h5>Atención al cliente</h5>
                <ul class="list-unstyled">
                  <li>Atención al cliente</li>
                </ul>
              </div>
              <div class="col-4">
                <h5>Guía de compra</h5>
                <ul class="list-unstyled">
                  <li>Crear una cuenta</li>
                  <li>Pago</li>
                  <li>Envío</li>
                  <li>Protección del comprador</li>
                </ul>
              </div>
              <div class="col-4">
                <h5>Colabora con nosotros</h5>
                <ul class="list-unstyled">
                  <li>Nosotros</li>
                  <li>Centro de dropshipping</li>
                  <li>Iniciar sesión como vendedor</li>
                </ul>
              </div>
            </div>
            <div class="row bg-light py-3">
              <div class="col-6">
                <h5>Pagar con</h5>
                <div class="d-flex justify-content-start">
                  <a href="https://www.visa.com.pe/"><img src="https://www.visa.com.co/dam/VCOM/regional/lac/SPA/Default/Partner%20With%20Us/Info%20for%20Partners/Info%20for%20Small%20Business/visa-pos-800x400.jpg" alt="Visa" class="mx-2"
                      style="width: 80px;"></a>
                  <a href="https://www.viabcp.com/"><img src="https://www.mercadonegro.pe/wp-content/uploads/2020/09/imagen-bcp.jpg" alt="Mastercard" class="mx-2"
                      style="width: 80px;"></a>
                  <a href="https://www.yape.com.pe/"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyQQJAsQ_pJ53VO2oZIQJrX9CjdPTam77IGw&s" alt="yape" class="mx-2"
                      style="width: 80px;"></a>
                  <a href="https://www.paypal.com/"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsBLWz7noWqXK7MsVEyXylmZ9hEmZQUeducQ&s" alt="pay pal" class="mx-2"
                      style="width: 80px;"></a>
                </div>
              </div>
              <div class="col-6">
                <h5>No te olvides de seguirnos en:</h5>
                <div class="d-flex justify-content-end">
                  <a href="https://es-la.facebook.com/" class="text-dark mx-2">
                    <img src="https://img.freepik.com/vector-premium/icono-facebook-vector-3d-redes-sociales_721791-1528.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1720742400&semt=ais_user" alt="Facebook" class="mx-2"
                    style="width: 80px;">
                  </a>
                  <a href="https://x.com/?lang=es" class="text-dark mx-2">
                    <img src="https://www.brandemia.org/wp-content/uploads/2012/06/twitter_logo_principal.jpg" alt="Twitter" class="mx-2" style="width: 80px;">
                  </a>
                  <a href="https://www.instagram.com/" class="text-dark mx-2">
                    <img src="https://w7.pngwing.com/pngs/750/461/png-transparent-instagram-application-logo-logo-computer-icons-instagram-miscellaneous-text-trademark.png" alt="Instagram" class="mx-2"
                    style="width: 60px;">
        
                  <a href="https://www.whatsapp.com/" class="text-dark mx-2">
                    <img src="https://cdn.pixabay.com/photo/2015/08/03/13/58/whatsapp-873316_640.png" alt="WhatsApp" class="mx-2" style="width: 60px;">
                  </a>
                </div>
                
              </div>
            </div>
          </div>
        </div>