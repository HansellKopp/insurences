<template>
	<div>
		<nav class="navbar navbar-default navbar-fixed-top" id="mainNav">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Branding Image -->
					<router-link class="navbar-brand" :to="home">
						<i class="fa fa-code"></i> I<small>nsurences</small>
					</router-link>
				</div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
						<li class="dropdown" v-if="auth">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								  <i class="fa "></i> Tables <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#/users"><i class="fa fa-users"></i> Users</a></li>
                              </ul>
                        </li>
                        <li class="dropdown" v-if="auth">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								  <i class="fa "></i> Reports <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#/users"><i class="fa fa-users"></i> Users</a></li>
                              </ul>
                        </li>
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-user fa-fw"></i> {{ username ? username : 'User' }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li v-if="auth">
                                        <a @click="logout"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                                    </li>
									<li v-else>
										<router-link v-if="guest" class="nav-link" to="/login">
											<i class="fa fa-fw fa-sign-in"></i> Login</a>
										</router-link>
										<router-link v-if="guest" class="nav-link" to="/register">
											<i class="fa fa-fw fa-user-plus"></i> Register</a>
										</router-link>
									</li>
                                </ul>
                            </li>
							
                    </ul>
                </div>
            </div>
        </nav>
		<div class="row content">
			<div class="col-xs-12">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Auth from './store/auth'
	import toastr from 'toastr'
	import { post, interceptors } from './helpers/api'
	export default {
		created() {
			// global error http handler
			interceptors((err) => {
				if(err.response.status === 401) {
					Auth.remove()
					this.$router.push('/login')
				}

				if(err.response.status === 500) {
					toastr.error(err.response.statusText)
				}

				if(err.response.status === 404) {
					this.$router.push('/not-found')
				}
			})
			Auth.initialize()
		},
		data() {
			return {
				authState: Auth.state,
			}
		},
		computed: {
			auth() {
				if(this.authState.api_token) {
					return true
				}
				return false
			},
			username() {
				return this.authState.username
			},
			guest() {
				return !this.auth
			},
			home() {
				return this.auth ? "Home" : "Welcome"
			}
		},
		methods: {
			logout() {
				post('/api/logout')
				    .then((res) => {
				        if(res.data.done) {
				            // remove token
							Auth.remove()
							toastr.success('You have successfully logged out.')
				            this.$router.push('/login')
				        }
				    })
			}
		}
	}
</script>
