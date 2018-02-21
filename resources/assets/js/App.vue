<template>
	<div>
		<nav class="navbar navbar-default navbar-fixed-top text-color-white" id="mainNav">
      <button type="button" class="btn btn-back navbar-btn pull-left" @click="goBack">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </button>
      <router-link class="btn btn-back navbar-btn pull-left" to="/welcome">
              <span class="glyphicon glyphicon-home"></span>
      </router-link>
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<i class="fa fa-bars"></i>
					</button>

			  </div>

          <div class="collapse navbar-collapse" id="app-navbar-collapse">

          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            <li v-if="auth"><router-link class="nav-link" to="/branches">Branches</router-link></li>
            <li v-if="auth"><router-link class="nav-link" to="/companies">Companies</router-link></li>            
            <li v-if="auth"><router-link class="nav-link" to="/clients">Clients</router-link></li>
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
										<i class="fa fa-fw fa-sign-in"></i><span>Login</span>
									</router-link>
									<router-link v-if="guest" class="nav-link" to="/register">
										<i class="fa fa-fw fa-user-plus"></i><span>Register</span>
									</router-link>
								</li>
              </ul>
            </li>
	        </ul>
        </div>
      </div>
    </nav>
		<div class="content">
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

.content {
    margin: 65px 10px 10px 10px;
}

/* Nav links */
$bgDefault      : #53b5ea;
$bgHighlight    : #61b9e8;
$colDefault     : #ecf0f1;
$colHighlight   : #29159c;
$dropDown       : true;
.btn-back {
  background-color: $bgDefault;
  border-color: transparent;
  color: $colDefault; 
}
.navbar-default {
  background-color: $bgDefault;
  border-color: $bgHighlight;
  .navbar-brand {
    color: $colDefault;
    &:hover, &:focus {
      color: $colHighlight; }}
  .navbar-text {
    color: $colDefault; }
  .navbar-nav {
    > li {
      > a {
        color: $colDefault;
        &:hover,  &:focus {
          color: $colHighlight; }}
      @if $dropDown {
        > .dropdown-menu {
          background-color: $bgDefault;
          > li {
            > a {
              color: $colDefault;
              &:hover,  &:focus {
                color: $colHighlight;
                background-color: $bgHighlight; }}
            &.divider {
              background-color: $bgHighlight;}}}}}
    @if $dropDown {
      .open .dropdown-menu > .active {
        > a, > a:hover, > a:focus {
          color: $colHighlight;
          background-color: $bgHighlight; }}}
    > .active {
      > a, > a:hover, > a:focus {
        color: $colHighlight;
        background-color: $bgHighlight; }}
    > .open {
      > a, > a:hover, > a:focus {
        color: $colHighlight;
        background-color: $bgHighlight; }}}
  .navbar-toggle {
    border-color: $bgHighlight;
    &:hover, &:focus {
      background-color: $bgHighlight; }
    .icon-bar {
      background-color: $colDefault; }}
  .navbar-collapse,
  .navbar-form {
    border-color: $colDefault; }
  .navbar-link {
    color: $colDefault;
    &:hover {
      color: $colHighlight; }}}
@media (max-width: 767px) {
  .navbar-default .navbar-nav .open .dropdown-menu {
    > li > a {
      color: $colDefault;
      &:hover, &:focus {
        color: $colHighlight; }}
    > .active {
      > a, > a:hover, > a:focus {
        color: $colHighlight;
        background-color: $bgHighlight; }}}
}
</style>
