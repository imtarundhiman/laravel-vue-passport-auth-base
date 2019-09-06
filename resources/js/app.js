import router from "./routes";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Echo from "laravel-echo";
import {store} from './store';

window.io = require("socket.io-client");

let authToken = store.getters.token;

window.axios.defaults.headers.common = {
    Authorization: "Bearer " + authToken
};

window.axios.interceptors.response.use(function (response) {
	return response;
}, function (error) {
	if (401 === error.response.status) {
		store.dispatch('logoutWhen401').then(() => {
			router.push('/login');
		})
	} else {
		return Promise.reject(error);
	}
});

window.Echo = new Echo({
    broadcaster: "socket.io",
    host: window.location.hostname + ":6001",
    auth: {
        headers: {
        Authorization: "Bearer " + authToken
        }
    }
});

router.beforeEach((to, from, next) =>{

	if(to.matched.some(record => record.meta.forVisitors)){

		if(store.getters.isLoggedIn){
			next({
				path: '/',
			});
		}else{
			next();
		}
	}else if(to.matched.some(record => record.meta.forAuth)){

		if(!store.getters.isLoggedIn){
			next({
				path: '/login',
			});
		}else{
			next();
		}
	}
	else{
		next();
	}
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import AppComponent from './App.vue'
import VueSweetalert2 from 'vue-sweetalert2';

const options = {
	confirmButtonColor: '#41b882',
	cancelButtonColor: '#ff7674'
}
  

Vue.use(VueSweetalert2,options);

const app = new Vue({
    el: '#app',
	router,
	store: store,
    components: { AppComponent },
});