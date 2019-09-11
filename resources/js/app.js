require('./bootstrap');


window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);


let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path:'/playlist/listar',
            name:'playlist_listar',
            component: require('./components/ListaReproduccionComponent').default
        },
     
        {
            path:'/playlist/crear',
            name:'playlist_crear',
            component: require('./components/CrearReproduccionComponent').default
        },
        {
            path:'/video/subir',
            name:'playlist_subir',
            component: require('./components/SubirVideoComponent').default
        },
        {
            path:'/canal/subir',
            name:'canal_subir',
            component: require('./components/CrearCanalComponent').default
        },
        {
            path:'/dashboard',
            name:'dashboard',
            component: require('./components/DashboardComponent').default
        },
        {
            path:'/estadistica',
            name:'estadistica',
            component: require('./components/EstadisticaComponent').default
        },
        {
            path:'/edit/:id',
            name:'playlist_editar',
            component: require('./components/EditarReproduccionComponent').default
        }
        // {
        //     path:'*',
        //     name:'dashboard',
        //     component: require('./components/DashboardComponent').default
        // },
       
    ]
    
})

Vue.component('master', require('./components/MasterComponent.vue').default);
Vue.component('dashboard', require('./components/DashboardComponent.vue').default);
Vue.component('lista-playlist', require('./components/ListaReproduccionComponent.vue').default);
Vue.component('editar-playlist', require('./components/EditarReproduccionComponent.vue').default);
Vue.component('crear-playlist', require('./components/CrearReproduccionComponent.vue').default);
Vue.component('subir-video', require('./components/SubirVideoComponent.vue').default);
Vue.component('crear-canal', require('./components/CrearCanalComponent.vue').default);
Vue.component('estadistica', require('./components/EstadisticaComponent.vue').default);



const app = new Vue({
    el: '#app',
    router
});
