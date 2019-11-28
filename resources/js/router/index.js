// @ es un shortcut definido en webpack como '@':__dirname + '/resources/js'
import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '@/components/Home';
import Contact from '@/components/Contact';
import Us from '@/components/Us';
import Products from '@/components/Products'; 
Vue.use(VueRouter);
const routes = [
  { 
  	path: '/', 
    component: Home
  },
  { 
  	path: '/contact-us',
  	component: Contact},
  { 
  	path: '/us',
  	component: Us
  },
  { 
  	path: '/products',
  	component: Products
  },
]
const router = new VueRouter({
  mode: 'history',
  routes
});

export default router