import './bootstrap';
import.meta.glob([
    '../logos/**',
    '../css/**',
    '../js/**',
  ]);
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
