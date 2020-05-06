
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

			require('./bootstrap');

			window.Vue = require('vue');

			import Echo from 'laravel-echo'

			window.Pusher = require('pusher-js');

			window.Echo = new Echo({
			    broadcaster: 'pusher',
			    key:'bf6e79cce8548fb2c5e9',
			    cluster: 'ap2',
			    forceTLS: true
			});

			/**
			 * Next, we will create a fresh Vue application instance and attach it to
			 * the page. Then, you may begin adding components to this application
			 * or customize the JavaScript scaffolding to fit your unique needs.
			 */

			Vue.component('ExampleComponent', require('./components/ExampleComponent.vue'));

			const app = new Vue({
			    el: '#app',

			    created(){
			    	
			    }

			});

