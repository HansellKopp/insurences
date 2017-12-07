
try {
    window.$ = window.jQuery = require('jquery');

	require('bootstrap-sass');
	window._ = require('lodash')
	window.toastr = require('toastr')
	toastr.options = {
		"closeButton": true,
		"positionClass": "toast-bottom-right"
	}
} catch (e) {}


import Vue from 'vue'
import App from './App.vue'
import router from './router'

Vue.component('Datepicker', require('vuejs-datepicker'));

const app = new Vue({
	el: '#root',
	template: `<app></app>`,
	components: { App },
	router
})
