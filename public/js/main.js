import Vue from 'vue';
import App from './App.vue';
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import VueRouter from 'vue-router';
import NavbarComponent from './components/NavbarComponent.vue'; // Pastikan mengimpor komponen NavbarComponent
import DashboardComponent from './components/DashboardComponent.vue'; // Sesuaikan dengan komponen DashboardComponent
import AlbumsComponent from './components/AlbumsComponent.vue'; // Sesuaikan dengan komponen AlbumsComponent
import PhotosComponent from './components/PhotosComponent.vue'; // Sesuaikan dengan komponen PhotosComponent

Vue.use(BootstrapVue);
Vue.use(VueRouter);

Vue.config.productionTip = false;

const routes = [
    { path: '/dashboard', component: DashboardComponent },
    { path: '/albums', component: AlbumsComponent },
    { path: '/photos', component: PhotosComponent },
    // Tambahkan rute lainnya sesuai kebutuhan
];

const router = new VueRouter({
    routes,
    mode: 'history', // Untuk menghapus tanda pagar (#) dari URL
});

new Vue({
    render: (h) => h(App),
    router,
    components: {
        NavbarComponent,
    },
}).$mount('#app');
