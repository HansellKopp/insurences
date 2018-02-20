
try {
    window.$ = window.jQuery = require('jquery');

	require('bootstrap-sass');
	window._ = require('lodash')
	window.toastr = require('toastr')
	toastr.options = {
		"closeButton": true,
		"positionClass": "toast-bottom-right"
	}
} catch (e) {
	console.log(e)
}


import Vue from 'vue'
import App from './App.vue'
import router from './router'
import datePicker from 'vue-bootstrap-datetimepicker';
import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';

Vue.use(datePicker);

const app = new Vue({
	el: '#root',
	template: `<app></app>`,
	components: { App },
	router
})

