import './bootstrap'
import Alpine from 'alpinejs'
import AOS from 'aos'
import 'aos/dist/aos.css'

// Inisialisasi Alpine
window.Alpine = Alpine
Alpine.start()

// Inisialisasi AOS
document.addEventListener('DOMContentLoaded', () => {
  AOS.init({
    duration: 800,  // durasi animasi dalam ms
    once: true,     // animasi hanya sekali
    easing: 'ease-out',
  })
})
