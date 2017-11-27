<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form">

                        <div class="form-group" :class="{'has-error': errorsEmail}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" v-model="loginDetails.email" required autofocus>
                                    <span v-if="emailError!=null" class="help-block">
                                        <strong>{{ emailError }}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group" :class="{'has-error': errorsPassword}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="loginDetails.password" name="password" required>
                                    <span v-if="passwordError!==null" class="help-block">
                                        <strong>{{passwordError}}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" v-model="loginDetails.remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'login',

    data: () => ({

        loginDetails: {
            email: '',
            password: '',
            remember: true,
        },

        emailError: null,
        passwordError:null,
    }),

    methods: {
        loginPost() {
            let vm = this
            axios.post('/login', vm.loginDetails)
                 .then((response) =>
                      console.log(response)
                 )
                 .catch((error) => {
                    var errors = error.response
                    if(errors.statusText === 'Unprocessable Entity') {
                        if(errors.data) {
                            this.emailError = null
                            this.passwordError = null
                            if(errors.data.email) {
                                this.emailError = _isArray(errors.data.email) ? errors.data.email[0]: errors.email
                            }
                            if(errors.data.password) {
                                this.passwordError = _isArray(errors.data.password) ? errors.data.password[0]: errors.password
                            }

                        }
                    }
                 })
        }
    },
    
    mounted() {
            console.log('Component mounted.')
    }
}
</script>

<style lang="sass">

</style>
