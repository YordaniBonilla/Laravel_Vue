import Vue from 'vue';
import router from './router';
import App from './components/App';
import axios from 'axios';

Vue.prototype.axios = axios;

require('./bootstrap');


const app = new Vue({
	el: '#app',
	components: {
		App
	},
	router
});
