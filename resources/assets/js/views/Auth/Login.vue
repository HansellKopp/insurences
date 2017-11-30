<template>
    <form class="form well" @submit.prevent="login">
        <h1 class="form-title">Welcome back!</h1>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" v-model="form.email">
            <small class="error-control" v-if="error.email">{{error.email[0]}}</small>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" v-model="form.password">
            <small class="error-control" v-if="error.password">{{error.password[0]}}</small>
        </div>
        <div class="form-group">
            <button :disabled="isProcessing" class="btn btn-primary">Login</button>
        </div>
    </form>
</template>
<script type="text/javascript">
    import Auth from '../../store/auth'
    import { post } from '../../helpers/api'
    export default {
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: {},
                isProcessing: false
            }
        },
        methods: {
            login() {
                this.isProcessing = true
                this.error = {}
                post('api/login', this.form)
                    .then((res) => {
                        if(res.data.authenticated) {
                            // set token
                            Auth.set(
                                res.data.api_token,
                                res.data.user_id,
                                res.data.username
                            )
                            toastr.success('You have successfully logged in.')
                            this.$router.push('/')
                        }
                        this.isProcessing = false
                    })
                    .catch((err) => {
                        if(err.response.status === 422) {
                            this.error = err.response.data
                        }
                        this.isProcessing = false
                    })
            }
        }
    }
</script>
