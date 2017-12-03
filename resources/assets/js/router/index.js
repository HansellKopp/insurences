import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import Clients from '../views/Clients/Index.vue'
import ClientShow from '../views/Clients/Show.vue'
import ClientForm from '../views/Clients/Form.vue'
import NotFound from '../views/NotFound.vue'
import Welcome from '../views/Welcome.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{ path: '/', component: Welcome },
		{ path: '/clients', component: Clients },
		{ path: '/clients/create', component: ClientForm, meta: { mode: 'create' }},
		{ path: '/clients/edit/:id', component: ClientForm, meta: { mode: 'edit' }},
		{ path: '/clients/:id', component: ClientShow },
		{ path: '/register', component: Register },
		{ path: '/login', component: Login },
		{ path: '/not-found', component: NotFound },
		{ path: '/welcome', component: Welcome },
		{ path: '*', component: NotFound }
	]
})

export default router
