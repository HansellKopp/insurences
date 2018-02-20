import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import Companies from '../views/Companies/Index.vue'
import CompanyShow from '../views/Companies/Show.vue'
import CompanyForm from '../views/Companies/Form.vue'
import Clients from '../views/Clients/Index.vue'
import ClientShow from '../views/Clients/Show.vue'
import ClientForm from '../views/Clients/Form.vue'
import NotFound from '../views/NotFound.vue'
import Welcome from '../views/Welcome.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{ path: '/', component: Welcome },
		{ path: '/companies', component: Companies },
		{ path: '/companies/create', component: CompanyForm },
		{ path: '/companies/edit/:id', component: CompanyForm },
		{ path: '/companies/:id', component: CompanyShow },
		{ path: '/clients', component: Clients },
		{ path: '/clients/create', component: ClientForm },
		{ path: '/clients/edit/:id', component: ClientForm },
		{ path: '/clients/:id', component: ClientShow },
		{ path: '/register', component: Register },
		{ path: '/login', component: Login },
		{ path: '/not-found', component: NotFound },
		{ path: '/welcome', component: Welcome },
		{ path: '*', component: NotFound }
	]
})

export default router
