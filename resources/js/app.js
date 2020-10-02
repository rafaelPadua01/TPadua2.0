/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
//imports css dos arquivos bootstrap e bootrap vue
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
//Importa arquivo app.scss
import '../sass/app.scss'
import PortalVue from 'portal-vue'
import VueToast from 'vue-toast-notification';
//impota um dos temas de avaliação
import 'vue-toast-notification/dist/theme-default.css';
//import SideBarPlugin



//Intalação do bootstrap Vue
Vue.use(BootstrapVue)
//Instalação do plugin de icones
Vue.use(IconsPlugin)
//instancia portalVue
Vue.use(PortalVue)
//instancia vuetoast
Vue.use(VueToast);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('noticia-component', require('./components/NoticiaComponent.vue').default);
Vue.component('display-noticia-component', require('./components/Noticias/DisplayNoticiaComponent.vue'). default);
Vue.component('last-news-component', require('./components/Noticias/LastNewsComponent.vue').default);
Vue.component('welcome-component', require('./components/WelcomeComponent.vue').default);
Vue.component('admin-component', require('./components/Admin/AdminComponent.vue').default);
Vue.component('galerianoticias-component', require('./components/GaleriaNoticias/GaleriaNoticiasComponent.vue').default);
Vue.component('galeria-img-component', require('./components/GaleriaNoticias/ShowGaleriaImgComponent.vue').default);
Vue.component('galeria-video-component', require('./components/GaleriaNoticias/ShowGaleriaVideoComponent.vue').default);
Vue.component('arte-cultura-component', require('./components/ArteCultura/ArteCulturaComponent.vue').default);
Vue.component('evento-component', require('./components/ArteCultura/EventoComponent.vue').default);
Vue.component('newsletter-component', require('./components/Newsletter/NewsletterComponent.vue').default);
Vue.component('newsletter-assing-component', require('./components/Newsletter/NewsletterAssingComponent.vue').default);
Vue.component('categorias-component', require('./components/Categorias/CategoriasComponent.vue').default);
Vue.component('comentarios-component', require('./components/Comentarios/ComentariosComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

//Instancia moment para formatar datas
const moment = require('moment')
require('moment/locale/pt-br')
Vue.use(require('vue-moment'), {
    moment
});
