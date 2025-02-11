<?php
/**
 * Plugin Name: HookahMasters WhatsApp Reservation
 * Description: Adds WhatsApp reservation and catering forms on specific pages.
 * Version: 1.0
 * Author: Daniel Diaz Tag Marketing Digital
 */

// Evitar el acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Función para agregar el botón y el formulario en la página "at-home"
function hookahmasters_add_whatsapp_button_and_form() {
    if (is_page('at-home')) {
        echo '<div id="whatsapp-button" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
                <button onclick="openForm()" class="whatsapp-reserve-btn">
                    Reserva tu experiencia at home
                </button>
              </div>';
        ?>
        <div id="whatsapp-form" style="display: none; position: fixed; bottom: 20px; right: 20px; background-color: #090909; padding: 20px; border: 1px solid #ddd; border-radius: 5px; z-index: 10000;">
            <h5 onclick="closeForm()" style="background: none; border: none; font-size: 35px; color: white; cursor: pointer; position:absolute; top:5px; right: 25px;">&times;</h5>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; margin-top: 25px;">
                <h4 style="color: white; flex-grow: 1;">Reserva tu experiencia</h4>
            </div>
            <label for="days" style="color: white;">Días:</label>
            <select id="days" style="width: 100%; padding: 5px; margin-bottom: 10px;" onchange="updateMaxFlavors()">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="más">Más de 3</option>
            </select>
            <br>
            <label for="services" style="color: white;">Servicios:</label>
            <select id="services" style="width: 100%; padding: 5px; margin-bottom: 10px;" onchange="updateMaxFlavors()">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="más">Más de 4</option>
            </select>
            <br>
            <label style="color: white;">Sabores:</label>
            <div id="flavor" style="width: 100%; padding: 5px; margin-bottom: 10px; color: white;">
                <label><input type="checkbox" value="Sandía Menta" class="flavor-option"> Sandía Menta</label><br>
                <label><input type="checkbox" value="Frutos Exóticos" class="flavor-option"> Frutos Exóticos</label><br>
                <label><input type="checkbox" value="Mora Azul Menta" class="flavor-option"> Mora Azul Menta</label><br>
                <label><input type="checkbox" value="Mojito Manzana" class="flavor-option"> Mojito Manzana</label><br>
                <label><input type="checkbox" value="Sabor de temporada" class="flavor-option"> Sabor de temporada</label><br>
            </div>
            <br>
            <button onclick="sendWhatsAppMessage()" class="whatsapp-reserve-btn" style="width: 100%; margin-top: 10px; background-color: #25d366; border: 1px solid white;">
                Reservar
            </button>
        </div>
        <script>
            function openForm() {
                document.getElementById('whatsapp-form').style.display = 'block';
            }

            function closeForm() {
                document.getElementById('whatsapp-form').style.display = 'none';
            }

            function updateMaxFlavors() {
                var services = parseInt(document.getElementById('services').value);
                var checkboxes = document.querySelectorAll('.flavor-option');
                var checkedCount = document.querySelectorAll('.flavor-option:checked').length;
                
                checkboxes.forEach(checkbox => {
                    checkbox.disabled = checkedCount >= services && !checkbox.checked;
                });
            }
            
            document.querySelectorAll('.flavor-option').forEach(checkbox => {
                checkbox.addEventListener('change', updateMaxFlavors);
            });
            
            function sendWhatsAppMessage() {
                var days = document.getElementById('days').value;
                var services = document.getElementById('services').value;
                var flavors = Array.from(document.querySelectorAll('.flavor-option:checked')).map(option => option.value).join(', ');
                var message = "Hola quiero reservar mi experiencia AT HOME con " + days + " días, " + services + " servicios y con los sabores: " + flavors;
                var whatsappURL = "https://wa.me/573004780448?text=" + encodeURIComponent(message);
                window.open(whatsappURL);
            }
        </script>
        <?php
    }
}
add_action('wp_footer', 'hookahmasters_add_whatsapp_button_and_form');

