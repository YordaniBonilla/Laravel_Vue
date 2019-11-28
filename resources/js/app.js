import Vue from 'vue';
import router from './router';
import App from './App';
import axios from 'axios';

Vue.prototype.$axios = axios;

require('./bootstrap');

Vue.prototype.$isCurrentPage = function(url) {
	if(this.$route.path == url) {
	  return true
	} 
		return false
}
new Vue({
	router,
	render: h => h(App)
}).$mount('#app');
