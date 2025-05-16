// Funciones generales
document.documentElement.classList.remove('no-js');
document.documentElement.classList.add('js');

let currentStep = 1;

function nextStep(next) {
    if (validateStep(currentStep)) {
        document.getElementById(`step${currentStep}`).classList.remove('active');
        currentStep = next;
        document.getElementById(`step${currentStep}`).classList.add('active');
        updateProgress(next);
        
        if (currentStep === 3) {
            updateResumen();
        }
    }
}

    //para STRIPE
    const stripe = Stripe('pk_test_51R0wImQMqw2f1gHOAjI5CQGWuvI3P930paJCqCHZvHF5l43PrfgJong9hfxBtNSG5SolMmVvkcMVCdJfYwIMJKQ100spIcLWhX');
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': { color: '#aab7c4' }
            }
        }
    });

    cardElement.mount('#card-element');

    document.getElementById('submit-payment').addEventListener('click', async (e) => {
        e.preventDefault();
        
        const {paymentMethod, error} = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            document.getElementById('payment_method_id').value = paymentMethod.id;
            document.getElementById('rform').submit();
        }
    });

// Función para calcular y actualizar el total en tiempo real
function actualizarTotal() {
    let total = 0;
    const personas = parseInt(document.getElementById('rparty-size').value) || 0;
    
    if(document.getElementById('desayuno').value) total += 9.00 * personas;
    if(document.getElementById('almuerzo_entrada').value) total += 14.50 * personas;
    if(document.getElementById('cena').value) total += 16.50 * personas;
    
    document.getElementById('totalResumen').textContent = total.toFixed(2);
}

// Actualizar en eventos relevantes
document.getElementById('rparty-size').addEventListener('input', actualizarTotal);
document.querySelectorAll('.seccion-menu select').forEach(select => {
    select.addEventListener('change', actualizarTotal);
});

function prevStep(prev) {
    document.getElementById(`step${currentStep}`).classList.remove('active');
    currentStep = prev;
    document.getElementById(`step${currentStep}`).classList.add('active');
    updateProgress(prev);
}

function validateStep(step) {
    if (step === 1) {
        // Validar Desayuno
        const desayuno = document.getElementById('desayuno').value;
        const pan = document.getElementById('pan_desayuno').value;
        
        if ((desayuno && !pan) || (!desayuno && pan)) {
            showModal("¡Debes completar todos los campos del Desayuno!");
            return false;
        }

        // Validar Almuerzo
        const almEntrada = document.getElementById('almuerzo_entrada').value;
        const almFondo = document.getElementById('almuerzo_fondo').value;
        const almPostre = document.getElementById('almuerzo_postre').value;
        const almBebida = document.getElementById('almuerzo_bebida').value;
        
        if ([almEntrada, almFondo, almPostre, almBebida].some(Boolean)) {
            if (!almEntrada || !almFondo || !almPostre || !almBebida) {
                showModal("¡Debes completar todos los campos del Almuerzo!");
                return false;
            }
        }

        // Validar Cena
        const cena = document.getElementById('cena').value;
        const cenaPostre = document.getElementById('cena_postre').value;
        const cenaBebida = document.getElementById('cena_bebida').value;
        
        if ([cena, cenaPostre, cenaBebida].some(Boolean)) {
            if (!cena || !cenaPostre || !cenaBebida) {
                showModal("¡Debes completar todos los campos de la Cena!");
                return false;
            }
        }
    }
    
    if (step === 2) {
        // Validar campos requeridos
        const requiredFields = ['rname', 'rphone', 'rdate', 'rtime', 'rparty-size'];
        for (const fieldId of requiredFields) {
            const field = document.getElementById(fieldId);
            if (!field.value.trim()) {
                showModal(`El campo ${field.labels[0].textContent} es requerido`);
                field.focus();
                return false;
            }
        }
        
        // Validar formato de teléfono
        const phone = document.getElementById('rphone').value;
        if (!/^9\d{8}$/.test(phone)) {
            showModal("El teléfono debe tener 9 dígitos y empezar con 9");
            return false;
        }
    }
    
    return true;
}

