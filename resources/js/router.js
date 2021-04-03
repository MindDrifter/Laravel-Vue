import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import home from './components/v-home';
import contacts from './components/v-contacts';
import messages from './components/v-contact_messages';
import register from './components/v-register';
import login from './components/v-login';
import user_cards from './components/v-user_cards';
import create_card from './components/v-user_cards_create'



const routes = [
    {path:'/' , component:home},
    {path: '/contact', component: contacts},
    {path: '/contact_messages', component: messages},
    {path: '/register', component: register},
    {path: '/login', component: login},
    {path: '/user_cards', component: user_cards},
    {path: '/user_cards/create_card',component: create_card}
];


export default new vueRouter({
    mode:'history',
    routes
})
