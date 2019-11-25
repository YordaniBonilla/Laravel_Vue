import Vue from 'vue';
import router from './router';
import App from './components/App';
import axios from 'axios';

Vue.prototype.axios = axios;

require('./bootstrap');

Vue.component('Formulario', require('./components/ProductComponent.vue').default);

const app = new Vue({
	el: '#app',
	components: {
		App
	},
	router
});
