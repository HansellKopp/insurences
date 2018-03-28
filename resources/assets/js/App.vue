<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a href="/back" class="btn navbar-icon pull-left" @click.prevent="goBack">
        <span class="fa fa-chevron-left"></span>
      </a>
      <router-link class="btn navbar-icon pull-left" to="/welcome">
            <span class="fa fa-home"></span>
      </router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
          <li v-if="auth"><router-link class="nav-link" to="/branches">Branches</router-link></li>
          <li v-if="auth"><router-link class="nav-link" to="/companies">Companies</router-link></li>            
          <li v-if="auth"><router-link class="nav-link" to="/clients">Clients</router-link></li>
        </ul>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#user" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fa fa-user fa-fw"></i> {{ username ? username : 'User' }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <div v-if="auth">
                <a @click="logout"><i class="fa fa-fw fa-sign-out" /> Logout</a>
              </div>
              <div v-else>
                <div>
                  <router-link to="/login"><i class="fa fa-sign-in fa-fw" /> Login</router-link>
                </div>
                <div>
                  <router-link to="/register"><i class="fa fa-user-plus fa-fw" /> Register</router-link>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
		<div class="container-fluid content">
			<router-view></router-view>
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
      },
      goBack() {
        this.$router.go(-1)
      }
		}
	}
</script>

<style lang="scss" scoped>
.navbar-icon {
  color: rgba(255, 255, 255, 0.5);
  font-size: 1.3em;
}
.content {
    margin: 65px 10px 10px 10px;
}

</style>
