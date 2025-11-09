function mostrarMensaje() {
    const mensaje = document.getElementById('mensajePaula');
    const boton = document.getElementById('btnMensaje');
    if (mensaje.style.display === 'none') {
        mensaje.style.display = 'block';
        boton.textContent = '❌ Ocultar mensaje';
    } else {
        mensaje.style.display = 'none';
        boton.textContent = '💌 Mensaje especial para ti';
    }
}

// Las variables proximoCumple, fechaCumple y haNacido se pasan desde cumple.php

class Actualizador {
    constructor(fechaCumple, proximoCumple) {
        this.fechaCumple = fechaCumple;
        this.proximoCumple = proximoCumple;
    }

    calcularTiempo(diferencia) {
        const segundos = Math.floor(diferencia / 1000);
        const minutos = Math.floor(segundos / 60);
        const horas = Math.floor(minutos / 60);
        const dias = Math.floor(horas / 24);
        
        return { segundos, minutos, horas, dias };
    }

    actualizarEdad() {
        const ahora = new Date().getTime();
        const diferencia = Math.abs(ahora - this.fechaCumple);
        const { segundos, minutos, horas, dias } = this.calcularTiempo(diferencia);
        
        const meses = Math.floor(dias / 30.44);
        const anos = Math.floor(dias / 365.25);
        
        const diasRestantes = Math.floor(dias % 365.25);
        const mesesRestantes = Math.floor(diasRestantes / 30.44);
        const diasFinales = Math.floor(diasRestantes % 30.44);
        
        document.getElementById('edad-anos').textContent = anos;
        document.getElementById('edad-meses').textContent = mesesRestantes;
        document.getElementById('edad-dias').textContent = diasFinales;
        document.getElementById('edad-horas').textContent = horas % 24;
        document.getElementById('edad-minutos').textContent = minutos % 60;
        document.getElementById('edad-segundos').textContent = segundos % 60;
    }

    actualizarContador() {
        const ahora = new Date().getTime();
        const diferencia = this.proximoCumple - ahora;
        
        if (diferencia <= 0) {
            document.getElementById('contador').innerHTML = '¡FELIZ CUMPLEAÑOS!';
            return;
        }
        
        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        const horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
        const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);
        
        document.getElementById('dias').textContent = dias;
        document.getElementById('horas').textContent = horas;
        document.getElementById('minutos').textContent = minutos;
        document.getElementById('segundos').textContent = segundos;
    }

    actualizarTodo() {
        this.actualizarEdad();
        this.actualizarContador();
    }

    iniciar() {
        this.actualizarTodo();
        setInterval(() => this.actualizarTodo(), 1000);
    }
}

const actualizador = new Actualizador(fechaCumple, proximoCumple);
actualizador.iniciar();
