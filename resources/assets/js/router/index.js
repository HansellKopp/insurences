import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import Branches from '../views/Branches/Index.vue'
import BranchShow from '../views/Branches/Show.vue'
import BranchForm from '../views/Branches/Form.vue'
import Companies from '../views/Companies/Index.vue'
import CompanyShow from '../views/Companies/Show.vue'
import CompanyForm from '../views/Companies/Form.vue'
import Clients from '../views/Clients/Index.vue'
import ClientShow from '../views/Clients/Show.vue'
import ClientForm from '../views/Clients/Form.vue'
import Policies from '../views/Policies/Index.vue'
import PolicyShow from '../views/Policies/Show.vue'
import PolicyForm from '../views/Policies/Form.vue'
import NotFound from '../views/NotFound.vue'
import Welcome from '../views/Welcome.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{ path: '/', component: Welcome },
		{ path: '/branches', component: Branches },
		{ path: '/branches/create', component: BranchForm },
		{ path: '/branches/edit/:id', component: BranchForm },
		{ path: '/branches/:id', component: BranchShow },
		{ path: '/branches/:id/policies', component: Policies },
		{ path: '/companies', component: Companies },
		{ path: '/companies/create', component: CompanyForm },
		{ path: '/companies/edit/:id', component: CompanyForm },
		{ path: '/companies/:id', component: CompanyShow },
		{ path: '/clients', component: Clients },
		{ path: '/clients/create', component: ClientForm },
		{ path: '/clients/edit/:id', component: ClientForm },
		{ path: '/clients/:id', component: ClientShow },
		{ path: '/policies', component: Policies },
		{ path: '/policies/create', component: PolicyForm },
		{ path: '/policies/edit/:id', component: PolicyForm },
		{ path: '/policies/:id', component: PolicyShow },
		{ path: '/policies/:id/recepts', component: PolicyShow },
		{ path: '/register', component: Register },
		{ path: '/login', component: Login },
		{ path: '/not-found', component: NotFound },
		{ path: '/welcome', component: Welcome },
		{ path: '*', component: NotFound }
	]
})

export default router