// Función para actualizar resumen
function updateResumen() {
    const resumenDiv = document.getElementById('resumenContenido');
    const menuItems = [];
    
    // Obtener selecciones de menú
    document.querySelectorAll('.seccion-menu select').forEach(select => {
        if (select.value) {
            const label = document.querySelector(`label[for="${select.id}"]`).textContent;
            menuItems.push(`${label}: ${select.options[select.selectedIndex].text}`);
        }
    });

    const datos = {
        nombre: document.getElementById('rname').value,
        telefono: document.getElementById('rphone').value,
        fecha: document.getElementById('rdate').value,
        hora: document.getElementById('rtime').value,
        personas: document.getElementById('rparty-size').value,
        informacion: document.getElementById('radd-info').value,
        menu: menuItems.join('<br>')
    };
    
    resumenDiv.innerHTML = `
        <h3>Resumen de la Reserva</h3>
        <p><strong>Nombre:</strong> ${datos.nombre}</p>
        <p><strong>Teléfono:</strong> ${datos.telefono}</p>
        <p><strong>Fecha:</strong> ${datos.fecha}</p>
        <p><strong>Hora:</strong> ${datos.hora}</p>
        <p><strong>Personas:</strong> ${datos.personas}</p>
        <p><strong>Información Adicional:</strong> ${datos.informacion || 'Ninguna'}</p>
        <h4>Menú Seleccionado:</h4>
        ${datos.menu || 'Ningún ítem seleccionado'}
    `;
}
// Función para cambiar pasos
function nextStep(next) {
    if (validateStep(currentStep)) {
        document.querySelectorAll('.form-step').forEach(step => {
            step.classList.remove('active');
        });
        currentStep = next;
        document.getElementById(`step${currentStep}`).classList.add('active');
        
        // Actualizar progreso
        document.querySelectorAll('.progress-steps .step').forEach(step => {
            step.classList.remove('active');
            if (step.dataset.step <= currentStep) {
                step.classList.add('active');
            }
        });
        
        if (currentStep === 3) updateResumen();
    }
}

function prevStep(prev) {
    document.querySelectorAll('.form-step').forEach(step => {
        step.classList.remove('active');
    });
    currentStep = prev;
    document.getElementById(`step${currentStep}`).classList.add('active');
    
    // Actualizar progreso
    document.querySelectorAll('.progress-steps .step').forEach(step => {
        step.classList.remove('active');
        if (step.dataset.step <= currentStep) {
            step.classList.add('active');
        }
    });
}

// Controlador de método de pago
document.addEventListener('change', function(e) {
    if (e.target.name === 'metodo_pago') {
        document.getElementById('datosTarjeta').style.display = 
            e.target.value === 'tarjeta' ? 'block' : 'none';
    }
});

// Modal functions
function showModal(message) {
    const modal = document.getElementById('notificationModal');
    const messageElement = document.getElementById('modal-message');
    if (modal && messageElement) {
        messageElement.textContent = message;
        modal.style.display = 'flex';
    }
}

function closeModal() {
    const modal = document.getElementById('notificationModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Funciones de menú
function mostrarSeccion(tipo) {
    document.querySelectorAll('.seccion-menu').forEach(seccion => {
        seccion.style.display = 'none';
    });
    const seccionAMostrar = document.getElementById(`seccion-${tipo}`);
    if (seccionAMostrar) {
        seccionAMostrar.style.display = 'block';
    }
}

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    // Configurar fecha mínima
    const fechaInput = document.getElementById('rdate');
    if (fechaInput) {
        fechaInput.min = new Date().toISOString().split('T')[0];
    }

    // Cargar selección guardada
    const savedSelection = sessionStorage.getItem('seleccionMenu');
    if (savedSelection) {
        const selection = JSON.parse(savedSelection);
        Object.keys(selection).forEach(key => {
            const element = document.getElementById(key);
            if (element) element.value = selection[key];
        });
    }

    // Mostrar secciones si hay datos previos, basados en las variables inyectadas
    if (esPost) {
        if (mostrarDesayuno) {
            mostrarSeccion('desayuno');
        }
        if (mostrarAlmuerzo) {
            mostrarSeccion('almuerzo');
        }
        if (mostrarCena) {
            mostrarSeccion('cena');
        }
    }
});

// Guardar selección en sessionStorage
function guardarSeleccion() {
    const seleccion = {
        desayuno: document.getElementById('desayuno') ? document.getElementById('desayuno').value : '',
        pan_desayuno: document.getElementById('pan_desayuno') ? document.getElementById('pan_desayuno').value : '',
        almuerzo_entrada: document.getElementById('almuerzo_entrada') ? document.getElementById('almuerzo_entrada').value : '',
        almuerzo_fondo: document.getElementById('almuerzo_fondo') ? document.getElementById('almuerzo_fondo').value : '',
        almuerzo_postre: document.getElementById('almuerzo_postre') ? document.getElementById('almuerzo_postre').value : '',
        almuerzo_bebida: document.getElementById('almuerzo_bebida') ? document.getElementById('almuerzo_bebida').value : '',
        cena: document.getElementById('cena') ? document.getElementById('cena').value : '',
        cena_postre: document.getElementById('cena_postre') ? document.getElementById('cena_postre').value : '',
        cena_bebida: document.getElementById('cena_bebida') ? document.getElementById('cena_bebida').value : ''
    };
    sessionStorage.setItem('seleccionMenu', JSON.stringify(seleccion));
    window.location.href = 'Reserva.html';
}
