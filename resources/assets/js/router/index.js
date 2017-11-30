import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import ClientIndex from '../views/Clients/Index.vue'
import ClientShow from '../views/Clients/Show.vue'
import ClientForm from '../views/Clients/Form.vue'
import NotFound from '../views/NotFound.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
		{ path: '/', component: ClientIndex },
		{ path: '/clients/create', component: ClientForm, meta: { mode: 'create' }},
		{ path: '/clients/edit/:id', component: ClientForm, meta: { mode: 'edit' }},
		{ path: '/clients/:id', component: ClientShow },
		{ path: '/register', component: Register },
		{ path: '/login', component: Login },
		{ path: '/not-found', component: NotFound },
		{ path: '*', component: NotFound }
	]
})

export default router
