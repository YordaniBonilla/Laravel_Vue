import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home';
import ContactForm from './components/Contact';
import Us from './components/Us';

Vue.use(VueRouter);

export default new VueRouter({
	routes: [
		{ path: '/', component: Home },
		{ path: '/contact-us', component: ContactForm},
		{ path: '/us', component: Us },
	],
	mode: 'history'
});