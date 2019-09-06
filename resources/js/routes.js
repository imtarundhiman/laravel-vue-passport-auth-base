import VueRouter from "vue-router";
import LoginComponent from '@components/auth/login.vue'
import Error404 from '@components/404.vue'
import DashboardComponent from '@components/dashboard/dashboard'

const routes = [
    {
        path: '/login', 
        meta: {
            hideTopNav: true,
            hideFooter: true,
            hideSidebar: true,
            fullScreent: true,
            breadcrumb: [
                {'name' : '404 Error'}
            ]
        },
        component: LoginComponent
    },
    { 
        path: '/', 
        meta: {
            forAuth: true,
            breadcrumb: [
                {'name' : '404 Error'}
            ]
        },
        component: DashboardComponent
    },
    { 
        path: '/404', 
        meta: {
            breadcrumb: [
                {'name' : '404 Error'}
            ]
        },
        component: Error404
    },  
    { path: '*', redirect: '/404' }, 
];

export default new VueRouter({
    routes,
    linkActiveClass: "active"
});