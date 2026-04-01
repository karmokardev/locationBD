import './bootstrap';
import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';

// flatpickr
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
// FullCalendar
import { Calendar } from '@fullcalendar/core';
// Import FontAwesome CSS
import '@fortawesome/fontawesome-free/css/all.css';


window.Alpine = Alpine;
window.ApexCharts = ApexCharts;
window.flatpickr = flatpickr;
window.FullCalendar = Calendar;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {

  if (document.querySelector('#commissionChartData')) {
    import('./components/chart/customer-commission').then(module => module.initCommissionChart());
  }

  if (document.querySelector('#customerChartData')) {
    import('./components/chart/admin-customer').then(module => module.initCustomerChart());
  }
});