// Función para agregar el botón y el formulario en la página "catering"
function hookahmasters_add_catering_form() {
    if (is_page('catering')) {
        echo '<div id="catering-button" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
                <button onclick="openCateringForm()" class="whatsapp-catering-btn">
                    Cotiza tu Experiencia
                </button>
              </div>';
        ?>
        <div id="catering-form" style="display: none; max-width: 350px; position: fixed; bottom: 20px; right: 20px; background-color: #090909; padding: 20px; border: 1px solid #ddd; border-radius: 5px; z-index: 10000;">
            <h5 onclick="closeCateringForm()" style="background: none; border: none; font-size: 35px; color: white; cursor: pointer; position:absolute; top:5px; right: 25px;">&times;</h5>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; margin-top: 25px;">
                <h4 style="color: white; flex-grow: 1; text-align: center;">Cotiza</h4>
            </div>
            <label for="people" style="color: white;">Cuántas personas estarán en tu evento:</label>
            <input type="number" id="people" style="width: 100%; padding: 5px; margin-bottom: 10px;" min="1" required>
            <br>
            <label for="hookahs" style="color: white;">Cuántas hookahs te gustarían tener en tu evento:</label>
            <input type="number" id="hookahs" style="width: 100%; padding: 5px; margin-bottom: 10px;" min="1" required>
            <br>
            <label for="services" style="color: white;">Cantidad de servicios:</label>
            <input type="number" id="services-catering" style="width: 100%; padding: 5px; margin-bottom: 10px;" min="1" required>
            <br>
            <label for="neighborhood" style="color: white;">Barrio:</label>
            <input type="text" id="neighborhood" style="width: 100%; padding: 5px; margin-bottom: 10px;" maxlength="20">
            <br>
            <button onclick="sendCateringMessage()" class="whatsapp-catering-btn" style="width: 100%; margin-top: 10px; background-color: #25d366; border: 1px solid white;">
                Cotizar
            </button>
        </div>
        <script>
            function openCateringForm() {
                document.getElementById('catering-form').style.display = 'block';
            }

            function closeCateringForm() {
                document.getElementById('catering-form').style.display = 'none';
            }

            function sendCateringMessage() {
                var people = document.getElementById('people').value;
                var hookahs = document.getElementById('hookahs').value;
                var services = document.getElementById('services-catering').value;
                var neighborhood = document.getElementById('neighborhood').value;
                
                if (!people || !hookahs || !services) {
                    alert("Por favor, completa todos los campos obligatorios.");
                    return;
                }

                var message = "Hola, quiero cotizar mi evento con " + people + " personas, " + hookahs + " hookahs, " + services + " servicios";
                if (neighborhood) {
                    message += ", en el barrio " + neighborhood;
                }
                
                var whatsappURL = "https://wa.me/573004780448?text=" + encodeURIComponent(message);
                window.open(whatsappURL);
            }
        </script>
        <?php
    }
}
add_action('wp_footer', 'hookahmasters_add_catering_form');

// Agregar los estilos personalizados
function hookahmasters_add_styles() {
    if (is_page('at-home') || is_page('catering')) {
        ?>
        <style>
            .wayra-coc-floating-style2 {
                display: none !important;
            }
            .whatsapp-reserve-btn, .whatsapp-catering-btn {
                background-color: #25d366;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .whatsapp-reserve-btn:hover, .whatsapp-catering-btn:hover {
                background-color: #25d366;
            }
            #whatsapp-form select, #catering-form input {
                background-color: #333;
                color: white;
                border: 1px solid #555;
            }
            #whatsapp-form button, #catering-form button {
                background-color: #25d366;
                border: 1px solid white;
                color: white;
                width: 100%;
            }
            #whatsapp-form h4, #catering-form h4 {
                flex-grow: 1;
                margin-right: 10px;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'hookahmasters_add_styles');
