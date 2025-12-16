# 🟢 HookahMasters WhatsApp Reservation

**Sistema de reservas y cotizaciones flotantes integrado con WhatsApp.**

Este plugin añade formularios emergentes (Pop-ups) de reserva personalizados que se activan exclusivamente en páginas específicas del sitio web (`at-home` y `catering`). Facilita la captación de clientes permitiendo configurar los detalles de su experiencia (días, servicios, sabores) y enviando toda la información formateada directamente al chat de WhatsApp de la empresa.

## 📋 Características Principales

### 🏠 Experiencia "At Home"
* **Despliegue Condicional:** El botón de reserva solo aparece si el usuario visita la página con slug `at-home`.
* **Lógica de Validación (JS):** Incluye un script inteligente que limita el número de casillas de verificación (Checkboxes) de "Sabores" que el usuario puede seleccionar, basándose en la cantidad de "Servicios" que eligió previamente.
* **Catálogo de Sabores:** Selección predefinida que incluye opciones como Sandía Menta, Frutos Exóticos, Mora Azul, entre otros.

### 🥂 Experiencia "Catering" (Eventos)
* **Formulario de Cotización:** Se activa exclusivamente en la página `catering`.
* **Campos Personalizados:** Solicita información clave para eventos: número de personas, cantidad de hookahs, servicios requeridos y barrio de ubicación.
* **Validación de Campos:** Impide el envío si faltan datos obligatorios antes de abrir WhatsApp.

### 🎨 Estilos y Comportamiento
* **Diseño Oscuro (Dark Mode):** Formularios estilizados con fondo negro (`#090909`) y textos blancos para coincidir con la identidad visual de la marca.
* **Gestión de Conflictos:** Oculta automáticamente otros botones flotantes (clase `.wayra-coc-floating-style2`) cuando este plugin está activo para evitar superposiciones visuales.

## ⚙️ Configuración (Hardcoded)

Este plugin no tiene panel de administración; toda la configuración es interna.

### 1. Cambiar el Número de WhatsApp
El número está definido directamente en las funciones JavaScript de cada formulario.
* Busca la cadena `https://wa.me/573004780448` dentro del código y reemplaza el número por el deseado.

### 2. Definir las Páginas Activas
El plugin usa la función condicional `is_page()` de WordPress.
* Para cambiar dónde aparecen los botones, modifica las líneas:
    ```php
    if (is_page('at-home')) { ... }
    // y
    if (is_page('catering')) { ... }
    ```

## 📂 Estructura del Plugin

* `hookahmasters-whatsapp-reservation.php`: Archivo único que contiene:
    * Hooks de `wp_footer` para inyectar el HTML/JS de los formularios.
    * Hooks de `wp_head` para los estilos CSS.
    * Lógica de validación de JavaScript (`updateMaxFlavors`).

## 🚀 Instalación

1.  Sube el archivo `hookahmasters-whatsapp-reservation.php` a la carpeta `/wp-content/plugins/`.
2.  Activa el plugin desde el panel de WordPress.
3.  Asegúrate de tener creadas las páginas con los slugs `at-home` y `catering` (o edita el código para usar tus propios slugs).

## 💻 Shortcode

*Este plugin inyecta su contenido automáticamente basado en la página detectada y no requiere el uso de shortcodes manuales.*

---
**Versión:** 1.0
**Autor:** Daniel Diaz - Tag Marketing Digital
**Tecnología:** PHP, JavaScript (Vanilla), WhatsApp API Link.
